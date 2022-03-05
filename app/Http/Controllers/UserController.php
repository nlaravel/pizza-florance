<?php

namespace App\Http\Controllers;


use App\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $users=User::orderBy('updated_at','desc')->paginate(10);
        if($request->ajax()){



        return ['data'=>$users];
        }
        return view('dashboard.user.index',compact('users'));

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

        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'image' => $request->image,
            'password' => \Hash::make($request->password),
        ]);


        $message = 'تمت إضافة مستخدم جديد.';

        return response()->json(compact('message'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( User $user)
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
    public function update(Request $request, User $user)
    {

            $request['password'] =Hash::make($request->password);

        $user->update($request->all());

        return ['message'=>'تم التعديل بنجاح','user'=>$user];

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return ['message'=>'تم الحذف بنجاح ','user'=>$user];
    }





    public function getUserInformation ()
    {
        return view('dashboard.profile.index');

    }
    public function storeUserInformation(Request $request){
        // dd($request->all());
        $user = auth()->user();
        $currentPhoto = auth()->user()->image;
        $this->validate($request,[
            'email'=>'required',
            'name'=>'required',

        ]);

        if($request->password){
            $request->merge([
                'password'=>bcrypt($request->password)
            ]);
        }else{
            unset($request['password']);
        }


        $user->update($request->all());


        $message = 'تم تعديل بيانات المستخدم بنجاح';

        //return response()->json(compact('message'));
      //  return response()->json([ 'success' => 'You have successfully uploaded an image']);

        return response()->json([
            'status'=>true,
            'code'=>200,
            'data'=>$message
        ]);



    }




}
