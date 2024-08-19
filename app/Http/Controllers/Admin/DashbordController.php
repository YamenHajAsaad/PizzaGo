<?php

namespace App\Http\Controllers\Admin;

use App\Models\Meal;
use App\Models\Order;
use App\Models\Detail;
use App\Models\Catgory;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCatgoryRequest;

class DashbordController extends Controller
{
    // page url
    public function index(){

        $orders = Order::with('orderDetails.meal', 'orderDetails.detail','user')->where('status', 2)->get();
        return view('admin.dashbord', ['orders' => $orders]);
    }

    public function orderhistory(){
        $orders = Order::with('orderDetails.meal', 'orderDetails.detail','user')->get();
        return view('admin.orderhistory',['orders'=>$orders]);
    }
    public function sales(){

        $meals = Meal::leftJoin('order_details', 'meals.id', '=', 'order_details.meals_id')
            ->select('meals.*', DB::raw('COALESCE(SUM(order_details.quantity), 0) as total_quantity'))
            ->groupBy('meals.id', 'meals.meals_name','meals.meals_descrption','meals.meals_image','meals.meals_pattern','meals.catgories_id','meals.created_at', 'meals.updated_at') // أضف جميع الأعمدة المطلوبة
            ->orderBy('total_quantity', 'desc')
            ->get();

        $ordersByDate = DB::table('orders')
        ->select(
            DB::raw('DATE(orders.created_at) as order_date'), // الحصول على التاريخ فقط
            DB::raw('COUNT(orders.id) as total_orders'), // عدد الطلبات
            DB::raw('SUM(orders.total) as total_revenue') // مجموع الأسعار
        )
        ->groupBy('order_date') // تجميع حسب التاريخ
        ->orderBy('order_date', 'asc') // ترتيب النتائج حسب التاريخ
        ->get();

        return view('admin.sales', ['meals' => $meals , 'orders'=>$ordersByDate]);
    }

    public function Catgories(){
        $catgories = Catgory::all();
        return view('admin.Catgories',['catgories'=>$catgories]);
    }
    public function meal(){
        $catgories = Catgory::all();
        $meals = Meal::all();
        $Details = Detail::all();
        return view('admin.meal',['catgories'=>$catgories ,'meals'=>$meals,'Details'=>$Details]);
    }

    // crud of catgories
    public function catgories_store(Request $request){
        $catgories_name = $request->catgories_name;
        $catgories_descrption = $request->catgories_descrption;
        if ($request->hasFile('catgories_image'))
        {
            $image = $request->file('catgories_image')->getClientOriginalName();
            $path = $request->file('catgories_image')->storeAs('catgories', $image, 'public');
        }
        $catgory = Catgory::create([
            'catgories_name' => $catgories_name,
            'catgories_descrption'=> $catgories_descrption,
            'catgories_image' => $image,
        ]);
        return redirect()->route('admin.Catgories');
    }

    public function catgories_update(Request $request, $id){
        $catgories = Catgory::find($id);
        $catgories->catgories_name = $request->catgories_name;
        $catgories->catgories_descrption = $request->catgories_descrption;
        if ($request->hasFile('catgories_image')) {
            $image = $request->file('catgories_image');
            $imageName = $image->getClientOriginalName();
            $image->storeAs('catgories', $imageName, 'public');

            $catgories->catgories_image = $imageName;
        }
        $catgories->save();
        return redirect()->route('admin.Catgories')->with('success', 'update has succusfuly');
    }

    public function catgories_destroy($id){
        $catgories = Catgory::find($id);
        $catgories->delete();
        return redirect()->back();

    }

     // crud of meal
    public function meal_store(Request $request){
        $meals_name =  $request->meals_name;
        $meals_descrption =  $request->meals_descrption;
        $meals_pattern =  $request->meals_pattern;
        $catgories_id =  $request->catgories_id;
        if($request->hasFile('meals_image')){
            $image = $request->file('meals_image')->getClientOriginalName();
            $path = $request->file('meals_image')->storeAs('meals', $image, 'public');
        }
        $meal = Meal::create([
            'meals_name'=> $meals_name,
            'meals_descrption'=> $meals_descrption,
            'meals_image'=> $image,
            'meals_pattern'=> $meals_pattern,
            'catgories_id'=>$catgories_id,
        ]);
        $Detail_size =  $request->Detail_size;
        $Detail_price =  $request->Detail_price;
        $Detail_weight =  $request->Detail_weight;
        $Detail = Detail::create([
            'Detail_size'=> $Detail_size,
            'Detail_price'=> $Detail_price,
            'Detail_weight'=> $Detail_weight,
            'meals_id'=> $meal->id,
        ]);
        return redirect()->route('admin.meal')->with('success', 'add meal has succusfuly');
    }

    public function mealdetails_store(Request $request){
        $meals_id =  $request->meals_id;
        $Detail_size =  $request->Detail_size;
        $Detail_price =  $request->Detail_price;
        $Detail_weight =  $request->Detail_weight;
        $Detail = Detail::create([
            'Detail_size'=> $Detail_size,
            'Detail_price'=> $Detail_price,
            'Detail_weight'=> $Detail_weight,
            'meals_id'=> $meals_id,
        ]);
        return redirect()->route('admin.meal')->with('success', 'add has succusfuly');
    }

    public function meal_update(Request $request,$id){
        $Detail = Detail::find($id);
        $Detail->Detail_size = $request->Detail_size;
        $Detail->Detail_price = $request->Detail_price;
        $Detail->Detail_weight = $request->Detail_weight;
        $Detail->save();

        $meals = $Detail->meal;
        $previousImage = $meals->meals_image;
        if($request->hasFile('meals_image')){
            $image = $request->file('meals_image')->getClientOriginalName();
            $path = $request->file('meals_image')->storeAs('meals', $image, 'public');
            $meals->meals_image = $image;
        }
        $meals->meals_name = $request->meals_name;
        $meals->meals_descrption = $request->meals_descrption;
        $meals->meals_pattern = $request->meals_pattern;
        $meals->catgories_id =$request->catgories_id;
        $meals->save();
        return redirect()->route('admin.meal')->with('success', 'update has succusfuly');
    }

    public function meal_destroy(Request $request,$id){
        $detail = Detail::find($request->id);
        $meal = $detail->meal;
        $hasOtherDetails = $meal->details()->where('id', '!=', $detail->id)->exists();
        if ($hasOtherDetails)
        {
            $detail->delete();
        }
        else
        {
            $meal->delete();
        }
        return redirect()->route('admin.meal')->with('success', 'Meal deleted successfully.');
    }

    public function orderreject(Request $request,$orderId)
    {
        $order = Order::find($orderId);
        $order->status = 0;
        $order->save();
        return redirect()->back()->with('status','order rejected succesfully');
    }

    public function orderaccept(Request $request,$orderId)
    {
        $order = Order::find($orderId);
        $order->status = 1;
        $order->save();
        return redirect()->back()->with('status','order accepted succesfully');
    }


    public function orderdestroy(Request $request,$orderId)
    {
        $order = Order::find($orderId);
        $order->delete();
        return redirect()->back()->with('status','order delete succesfully');
    }

}

