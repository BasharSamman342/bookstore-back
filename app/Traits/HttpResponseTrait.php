<?php
namespace App\Traits;


use Illuminate\Http\Response;

trait HttpResponseTrait
{
    protected function success($message, $data=[], $pagination=null, $count=null, $status = Response::HTTP_OK)
    {
        $response=['message'=>$message, 'data'=>$data];
        if(!empty($count)){
            $response['count']=$count;
        }
        if(!empty($pagination)){
            $response['pagination']=$pagination;
        }
        return response()->json($response, $status);
    }

    protected function failure($errors=[], $status = Response::HTTP_INTERNAL_SERVER_ERROR)
    {
        return response()->json([
            'errors' => $errors,
        ], $status);
    }


}

