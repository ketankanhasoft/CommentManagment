<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CommentController extends Controller
{
    public function store(Request $request)
    {
        // Validate the input data
        $validator = Validator::make($request->all(), [
            'client_id' => 'required|uuid',
            'email' => 'required|email',
            'phone_number' => 'nullable|digits_between:10,15',
            'name' => 'required|string',
            'comment' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Store the comment in the database
        $comment = Comment::create([
            'client_id' => $request->input('client_id'),
            'email' => $request->input('email'),
            'phone_number' => $request->input('phone_number'),
            'name' => $request->input('name'),
            'comment' => $request->input('comment'),
        ]);

        // Return a JSON response with the stored comment
        return response()->json(['comment' => $comment], 201);
    }

}
