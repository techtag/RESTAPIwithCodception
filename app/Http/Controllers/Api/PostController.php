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
        $posts=Post::all();
        $posts=[
            'data'=>[
                $posts[0]->id=>[
                    POST::TITLE => $posts[0]->title,
                    POST::CONTENT => $posts[0]->content
                ],
                $posts[1]->id=>[
                    POST::TITLE => $posts[1]->title,
                    POST::CONTENT => $posts[1]->content
                ]
            ]
        ];
        return response($posts);
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
       }catch(\Exception $e){
            return response(['message'=>$e->getMessage()],$e->getCode());
       }
       

       return response('Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post=Post::find($id);
        $post=[
            'data'=>[
                $post->id => [
                    POST::TITLE => $post->title,
                    POST::CONTENT => $post->content
                ]
            ]
        ];
        return response($post);
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
        $post=Post::where(Post::ID,$id)->first();
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::destroy($id);
        return response('Success');
    }
}
