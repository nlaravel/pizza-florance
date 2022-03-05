<?php

namespace App\Http\Controllers;

use App\City;

use App\State;
use App\ZipCode;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $city =City::with('states')->orderBy('updated_at','desc')->paginate(10);
        if($request->ajax()){



            return ['data'=>$city];
        }



        return view('dashboard.city.index',compact('city'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $state=State::all();
        $zip_codes=ZipCode::all();
        return view('dashboard.city.form',compact('state','zip_codes'));

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
            'name' => 'required',
            'state_id' => 'required',

        ]);


        $create = City::create([
            'name' => $request->name,
            'state_id' => $request->state_id,


        ]);
        $zip_codes= $request->zip_codes;
        foreach ($zip_codes as $zip_code) {
            //  dd($extra);
            $zip_code = new ZipCode([
                'zip_code' => $zip_code['zip_code'],
                'city_id' => $create->id,
            ]);

            $zip_code->save();
        }


        return ['message' => 'تمت الاضافة بنجاح ', 'city' => $create];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {

        $city->states;
        $city->zip_codes;
        $zip_codes=ZipCode::all();
        $state=State::all();

        return view('dashboard.city.form',compact('state','city','zip_codes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        $this->validate($request,[
            'name'=>'required',
            'state_id'=>'required',
        ]);
        $zip_codes= $request->zip_codes;
      //  ZipCode::where('product_id', $city->id)->delete();
        if($zip_codes){
            ZipCode::where('city_id', $city->id)->delete();
            foreach ($zip_codes as $zip_code) {
                //  dd($extra);
                $zip_code = new ZipCode([
                    'zip_code' => $zip_code['zip_code'],
                    'city_id' => $city->id,
                ]);

                $zip_code->save();
            }
        }
        $city->update([
            'name'=>$request->name,
            'state_id'=>$request->state_id,
            'zip_code'=>$request->zip_code,
        ]);


        return ['message'=>'تم التعديل بنجاح','city'=>$city];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        $city->delete();
        return ['message'=>'تم الحذف بنجاح ','city'=>$city];

    }

}
