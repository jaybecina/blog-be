<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;

// use App\Repositories\PostRepository;
// use App\Services\PostService;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

use App\Http\Resources\PostResource;

use App\Models\Post;


class PostController extends Controller
{
    // private $repository;
    // private $service;

    // public function __construct(PostRepository $repository, PostService $service)
    // {
    //     $this->repository = $repository;
    //     $this->service = $service;
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $news = $this->repository->all();
        try {
            $posts = Post::paginate(10);
            return PostResource::collection($posts);
        } catch (\Throwable $th) {
            return response()->json([
                "status" => 400,
                'error' => 'Error: ' . $th->getMessage()
            ], 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        
            // $post = $this->service->store($request->only('title', 'content'));
            DB::beginTransaction();

            try {
                $posts = Post::create($request->all());
                DB::commit();

                // return new PostResource($posts);
                return response()->json([
                    "status" => 200,
                    "data" => $posts,
                    "message" => "New post successfully saved"
                ]);

            } catch (\Throwable $th) {
                return response()->json([
                    "status" => 400,
                    'error' => 'Error: ' . $th->getMessage()
                ], 400);
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $news = $this->repository->getById($id);
        try {
            $posts = Post::findOrFail($id);

            return new PostResource($posts);
            
        } catch (\Throwable $th) {
            return response()->json([
                "status" => 400,
                'error' => 'Error: ' . $th->getMessage()
            ], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, $id)
    {
        // $post = $this->service->store($request->only('title', 'content'));
        DB::beginTransaction();

        try {
            $post = Post::findOrFail($id);
            $post->title = $request->title;
            $post->description = $request->description;
            $post->save();
            DB::commit();

            // return new PostResource($posts);
            return response()->json([
                "status" => 200,
                "data" => $post,
                "message" => "Post successfully updated"
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                "status" => 400,
                'error' => 'Error: ' . $th->getMessage()
            ], 400);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $post = Post::findOrFail($id);
            $post->delete();
            DB::commit();

            // return new PostResource($posts);
            return response()->json([
                "success" => 200,
                "data" => $post,
                "message" => "Post successfully deleted",
            ]);

        } catch (\Throwable $th) {
            return response([
                "status" => 400,
                'error' => 'Error: ' . $th->getMessage()
            ], 400);
        }
    }
}
