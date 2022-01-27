<?php namespace App\Traits;


trait ResponseTrait {

    public function successResponse($data, $status, $message) {
        return response()->json([
            "statuscode" => $status,
            "status" => $message,
            "data" => $data
        ]);
    }
}

?>