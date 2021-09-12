<?php

namespace App\Http\Controllers\Api;

use App\Models\Posts;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PostsController extends BaseController
{
    public function __construct(){
        $this->middleware('auth:api', ['except' => ['index','show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $news = Posts::latest()->get();//Динамичная, можно добавлять условия,сортировку и тд
        return $this->sendResponse($news);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
//    public function create()
//    {
//        //
//    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $attr = $this->validate($request,[
            'title' => 'required',
            'text' => 'required',
        ]);

        $attr['user_id'] = Auth::user()->id;
        $news = Posts::create($attr);

        return $this->sendResponse('Успех!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Posts  $posts
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Posts $posts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Posts  $posts
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Posts $posts)
    {
        $this->authorize('update', $posts);

        return $this->sendResponse($posts);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Posts  $posts
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Posts $posts)
    {
        $attr = $this->validate(request(),[
            'title' => 'required',
            'text' => 'required',
        ]);

        $posts->update(
            [
                'title' => request('title'),
                'text' => request('text'),
                'user_id' => auth()->id(),
            ]
        );
        return $this->sendResponse('Успех!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Posts  $posts
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Posts $posts)
    {
        $posts->delete();

        return $this->sendResponse('Удалено!');
    }

    public function myPosts(Request $request): \Illuminate\Http\JsonResponse
    {
        $posts = Auth::user()->posts()->latest()->get();

        return $this->sendResponse([
            'posts' => $posts
        ]);
    }

}
