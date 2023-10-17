<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ForumsResource;
use App\Http\Resources\Api\PostsResource;
use App\Http\Resources\Api\UsersResource;
use App\Models\Forum;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class ForumsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ForumsResource::collection(Forum::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return new ForumsResource(Forum::findOrFail($id));
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
