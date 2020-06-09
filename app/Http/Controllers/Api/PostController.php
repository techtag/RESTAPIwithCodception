<?php

namespace App\Http\Controllers\Api;

use App\Post;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $posts=Post::paginate(3,[Post::TITLE,Post::CONTENT])->toArray();
            
            if(empty($posts['data'])){
                throw new \Exception('No Records Found',404);
            }
            return response($posts);
        }catch(\Exception $e){
            return response(['message' => $e->getMessage()],$e->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $validator=Validator::make(
           $request->all(),
           [
               Post::TITLE => 'required',
               Post::CONTENT => 'required',
               Post::PRIMARY_IMAGE => 'required',
               Post::THUMBNAIL_IMAGE => 'required',
               Post::SLUG => 'required',
               Post::AUTHOR => 'required',
           ]
        );
       
       try{
        if ($validator->fails()){
            throw new \Exception('Failed',400);
        }   
        $post = new Post();
        $post->setAttribute(Post::TITLE, $request->get(Post::TITLE));
        $post->setAttribute(Post::CONTENT, $request->get(Post::CONTENT));
        $post->setAttribute(Post::PRIMARY_IMAGE, $request->get(Post::PRIMARY_IMAGE));
        $post->setAttribute(Post::THUMBNAIL_IMAGE, $request->get(Post::THUMBNAIL_IMAGE));
        $post->setAttribute(Post::SLUG, $request->get(Post::SLUG));
        $post->setAttribute(Post::AUTHOR, $request->get(Post::AUTHOR));
        $post->save();
        return response('Success');
       }catch(\Exception $e){
            return response(['message'=>$e->getMessage()],$e->getCode());
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
        try{
            $post=Post::find($id);

            if(!$post){
                throw new \Exception('Cannot find record', 404);
            }

            $post=[
                'data'=>[
                    $post->id => [
                        POST::TITLE => $post->title,
                        POST::CONTENT => $post->content
                    ]
                ]
            ];
            return response($post);
        }catch(\Exception $e){
            return response(['message' => $e->getMessage()], $e->getCode());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $post=Post::where(Post::ID,$id)->first();
            if(!$post){
                throw new \Exception("Cant find record to update",404);
            }
            $post->setAttribute(Post::TITLE, $request->get(Post::TITLE));
            $post->setAttribute(Post::CONTENT, $request->get(Post::CONTENT));
            // $post->setAttribute(Post::PRIMARY_IMAGE, $request->get(Post::PRIMARY_IMAGE));
            // $post->setAttribute(Post::THUMBNAIL_IMAGE, $request->get(Post::THUMBNAIL_IMAGE));
            // $post->setAttribute(Post::SLUG, $request->get(Post::SLUG));
            // $post->setAttribute(Post::AUTHOR, $request->get(Post::AUTHOR));
            $post->save();
            return response([
                'data'=>[
                    $post->id => [
                        POST::TITLE => $post->getAttribute(Post::TITLE),
                        POST::CONTENT => $post->getAttribute(Post::CONTENT),
                    ]
            ]]);
        }catch(\Exception $e){
            return response(['message'=>$e->getMessage()],$e->getCode());
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
        try{
            $deleted=Post::destroy($id);
            if(!$deleted){
                throw new \Exception('Could not find record to delete',404);
            }
            return response('Success');
        }catch(\Exception $e){
            return response(['message'=>$e->getMessage()],$e->getCode());
        }
    }
}
