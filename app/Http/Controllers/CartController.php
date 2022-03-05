<?php

namespace App\Http\Controllers;
use App\CalzoneCategry;
use App\CalzoneSize;
use App\Coupon;
use App\EntreesProduct;
use App\Extra;
use App\PizzaCategory;
use App\PizzaSize;
use App\Product;
use App\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CartController extends Controller
{
public function product()
{
$products = Product::where('is_special',0)->get();
//dd($products);
return view('front.product',compact('products'));
}

    public function category_product($id)
    {
        $products = Product::with('sizes')
            ->where('is_special',0)
            ->where('id',$id)
            ->with('categories')
            ->with('extras')
            ->first();
      // dd($products->id);
        $entrees=EntreesProduct::where('product_id',$id) ->pluck('entrees_id')->toArray();
        $entrees_product=Product::whereIn('id',$entrees) ->get();
//dd($entrees_product);
        return view('front.category_product',compact('products','entrees_product' ));
    }

      public function cart()  {
    $cartCollection= \Cart::getContent();
//dd($cartCollection);
    return view('front.cart');
//return view('front.cart')->withTitle('E-COMMERCE STORE | CART')->with(['cartCollection' =>$cartCollection]);
}

    public function add(Request $request){

        if($request->card_id){
            $cart = \Cart::get($request->card_id);

            $cart->options['instructions']=$request->details;

            $message ='Instruction Added';
            return response()->json(['message'=>$message ]);

        }

        Session::forget('couponAmount');
        Session::forget('couponCode');
      $extras=$request->extras;
        $id=$request->name[0];
        $product_size=Size::where('id',$id)->first();
        $product=Product::where('id',$product_size->product_id)->first();
        if($extras){

            $product_extras=Extra::whereIn('id',$extras)->get();
            $data=\Cart::add(['id' => $product,'name' => $product->name,
                'qty' => $request->quantity,'price'=>$request->price,
                'options' => array(
                'instructions' => $request->instructions,
                'image' => $product_size->image,
                  'size' => $product_size->size,
                    'price_size' => $product_size->price,
                    'extras' =>  $product_extras
                )
            ]);

        }else{
            $data=\Cart::add(['id' => $product,'name' => $product->name,
                'qty' => $request->quantity,'price'=>$request->price,
                'options' => array(
                    'instructions' => $request->instructions,
                    'image' => $product_size->image,
                    'size' => $product_size->size,
                    'price_size' => $product_size->price,
                )
            ]);
        }
        return response()->json([
            'data'=>['cart_id'=>$data->rowId,'product_id'=>$product->id]
        ]);
    }
    public function addToCart(Request $request){
        Session::forget('couponAmount');
        Session::forget('couponCode');

        $product=Product::where('id',$request->id)->first();
        \Cart::add([
            'id' => $product,
            'name' => $product->name,
            'qty' => $request->quantity,
            'price'=>$product->price,
            'options' => array(
                'instructions' => $request->instructions
            )
        ]);



           $message = 'Item is Added to Cart!';
         $title = 'Item is Added to Cart!';

           return response()->json(compact('message'));

    }

    public function addspecial(Request $request){
       // dd($request->card_id);
        if($request->card_id){
            $cart = \Cart::get($request->card_id);

            $cart->options['instructions']=$request->details;

            $message ='Instruction Added';
            return response()->json(['message'=>$message ]);

        }
        $this->validate($request, [
            'size'      => 'required',
        ],[],[
            'size'      => 'pizza size',
        ]);
      if($request->size !=null){
        Session::forget('couponAmount');
        Session::forget('couponCode');
             //dd($request->type);
       $product= Product::create([
            'name'=>'Special Pizza',
            'is_special'=>1,
        ]);
        $types=$request->type;
        if($types){

            $product_extras=PizzaCategory::whereIn('id',$types)->get();
            $pizza_size=PizzaSize::where('id',$request->size)->get();

            $data= \Cart::add(['id' => $product,'name' => $product->name,
                'qty' => $request->quantity,'price'=>$request->price,
                'options' => array(
                    'instructions' => $request->instructions,
                    'image' => $request->img,
                    'pizza_size' => $pizza_size,
                    'price_size' => $product_extras,
                    'types' =>  $product_extras
                )
            ]);
        }else {

            $data= \Cart::add(['id' => $product,'name' => $product->name,
                'qty' => $request->quantity,'price'=>$request->price,
                'options' => array(
                    'instructions' => $request->instructions,
                    'image' => $request->img,
                )
            ]);
        }

}

        return response()->json([
            'data'=>['cart_id'=>$data->rowId,'product_id'=>$product->id]
        ]);
        //return redirect()->route('product')->with('success_msg', 'Item is Added to Cart!');
    }

    public function addCalzoneSpecial(Request $request){
        if($request->card_id){
            $cart = \Cart::get($request->card_id);

            $cart->options['instructions']=$request->details;

            $message ='Instruction Added';
            return response()->json(['message'=>$message ]);

        }
        $this->validate($request, [
            'size'      => 'required',
        ],[],[
            'size'      => 'pizza calzone',
        ]);
        if($request->size !=null){
            Session::forget('couponAmount');
            Session::forget('couponCode');
            $product= Product::create([
                'name'=>'Special Calzone',
                'is_special'=>1,
            ]);
            $types=$request->type;
            if($types){

                $product_extras=CalzoneCategry::whereIn('id',$types)->get();
                $calzone_size=CalzoneSize::where('id',$request->size)->get();
                $data=  \Cart::add(['id' => $product,'name' => $product->name,
                    'qty' => $request->quantity,'price'=>$request->price,
                    'options' => array(
                        'instructions' => $request->instructions,
                        'image' => $request->img,
                        'pizza_size' => $calzone_size,
                        'types' =>  $product_extras
                    )
                ]);
            }else {

                $data=\Cart::add(['id' => $product,'name' => $product->name,
                    'qty' => $request->quantity,'price'=>$request->price,
                    'options' => array(
                        'instructions' => $request->instructions,
                        'image' => $request->img,
                    )
                ]);
            }


        }

        return response()->json([
            'data'=>['cart_id'=>$data->rowId,'product_id'=>$product->id]
        ]);

        //return redirect()->route('product')->with('success_msg', 'Item is Added to Cart!');
    }

    public function remove(Request $request){
        \Cart::remove($request->id);
        return redirect()->route('front.index')->with('success_msg', 'Item is removed!');
    }

    public function update(Request $request){
        Session::forget('couponAmount');
        Session::forget('couponCode');
        \Cart::update($request->id,$request->quantity);
        return redirect()->route('front.index')->with('success_msg', 'Cart is Updated!');
    }

    public function clear(){
        \Cart::destroy();
        return redirect()->route('front.index')->with('success_msg', 'Cart is cleared!');
    }

    public function applyCoupon(Request $request){
           //   dd(  Session::forget('couponAmount'));
        if ($request->ajax())
        {
        Session::forget('couponAmount');
        Session::forget('couponCode');
        // if coupon is empty
       $coupon_Count=Coupon::where('coupon_code',$request->coupon_code)->count();
       if($coupon_Count==0){
           $message='Coupon is not valid';
          // return redirect()->back()->with('alert_msg','Coupon is not valid');
          //return response()->json(['coupon_alert_msg','Coupon is not valid']);

       }
       else{
           // if coupon is not empty and its status active
           $coupon_Details=Coupon::where('coupon_code',$request->coupon_code)->first();
           if($coupon_Details->status==0){
               $message='Coupon is not active';


           }
           // if coupon is not empty and has expiry_date
           $expiry_data=$coupon_Details->expiry_date;
           $current_date=date('Y-m-d');
           if($expiry_data <$current_date){
               $message='coupon is expired';
           }
           // if coupon is not empty and has fixed amount of money
           if($coupon_Details-> amount_type == 'fixed'){
               $total_amount=\Cart::total();
               $coupon_Amount= $total_amount-($coupon_Details->amount) ;
               $message='copuon code successfully applied. You are availing discount';
           }else{
               // if coupon is not empty and has percent amount of money

               $total_amount=\Cart::total();
               $coupon_Amount= $total_amount*($coupon_Details->amount/100) ;
               $message='copuon code successfully applied. You are availing discount';

           }
           Session::put('couponAmount',$coupon_Amount);
           Session::put('couponCode',$request->coupon_code);


       }
    }
        return  Array(
            'Success' => $coupon_Amount,
            'Message' => $message
        );
        Session::flash('alert_msg', $message);
}

}
