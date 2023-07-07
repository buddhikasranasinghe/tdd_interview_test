<?php

namespace App\Http\Controllers;

use App\Contracts\SubscribeContract;
use App\Contracts\UserContract;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class SubscribeController extends Controller
{
    public $subscriberContract;
    public $userContract;

    public function __construct(
        SubscribeContract $subscriberContract, 
        UserContract $userContract
    )
    {
        $this->subscriberContract = $subscriberContract;
        $this->userContract = $userContract;
    }

    public function store(Request $request): JsonResponse
    {
        $validation = Validator::make($request->all(), [
            'email' => 'required|email',
            'website_id' => 'required'
        ]);
    
        if ($validation->fails()) {
            return response()->json(['errors' => $validation->errors()], 422);
        }

        $status = $this->checkUserExist($request->email);

        if (!$status) {
            $this->userContract->createNewUser($request->email);
        }

        $user_id = $this->userContract->getUserId($request->email);

        $response = $this->subscriberContract->storeSubscriber([
            'user_id' => $user_id['user'],
            'website_id' => $request->website_id
        ]);
        
        $status = $response['success'] ? 201 : 500;
        
        return response()->json(['message' => $response['message']], $status);
    }

    public function checkUserExist(string $email): bool
    {
        $response = $this->userContract->checkUserExist($email);
        if ($response['success'] && $response['status'] == 'found') {
            return true;
        } else if ($response['success'] && $response['status'] == 'not-found') {
            return false;
        } else {
            return false;
        }
    }
}
