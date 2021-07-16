<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{

    public function index()
    {
        // $alldata = Post::latest()->get();    //DESC
        $alldata = Post::get();
        return response(
                [
                    'success'   => true,
                    'message'   => 'All Data List',
                    'data'      => $alldata
                ], 200
            );
    }


    public function dataById($id)
    {
        $data = Post::whereId($id)->first();

        if($data) {
            return response()->json(
                [
                    'success'   => true,
                    'message'   => 'Data By Id',
                    'data'      => $data
                ], 200
            );
        }
    }


    public function save(Request $r)
    {
        $validator = Validator::make($r->all(),
            [
                'title'     => 'required',
                'content'   => 'required',
            ],
            [
                'title.required' => 'Title can not be empty',
                'content.required' => 'Content can not be empty',
            ]
        );

        if($validator->fails()) {

            return response()->json(
                [
                    'success' => false,
                    'message' => 'Insert the empty field',
                    'data'    => $validator->errors()
                ], 401
            );

        } else {

            $post = Post::create(
                [
                    'title'     => $r->input('title'),
                    'content'   => $r->input('content'),
                ]
            );

            if($post) {
                return response()->json(
                    [
                        'success'   => true,
                        'message'   => 'Data Saved',
                    ], 200
                );
            } else {
                return response()->json(
                    [
                        'success'   => false,
                        'message'   => 'Data Cannot Be Saved',
                    ], 401
                );
            }

        }
    }


    public function update(Request $r)
    {
        $validator = Validator::make($r->all(),
            [
                'title' => 'required',
                'content' => 'required'
            ],
            [
                'title.required'    => 'Title Cannot Be Empty',
                'content.required'    => 'Content Cannot Be Empty'
            ]
        );

        if($validator->fails()) {
            return response()->json(
                [
                    'success'   => false,
                    'message'   => 'Insert The Empty Field',
                    'data'      => $validator->errors()
                ], 401
            );
        } else {
            $update = Post::whereId($r->input('id'))->update(
                [
                    'title'     => $r->input('title'),
                    'content'   => $r->input('content')
                ]
            );

            if ($update) {
                return response()->json(
                    [
                        'success'   => true,
                        'message'   => 'Data Updated Successfully'
                    ], 200
                );
            } else {
                return response()->json(
                    [
                        'success'   => true,
                        'message'   => 'Data Update Failed'
                    ], 401
                );
            }

        }
    }


    public function delete($id)
    {
        $delete = Post::whereId($id)->delete();

        if($delete) {
            return response()->json(
                [
                    'success'   => true,
                    'message'   => 'Data Deleted Successfully'
                ], 200
            );
        } else {
            return response()->json(
                [
                    'success'   => false,
                    'message'   => 'Data Delete Failed'
                ], 401
            );
        }
    }

}
