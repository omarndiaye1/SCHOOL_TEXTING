<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Service\BaseService;

class BaseControllers extends Controller {
	
    
    /**
     * Create a new controller instance.
     *
     * @param  {{modelName}}Repository  $users
     * @return void
     */
    public function __construct(BaseService $service)
    {
        $this->service = $service;
    }
    
	/**
	 *
	 * @param array $data        	
	 * @return 
	 */
	public static function sendSuccess($data = null, $message = null) {
	    return response()->json ( [ 
				'status'  => 'success',
				'code' 	  => JsonResponse::HTTP_OK,
				'message' => $message,
				'data' 	  => $data,
				'error' 	  => null 
		], JsonResponse::HTTP_OK );
	}
	/**
	 * 
	 * @param string  $errorMes
	 * @param number $code
	 * @return Object
	 */
	public static function sendError($errorMessage, $code = 404,$http_code=200) {
	    return response()->json([ 
				'status' => 'error',
				'code' => $code,
				'message' => '',
				'data' => null,
				'error' => [
                    $errorMessage
				] 
	    ], $http_code );
	}
}
