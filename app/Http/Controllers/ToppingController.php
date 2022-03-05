<?php

namespace App\Http\Controllers;

use App\Topping;
use Illuminate\Http\Request;

class ToppingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $topping =Topping::orderBy('updated_at','desc')->paginate(10);
        if($request->ajax()){

            return ['data'=>$topping];
        }



        return view('dashboard.topping.index',compact('topping'));

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
        $topping = Topping::create([
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
    public function show(Topping $topping)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Topping $topping)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Topping $topping)
    {
        $this->validate($request,[
            'name'=>'required',
            'price'=>'required',
        ]);
        $topping->update([
            'name' => $request->name,
            'price' => $request->price,
        ]);


        return ['message'=>'Saved Changed','topping'=>$topping];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Topping $topping)
    {
        $topping->delete();
        return ['message'=>'Deleted  Successfully','topping'=>$topping];
    }
}
