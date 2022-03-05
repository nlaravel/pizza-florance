<?php

namespace App\Http\Controllers;

use App\Coupon;
use Illuminate\Http\Request;

class CouponsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $coupon =Coupon::orderBy('updated_at','desc')->paginate(10);
        if($request->ajax()){

            return ['data'=>$coupon];
        }



        return view('dashboard.coupon.index',compact('coupon'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.coupon.form');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // dd(date('Y-m-d', strtotime($request->expiry_date)));
        $this->validate($request,[
            'amount_type'=>'required',
            'coupon_code'=>'required|unique:coupons,coupon_code',
        ]);
        $coupon = Coupon::create([
            'coupon_code' => $request->coupon_code,
            'amount_type' => $request->amount_type,
            'amount' => $request->amount,
           'expiry_date' =>date('Y-m-d', strtotime($request->expiry_date)),
            'status' => $request->status,

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
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon)
    {
        return view('dashboard.coupon.form',compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {

        $this->validate($request,[
            'amount_type'=>'required',
            'coupon_code'=>'required|unique:coupons,coupon_code',
        ]);
        $coupon->update([
            'coupon_code' => $request->coupon_code,
            'amount_type' => $request->amount_type,
            'amount' => $request->amount,
            'expiry_date' => date('Y-m-d', strtotime($request->expiry_date)),
            'status' => $request->status,
        ]);

        return ['message'=>'Saved Changed','coupon'=>$coupon];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return ['message'=>'Deleted  Successfully','coupon'=>$coupon];
    }
}
