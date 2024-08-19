<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\Order;
use App\Models\Detail;
use App\Models\Favorite;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index_favorite()
    {
        $user = auth()->user();
        $favorites = Favorite::where('users_id', $user->id)->get();
        $meals = [];
        foreach ($favorites as $favorite)
        {
            $meal = Meal::find($favorite->meals_id);
            if ($meal) {
                $meals[] = $meal;
            }
        }
        if(!empty($meals))
        {
            return view('user.favorite',['meals'=>$meals]);
        }
        else
        {
            return redirect()->back()->with('message','you dont have any favorite');
        }
    }

    public function favorite_store(REQUEST $request,$meal)
    {
        $user = auth()->user();
        $existingFavorite = Favorite::where('users_id', $user->id)
                                   ->where('meals_id', $meal)
                                   ->first();
        if($existingFavorite)
        {
            return redirect()->back()->with('message', 'Meal is already saved in favorites!');
        }
        else
        {
            $favorite = new Favorite;
            $favorite->users_id = $user->id;
            $favorite->meals_id = $meal;
            $favorite->save();
            return redirect()->back()->with('message', 'Meal added to favorites successfully!');
        }
    }

    public function favorite_show(REQUEST $request,$meal)
    {

        $meals = Meal::where('id',$meal)->get();

        $firstmealpattern = $meals->first()->meals_pattern;

        if($firstmealpattern == 'Pastries')
        {
            return view('user.showpastries',['meals'=>$meals]);
        }
        elseif($firstmealpattern == 'Meal')
        {
            return view('user.showmeal',['meals'=>$meals]);
        }
    }

    public function favorite_destroy($meal)
    {
        $favorite = Favorite::where('meals_id',$meal)->first();
        $favorite->delete();
        return redirect()->route('user.home')->with('message', 'delete has successfuly');
    }


    public function order_session(Request $request)
    {
        $detailId = $request->input('details_meal');
        $detail = Detail::find($detailId);

        $order = Session::get('order', []);

        $productExists = collect($order)->where('id', $detail->id)->first();

        if(!$productExists) {
            $mealQuantity = 1;
            $mealPrice = $detail->Detail_price * $mealQuantity;

            $order[] = [
                'Detail_id' => $detail->id,
                'Detail_size' => $detail->Detail_size,
                'Detail_weight' => $detail->Detail_weight,
                'Detail_price' => $detail->Detail_price,
                'meal_id' => $detail->meal->id,
                'meal_name' => $detail->meal->meals_name,
                'meals_descrption' => $detail->meal->meals_descrption,
                'meal_image' => $detail->meal->meals_image,
                'meal_quntity' => $mealQuantity,
                'meal_price' => $mealPrice,
            ];

            // Calculate total after adding all items
            $total = 0;
            foreach($order as $item) {
                $total += $item['meal_price'];
            }

            // Update 'total' value in each item
            foreach($order as &$item) {
                $item['total'] = $total;
            }

            Session::put('order', $order);
            return redirect()->back()->with('message', 'Product added successfully. Go to order to check out');
        }
        else {
            return redirect()->back()->with('message', 'Product already exists. Go to order to check out');
        }
    }

    public function index_order()
    {
        $order = Session::get('order', []);
        if(!empty($order))
        {
            return view('user.order', ['order' => $order]);
        }
        else
        {
            return redirect()->back()->with('message','you dont have any meal in order');
        }
    }

    public function order_destroy_all()
    {
        Session::forget('order');
        return redirect()->route('user.home')->with('message', 'All products canceled successfully');
    }

    public function order_destroy_item(Request $request)
    {
        $index = $request->input('item_index');
        $order = session('order', []);

        if (isset($order[$index])) {
            unset($order[$index]);
            session(['order' => array_values($order)]);
        }
        return redirect()->route('user.home')->with('message', 'products canceled successfully');
    }

    public function order_update_quantity(Request $request)
    {

        $index = $request->input('item_index');
        $newQuantity = $request->input('quantity');

        $order = Session::get('order', []);
        if($newQuantity > 0 && $newQuantity <= 10)
        {
                if (isset($order[$index])) {
                    $order[$index]['meal_quntity'] = $newQuantity;

                    // إعادة حساب السعر الإجمالي
                    $total = 0;
                    foreach($order as $item) {
                        $item['meal_price'] = $item['Detail_price'] * $item['meal_quntity'];
                        $total += $item['meal_price'];
                    }


                    foreach($order as &$item) {
                        $item['total'] = $total;
                    }

                    Session::put('order', $order); // حفظ التعديلات في الـ session

                    return redirect()->back()->with('message', 'Quantity updated successfully');
                }
                else {
                    return redirect()->back()->with('message', 'Item not found in order');
                }
        }
        else
        {
            return redirect()->back()->with('message',  'Invalid quantity. Quantity should be between 1 and 10.');
        }
    }

    public function order_confirm()
    {
        $order = Session::get('order', []);
        $user = auth()->user();

        $totalPrice = 0;
        foreach($order as $item) {
            $item['meal_price'] = $item['Detail_price'] * $item['meal_quntity'];
            $totalPrice += $item['meal_price'];
        }

        $newOrder = new Order();
        $newOrder->users_id = $user->id;
        $newOrder->total = $totalPrice;
        $newOrder->save();
        $orderId = $newOrder->id;

        foreach($order as $item) {
            $item['meal_price'] = $item['Detail_price'] * $item['meal_quntity'];
            
            $newOrderDetail = new OrderDetails();
            $newOrderDetail->meals_id = $item['meal_id'];
            $newOrderDetail->details_id = $item['Detail_id'];
            $newOrderDetail->quantity = $item['meal_quntity'];
            $newOrderDetail->price_all = $item['meal_price'];
            $newOrderDetail->orders_id = $orderId;
            $newOrderDetail->save();
        }

        // حذف الـ session بعد الإضافة
        Session::forget('order');

        return redirect()->route('user.home')->with('message', 'the order has add succesfully ,
        You will receive a message to confirm your order ');
    }






}
