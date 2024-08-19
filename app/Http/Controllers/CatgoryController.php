<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\Detail;
use App\Models\Catgory;
use Illuminate\Http\Request;

class CatgoryController extends Controller
{
   // all user page firstly
   public function index()
   {
     $catgories = Catgory::take(3)->get();
     $pastries = Meal::with('details')->where('meals_pattern', 'Pastries')->take(3)->get();
     $meals = Meal::with('details')->where('meals_pattern', 'Meal')->take(3)->get();
     return view('user.index',['catgories'=>$catgories , 'pastries' => $pastries ,'meals' => $meals]);
   }

   public function catgory()
   {
    $catgories = Catgory::paginate(6);
    return view('user.catgories',['catgories'=>$catgories]);
   }

   public function pastries()
   {
    $pastries = Meal::with('details')->where('meals_pattern', 'Pastries')->paginate(6);
    return view('user.pastries',['pastries' => $pastries]);
   }

   public function meals()
   {
    $meals = Meal::with('details')->where('meals_pattern', 'Meal')->paginate(6);
    return view('user.meals',['meals' => $meals]);
   }

   public function show(Request $request,$id)
   {
    $meals = Meal::where('catgories_id', $id)->get();

    if ($meals->isNotEmpty())
    {

      $firstMealPattern = $meals->first()->meals_pattern;

      if($firstMealPattern == 'Pastries')
      {
          return view('user.showpastries',['meals'=> $meals]);
      }
      elseif($firstMealPattern == 'Meal')
      {
          return view('user.showmeal',['meals'=>$meals]);
      }

    }
    return redirect()->route('user.catgory')->with('message', 'this catgory is empty');
   }
}

