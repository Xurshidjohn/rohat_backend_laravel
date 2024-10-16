<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use function Spatie\ErrorSolutions\get;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Message::all();
        if($data) {
            return response(
                [
                    'status' => 'successfully',
                    'message' => 'All messages have been retrieved successfully.',
                    'data' => $data,
                ]
            );
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if($request->sender_name && $request->sender_number && $request->description) {
            $message = new Message();
            $message->sender_name = $request->sender_name;
            $message->sender_number = $request->sender_number;
            $message->description = $request->description;
            $message->save();
            if($message) {
                return response()->json(
                    [
                        'status' => 'successfully',
                        'message' => 'Successfully Created Message',
                        'data' => $message,
                    ]
                );
            }
        } else {
            return response()->json(
                [
                    'status' => 'unsuccessfully',
                    'message' => "Please enter all fields",
                ]
            );
        }
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
        $data = Message::find($id);
        if($data) {
            return response()->json(
                [
                    'status' => 'successfully',
                    'message' => 'The requested resource was found successfully.',
                    'data' => $data
                ]
            );
        } elseif(!$data) {
            return response()->json(
                [
                    'status' => 'unsuccessfully',
                    'message' => 'Message is not found.',
                ]
            );
        }
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
        $user = Message::find($id)->delete();
        if($user) {
            return response()->json(
                [
                    'status' => 'successfully',
                    'message' => 'message successfully deleted.',
                ]
            );
        }
    }
}
