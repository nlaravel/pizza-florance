<?php

namespace App\Http\Controllers;

use App\CalzoneCategry;
use Illuminate\Http\Request;

class CalzoneCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $parentCategories=CalzoneCategry::where('parent_id',0)->get();
        $calzone_category =CalzoneCategry::with('categoryParent')->orderBy('updated_at','desc')->paginate(10);
        if($request->ajax()){

            return ['data'=>$calzone_category];
        }



        return view('dashboard.calzone_category.index',compact('calzone_category','parentCategories'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('dashboard.calzone_category.form');

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
        $calzone_category = CalzoneCategry::create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
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
    public function show(CalzoneCategry $calzone_category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(CalzoneCategry $calzone_category)
    {
        // dd($calzone_category);
        $calzone_category->categoryParent;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CalzoneCategry $calzone_category)
    {
        $this->validate($request,[
            'name'=>'required',
        ]);
        $calzone_category->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'price' => $request->price,
        ]);


        return ['message'=>'Saved Changed','calzone_category'=>$calzone_category];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CalzoneCategry $calzone_category)
    {
        $calzone_category->delete();
        return ['message'=>'Deleted  Successfully','calzone_category'=>$calzone_category];
    }
}
