<?php

namespace App\Http\Controllers;

use App\Category;
use App\Day;
use App\Entrees;
use App\EntreesProduct;
use App\Extra;
use App\Ingredient;
use App\Product;
use App\ProductDay;
use App\Size;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $product =Product::with('categories')
            ->with('days')
            ->where('is_special',0)
            ->orderBy('updated_at','desc')
            ->paginate(10);
        if($request->ajax()){



            return ['data'=>$product];
        }



        return view('dashboard.product.index',compact('product'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $extra=Extra::all();
        $ingredient=Ingredient::get();
        $category=Category::get();
        $day=Day::get();
        $entrees =Product::where('is_special',0)->orderBy('updated_at','desc')->get();
        return view('dashboard.product.form',compact('category','extra','day','ingredient','entrees'));

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
            'price' => 'required|numeric',
            'description' => 'required',
            'category_id' => 'required',
           // 'day' => 'required',
            //'ingredient' => 'required',
        ]);


        $create = Product::create([
            'image' => $request->image,
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'category_id' => $request->category_id,
            // 'day'=>json_encode($request->day),
            //  'ingredients'=>json_encode($request->ingredients),

        ]);


        $extras = $request->extras;
        $sizes = $request->sizes;
        $entrees = $request->tests;
       // dd($entrees);
        foreach ($extras as $extra) {
            //  dd($extra);
            $extra = new Extra([
                'name' => $extra['name'],
                'product_id' => $create->id,
                'price' => $extra['price']
            ]);

            $extra->save();
        }


//        if ($request->day) {
//            $dayIds = [];
//
//            foreach ($request->day as $day) {
//                if ($day) {
//                    $dayIds[] = $day['id'];
//                }
//
//            }
//            $create->days()->sync($dayIds);
//
//        }
        if ($request->ingredient) {
            $ingredientIds = [];
            foreach ($request->ingredient as $ingredient) {
                if ($ingredient) {
                    $ingredientIds[] = $ingredient['id'];
                }

            }
            $create->ingredients()->sync($ingredientIds);

        }
            foreach ($sizes as $size) {

                $size = new Size([
                    'size' => $size['size'],
                    'price' => $size['price'],
                    'product_id' => $create->id,
                    'image' => $size['image']
                ]);

                $size->save();
            }
        foreach ($entrees as $value) {

            $value = new EntreesProduct([
                'product_id' => $create->id,
                'entrees_id' => $value['entrees_id']
            ]);

            $value->save();
        }

        return ['message' => 'تمت الاضافة بنجاح ', 'product' => $create];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
//        $entrees =Entrees::with('product')->orderBy('updated_at','desc')->get();
//        $test=EntreesProduct::where('product_id',$product->id)->pluck('entrees_id')->toArray();
//        $test_entrees =Entrees::WhereIn('id',$test)->orderBy('updated_at','desc')->get();
        $entrees =Product::where('is_special',0)->where('id','!=',$product->id)->orderBy('updated_at','desc')->get();
        $test=EntreesProduct::where('product_id',$product->id)->pluck('entrees_id')->toArray();
        $test_entrees =Product::where('is_special',0)->WhereIn('id',$test)->orderBy('updated_at','desc')->get();
       // dd($test_entrees);
        $product->entrees;
        $product->categories;
        $product->ingredients;
        $product->days;
        $product->sizes;
        $category=Category::get();
        $day=Day::get();
        $ingredient=Ingredient::get();

        $diff_result = $entrees->diff($test_entrees);
        //dd($result);
        return view('dashboard.product.form',compact('product','category','day','ingredient','entrees','test_entrees','diff_result'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $this->validate($request,[
            'image'=>'required',
            'name'=>'required',
            'price'=>'required|numeric',
            'description'=>'required',
            'category_id'=>'required',
            // 'day'=>'required',
           // 'ingredient'=>'required',
        ]);
        $extras= $request->extras;
        $sizes= $request->sizes;
        $entrees =$request->tests;
        Extra::where('product_id', $product->id)->delete();
        if($extras){
            Extra::where('product_id', $product->id)->delete();
            foreach ($extras as $extra) {
                //  dd($extra);
                $extra = new Extra([
                    'name' => $extra['name'],
                    'product_id' => $product->id,
                    'price' => $extra['price']
                ]);

                $extra->save();
            }
        }

        $product->update([
            'image'=>$request->image,
            'name'=>$request->name,
            'price'=>$request->price,
            'description'=>$request->description,
            'category_id'=>$request->category_id,
           // 'day'=>json_encode($request->day),
           // 'ingredients'=>json_encode($request->ingredients),

        ]);
//        if($request->day){
//            $dayIds = [];
//            foreach ($request->day as $day) {
//                if ($day) {
//                    $dayIds[] = $day['id'];
//                }
//
//            }
//            $product->days()->sync($dayIds);
//
//        }
        if($request->ingredients){
            $ingredientIds = [];
            foreach ($request->ingredient as $ingredient) {
                if ($ingredient) {
                    $ingredientIds[] = $ingredient['id'];
                }

            }
            $product->ingredients()->sync($ingredientIds);

        }
        if($sizes){
            Size::where('product_id', $product->id)->delete();
            foreach ($sizes as $size) {

                $size = new Size([
                    'size' => $size['size'],
                    'price' => $size['price'],
                    'product_id' => $product->id,
                    'image' => $size['image']
                ]);

                $size->save();
            }

        }
        if($entrees) {
           // EntreesProduct::where('product_id', $product->id)->delete();
            foreach ($entrees as $value) {

                $value = new EntreesProduct([
                    'product_id' => $product->id,
                    'entrees_id' => $value['entrees_id']
                ]);

                $value->save();
            }
        }

        return ['message'=>'تم التعديل بنجاح','product'=>$product];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return ['message'=>'تم الحذف بنجاح ','product'=>$product];

    } public function product_entress($id)
    {
        $category=EntreesProduct::where('entrees_id',$id)->delete();
        return ['data'=>$category];


    }
}
