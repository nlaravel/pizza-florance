<?php

namespace App\Http\Controllers;

use App\Category;
use App\Day;
use App\Entrees;
use App\Extra;
use App\Ingredient;
use App\Product;
use App\ProductDay;
use App\Size;
use Illuminate\Http\Request;

class EntreesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $entrees =Entrees::orderBy('updated_at','desc')->paginate(10);
        if($request->ajax()){



            return ['data'=>$entrees];
        }



        return view('dashboard.entrees.index',compact('entrees'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('dashboard.entrees.form');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'required',
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
        ]);


        $create = Entrees::create([
            'image' => $request->image,
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,

        ]);


        return ['message' => 'تمت الاضافة بنجاح ', 'entrees' => $create];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Entrees $entrees)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       // dd($entrees);
        $entrees=Entrees::where('id',$id)->first();
        return view('dashboard.entrees.form',compact('entrees'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'image'=>'required',
            'name'=>'required',
            'price'=>'required',
            'description'=>'required',
        ]);
        $entrees=Entrees::where('id',$id)->first();

        $entrees->update([
            'image'=>$request->image,
            'name'=>$request->name,
            'price'=>$request->price,
            'description'=>$request->description,
        ]);

        return ['message'=>'تم التعديل بنجاح','entrees'=>$entrees];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $entrees=Entrees::where('id',$id)->first();
        $entrees->delete();
        return ['message'=>'تم الحذف بنجاح ','entrees'=>$entrees];

    }
}
