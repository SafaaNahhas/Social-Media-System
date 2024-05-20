<?php

namespace App\Http\Traits;


trait ApiResponseTrait{

    public function apiResponse($data,$message,$status){
        $array=[
            'data'=>$data,
            'message'=>$message,
            'status'=>$status,
        ];
        return response()->json( $array,$status);
    }

}
