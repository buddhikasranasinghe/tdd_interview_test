<?php

namespace App\Http\Controllers;

use App\Contracts\PostContract;
use App\Http\Requests\PostRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    protected $postContract;

    public function __construct(PostContract $postContract)
    {
        $this->postContract = $postContract;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validation = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'website_id' => 'required'
        ]);
    
        if ($validation->fails()) {
            return response()->json(['errors' => $validation->errors()], 422);
        }

        $response = $this->postContract->addPost($request->all());
        
        $status = (int) 201;
        $user_list = (array) [];

        if ($response['success'] == 201) {
            $user_list = $this->postContract->getSubscribeUsers($request->website_id);
            $this->postContract->sendMails($request->all(), $user_list);
        } else {
            $status = (int) 500;
        }
        
        return response()->json(['message' => $response['message'], 'users' => $user_list], $status);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
