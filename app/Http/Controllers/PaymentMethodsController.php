<?php

namespace App\Http\Controllers;


use App\PaymentMethods;
use Illuminate\Http\Request;

class PaymentMethodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $payment =PaymentMethods::orderBy('updated_at','desc')->paginate(10);
        if($request->ajax()){

            return ['data'=>$payment];
        }



        return view('dashboard.payment.index',compact('payment'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.payment.form');

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
        $payment = PaymentMethods::create([
            'name' => $request->name,
            'image' => $request->image,

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
    public function show(PaymentMethods $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentMethods $payment)
    {

        return view('dashboard.payment.form',compact('payment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaymentMethods $payment)
    {
        $this->validate($request,[
            'image'=>'required',
            'name'=>'required',
        ]);

        $payment->update([
            'name' => $request->name,
            'image' => $request->image,
        ]);


        return ['message'=>'Saved Changed','payment'=>$payment];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentMethods $payment)
    {
        $payment->delete();
        return ['message'=>'Deleted  Successfully','payment'=>$payment];
    }
}
