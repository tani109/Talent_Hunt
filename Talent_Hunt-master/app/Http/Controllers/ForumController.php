<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;
use App\User;
use App\Forum;
use App\Comment;


class ForumController extends Controller
{
    //
    public function index() {

        $posts = Forum::all();
        /*$people = ['Lopa', 'Abir', 'Partho'];*/
        $authUser = Auth::user();
        $users = User::all();
        return view('forum.index', [
            'authUser' => $authUser
            ])
            ->with('posts', $posts)
            ->with('users', $users)
            ;
    }

    public function create() {


        $authUser = Auth::user();
        return view('forum.create', [
            'authUser' => $authUser
        ]);
        //return view('forum.create');

    }

    public function store(Request $request) {

        // $data = $request->all();
        // return $data;
        $rules = [
            'title' => 'required',
            'category' => 'required',
            'body' => 'required'
        ];

         $data = $request->all();
        $validation = Validator::make($data, $rules);

        if ($validation->fails()) {
            return redirect()->back()->withInput()->withErrors($validation);
        }

        //Nothing in the forum model
        $forum = new Forum();

        $forum->title = $data['title'];
        $forum->category = $data['category'];
        $forum->details = $data['body'];
        $forum->user_id = Auth::user()->id;

        
        if($forum->save()) {
            return redirect()->route('forum.index')->with('success','Post Successfully Added');
        } else {
            return redirect()->route('forum.index')->with('error','Something went wrong');
        }
    }

    public function edit($id) {
        $post = Forum::findOrFail($id);
        $authUser = Auth::user();
        return view('forum.edit', [
            'authUser' => $authUser
            ])
            ->with('post', $post)
            ;
    }
    public function update(Request $request, $id) {

        // $data = $request->all();
        // return $data;
        $rules = [
            'title' => 'required',
            'category' => 'required',
            'details' => 'required'
        ];

        $data = $request->all();
        $validation = Validator::make($data, $rules);

        if ($validation->fails()) {

            return redirect()->back()->withInput()->withErrors($validation);
        }

        //"Nothing in the forum model";
        $forum = Forum::find($id);

        $forum->title = $data['title'];
        $forum->category = $data['category'];
        $forum->details = $data['details'];
        //$forum->user_id = Auth::user()->id;


        if($forum->save()) {
            return redirect()->route('forum.index')->with('success','Post Successfully Added');
        } else {
            return redirect()->route('forum.index')->with('error','Something went wrong');
        }

    }

    public function destroy($id)
    {
        try{
            Forum::destroy($id);

            return redirect()->route('forum.index')->with('success','Skill Deleted Successfully.');

        }catch(Exception $ex){
            return redirect()->route('forum.index')->with('error','Something went wrong.Try Again.');
        }
    }

    public function show_post($id) {

        $post = Forum::findOrFail($id);
        $authUser = Auth::user();
        return $comments =Forum::find($id)->comments;

        return view('forum.show_post', [
                'authUser' => $authUser
            ])
            ->with('post', $post)
            ->with('comments', $comments)
            ;
    }
}
