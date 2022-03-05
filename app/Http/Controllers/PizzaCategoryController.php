<?php

namespace App\Http\Controllers;

use App\PizzaCategory;
use Illuminate\Http\Request;

class PizzaCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $parentCategories=PizzaCategory::where('parent_id',0)->get();
        $pizza_category =PizzaCategory::with('categoryParent')->orderBy('updated_at','desc')->paginate(10);
        if($request->ajax()){

            return ['data'=>$pizza_category];
        }



        return view('dashboard.pizza_category.index',compact('pizza_category','parentCategories'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       // return view('dashboard.pizza_category.form');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request,[
            'name'=>'required',
        ]);
        $pizza_category = PizzaCategory::create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'price' => $request->price,
            'required' => $request->required,
        ]);

        $message = 'Saved Successfully';

        return response()->json(compact('message'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(PizzaCategory $pizza_category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(PizzaCategory $pizza_category)
    {
       // dd($pizza_category);
        $pizza_category->categoryParent;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PizzaCategory $pizza_category)
    {
        $this->validate($request,[
            'name'=>'required',
        ]);
        $pizza_category->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'price' => $request->price,
            'required' => $request->required,
        ]);


        return ['message'=>'Saved Changed','pizza_category'=>$pizza_category];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PizzaCategory $pizza_category)
    {
        $pizza_category->delete();
        return ['message'=>'Deleted  Successfully','pizza_category'=>$pizza_category];
    }
}
