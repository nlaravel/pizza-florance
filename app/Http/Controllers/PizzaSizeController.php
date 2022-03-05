<?php

namespace App\Http\Controllers;

use App\PizzaSize;
use Illuminate\Http\Request;

class PizzaSizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $pizza_size =PizzaSize::orderBy('updated_at','desc')->paginate(10);
        if($request->ajax()){

            return ['data'=>$pizza_size];
        }



        return view('dashboard.pizza_size.index',compact('pizza_size'));

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
            'price'=>'required',
        ]);
        $pizza_size = PizzaSize::create([
            'name' => $request->name,
            'price' => $request->price,
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
    public function show(PizzaSize $pizza_size)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(PizzaSize $pizza_size)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PizzaSize $pizza_size)
    {
        $this->validate($request,[
            'name'=>'required',
            'price'=>'required',
        ]);
        $pizza_size->update([
            'name' => $request->name,
            'price' => $request->price,
        ]);


        return ['message'=>'Saved Changed','pizza_size'=>$pizza_size];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PizzaSize $pizza_size)
    {
        $pizza_size->delete();
        return ['message'=>'Deleted  Successfully','pizza_size'=>$pizza_size];
    }
}
