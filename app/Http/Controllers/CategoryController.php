<?php

namespace App\Http\Controllers;

use App\Category;
use App\GeneralSize;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      //  $parentCategories=Category::where('parent_id',0)->get();
       // dd($parentCategories);
        $category =Category::orderBy('updated_at','desc')->paginate(10);
        if($request->ajax()){

            return ['data'=>$category];
        }



        return view('dashboard.category.index',compact('category'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.category.form');

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
            'image'=>'required',
            'name'=>'required',
        ]);
        $category = Category::create([
            'name' => $request->name,
            'image' => $request->image,
            //'parent_id' => $request->parent_id,
            'add_size' => $request->add_size,

        ]);

        $sizes = $request->sizes;
        foreach ($sizes as $size) {

            $size = new GeneralSize([
                'size' => $size['size'],
                'price' => $size['price'],
                'category_id' => $category->id,
            ]);

            $size->save();
        }
        $message = 'Saved Successfully';

        return response()->json(compact('message'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $category->categoryParent;
        $category->sizes;
        return view('dashboard.category.form',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $this->validate($request,[
            'image'=>'required',
            'name'=>'required',
        ]);
        $sizes= $request->sizes;
        $category->update([
            'name' => $request->name,
            'image' => $request->image,
            'add_size' => $request->add_size,
        ]);
        if($sizes){
            GeneralSize::where('category_id', $category->id)->delete();
            foreach ($sizes as $size) {

                $size = new GeneralSize([
                    'size' => $size['size'],
                    'price' => $size['price'],
                    'category_id' => $category->id,
                ]);

                $size->save();
            }

        }

        return ['message'=>'Saved Changed','category'=>$category];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
         $category->delete();
        return ['message'=>'Deleted  Successfully','category'=>$category];
    }
}
