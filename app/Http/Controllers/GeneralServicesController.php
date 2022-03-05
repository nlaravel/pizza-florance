<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\FileManger;

class GeneralServicesController extends Controller
{
    public function ImageUpload(Request $request){
        // dd($request->all());
        $allowed_extensions = ['pdf','PDF','txt','TXT','jpeg',"JPEG",'doc',"DOC",
            'png','PNG','jpg',"JPG","gif","GIF",'ppt',"PPT",'mp4',"MP4",'avi',"AVI",'xls','XLS','docx',
            'DOCX', 'pptx','PPTX' ,'xlsx', "XLSX",'rar',"RAR", "ZIP",'zip','psd','PSD','jfif']; // must be an array. Extensions disallowed to be uploaded
        $hidden_extensions = ['php'];
        $file = $request->null;
        $direction = 'image';
        $extension = \File::extension($file->getClientOriginalName());
        if(in_array($extension,$allowed_extensions)){
            $image =saveFile($file,$direction);
            $create = FileManger::create([
                'name'=>$file->getClientOriginalName(),
                'file_name'=>$image,
            ]);
            $data=['success'=>true,'imageObject'=>$create,'name'=>$image,'path'=>asset($image),'real_name'=>$file->getClientOriginalName(),'type'=>$request->type];
            return $data;
        }else{
            return \FileManger::json('error', 400);
        }
    }
}
