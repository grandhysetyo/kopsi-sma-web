<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;

class FrontCtrl extends Controller
{
    
    public function getDataInfo(){
        $info =[
                [
                    "id"=> 3, 
                    "info_id"=> 3,
                    "title"=> "Judul Terbaru 3", 
                    "desc"=> "Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet" ,
                    "date"=> "23 April 2021"
                ],
                [
                    "id"=> 2, 
                    "info_id"=> 2,
                    "title"=> "Judul Terbaru 2", 
                    "desc"=> "Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet" ,
                    "date"=> "20 April 2021"
                ],
                [
                    "id"=> 1, 
                    "info_id"=> 1,
                    "title"=> "Judul Terbaru 1", 
                    "desc"=> "Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet" ,
                    "date"=> "2 April 2021"
                ],
            ];
        return response()->json($info);
    }
    public function getDataTeaser(){
        $linkTeaser = ["linkID"=> "2oH1-5Jc0Z8"];
        return response()->json($linkTeaser);
    }
}