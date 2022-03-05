<?php

namespace App\Http\Controllers;

use App\ContactUs;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $contacts=ContactUs::orderBy('updated_at','desc')->paginate(10);
        if($request->ajax()){

            return ['data'=>$contacts];
        }

        return view('dashboard.contact_us.index',compact('contacts'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'replay_text' => 'required',
//            'type' => 'required',
        ]);
        $contact=ContactUs::where('id',$request->id)->first();

        $contact->update([
            'is_replay' => 1,
            'replay_text'=>$request->replay_text,
            'type'=>$request->type
        ]);
        $data=['name'=>$contact->name,'msg'=>$request->replay_text,'type'=>$request->type];
        $setting=Setting::find(1);
        Mail::send('emails.reply_msg',['data'=>$data],function($message) use($contact,$setting){
            $message->to($contact->email,$contact->name)->subject('Reply For -'. $contact->message);
            $message->from($setting->email,' Pizza');

        });


        return ['message'=>'تمت الاضافة بنجاح ','contact'=>$contact];

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContactUs $contact)
    {
        $contact->delete();
        return ['message'=>'تم الحذف بنجاح ','contact'=>$contact];
    }
    public function replay(Request $request){





    }
}
