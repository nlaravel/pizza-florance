<?php
function getPublicPathOnServer(){
    // just for check if this on local server or production server
    if($_SERVER['SERVER_NAME']=='pizza.test'){
        return public_path();
    }
    return '/home/ddr4r/public_html';
}


function saveFile($file, $direction)
{

    $mime = $file->getClientOriginalExtension();

    $dir = '/images/'. $direction ;
    File::exists(getPublicPathOnServer().'/images/'. $direction .'/') or File::makeDirectory(getPublicPathOnServer().'images/'.$direction, 0755, true);
    File::exists(getPublicPathOnServer() .'/'. $dir) or File::makeDirectory(getPublicPathOnServer(). $dir, 0755, true);


    $file_name = rand(10000, 99999) . '.' . $mime;
    $file->move(getPublicPathOnServer().$dir, $file_name);
//    $file->move(getPublicPathOnServer() .'/'. $dir . '/thump_770/' .$file_name);
//    $file->move(getPublicPathOnServer() .'/'. $dir . '/thump_370/' .$file_name);
//    $file->move(getPublicPathOnServer() .'/'. $dir . '/thump_120/' .$file_name);


    $data = ['name'=>$file_name,'path'=>$dir.'/'.$file_name];
    return $data ;

}

