<?php

namespace App\Http\Controllers;

use App\FileManger;
use Illuminate\Http\Request;

class FileMangerController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->search){

            $allImage =FileManger::where('photo_caption','LIKE',"%$request->search%")->orderBy('created_at','desc')->paginate(20);
            // dd($request->search,getStoreId(),$allImage);
        }else{
            $allImage =FileManger::orderBy('created_at','desc')->paginate(20);
        }


        return response()->json([
            'status'=>true,
            'code'=>200,
            'data'=>$allImage
        ]);
//dd($allImage);
    }



    public function fileMangerPage(Request $request){

        return view('dashboard.file_manger.index');

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FileMangerStore  $fileMangerStore
     * @return \Illuminate\Http\Response
     */
    public function show(FileManger $fileManger)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FileMangerStore  $fileMangerStore
     * @return \Illuminate\Http\Response
     */
    public function edit(FileManger $fileManger)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FileMangerStore  $fileMangerStore
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FileManger $fileManger)
    {
        $fileManger->photo_caption = $request->photo_caption;
        $fileManger->save();
        return response()->json([
            'status'=>true,
            'code'=>200,
        ]);
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FileMangerStore  $fileMangerStore
     * @return \Illuminate\Http\Response
     */
    public function destroy(FileManger $fileManger)
    {
        if($fileManger){
            $url=getPublicPathOnServer().'/'.$fileManger->file_name;
            \File::delete($url);
            $fileManger->delete();

            return response()->json([
                'status'=>true,
                'code'=>200,
            ]);
        }
    }

    public function uploader(Request $request)
    {
        // dd($request->file);
        $this->validate($request,[

            'file'        =>  'required|file|mimes:jpeg,png,jpg,gif,jfif,webp,mp4'
        ]);
        $direction = 'image';
        $filename = saveFile($request->file,$direction);

        $file=$request->file;
        $type=$request->type??'photo';

        $create = FileManger::create([
            'name'=>$filename['name'],
            'file_name'=>$filename['path'],
            'photo_caption'=>$file->getClientOriginalName(),
            'type'=>$type,
        ]);

        $data=['success'=>true,'imageObject'=>$create,'name'=>$filename['path'],'path'=>asset($filename['path']),'real_name'=>$file->getClientOriginalName(),'type'=>$request->type];
        // dd($data);
        return $data;

    }




}
