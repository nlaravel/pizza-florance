<?php

namespace App\Http\Controllers;

use App\Coupon;
use App\Invoice;
use App\Order;
use App\Person;
use App\Setting;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $user =Order::with('people')->with('products')->orderBy('updated_at','desc')->pluck('person_id')->toArray();
        //dd($user);
        $order=Person::where('status','active')->whereIn('id',$user)->paginate(10);
        if($request->ajax()){



            return ['order'=>$order];
        }



        return view('dashboard.order.index',compact('order'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($user_order)
    {
         $user=Person::where('id',$user_order)->first();

        $orders=Order::where('person_id',$user_order)->with('people')
            ->with('products')->with('OrderSpecialPizzaSize')
            ->with('OrderSpecialPizzaTypes')
            ->with('OrderPizzaSize')
            ->with('OrderPizzaExtras')
            ->get();
        $invoice=Invoice::where('order_status','active')->with('people')->where('person_id',$user_order)->first();
        $coupon_value=Coupon::where('coupon_code',$invoice->coupon_code)->first();
        $setting=Setting::first();
       // dd($coupon_value);

        return view('dashboard.order.form',compact('orders','user_order','user','invoice','coupon_value','setting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return ['message'=>'Deleted  Successfully','order'=>$order];
    }
}
