<?php

namespace App\Http\Controllers;

use App\CalzoneSize;
use Illuminate\Http\Request;

class CalzoneSizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $calzone_size =CalzoneSize::orderBy('updated_at','desc')->paginate(10);
        if($request->ajax()){

            return ['data'=>$calzone_size];
        }



        return view('dashboard.calzone_size.index',compact('calzone_size'));

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
        $calzone_size = CalzoneSize::create([
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
    public function show(CalzoneSize $calzone_size)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(CalzoneSize $calzone_size)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CalzoneSize $calzone_size)
    {
        $this->validate($request,[
            'name'=>'required',
            'price'=>'required',
        ]);
        $calzone_size->update([
            'name' => $request->name,
            'price' => $request->price,
        ]);


        return ['message'=>'Saved Changed','calzone_size'=>$calzone_size];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CalzoneSize $calzone_size)
    {
        $calzone_size->delete();
        return ['message'=>'Deleted  Successfully','calzone_size'=>$calzone_size];
    }
}
