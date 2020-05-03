<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Todo::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //(if the validation failed function will just redirect to home page. but here
        // im working on API which will get http requests from client so i have to send 
        //headers from the client include header: accept application/json to tell laravel return the error message to client)

        //if validation success then validate function will return the validated data as associated array
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'completed' => 'required|boolean'
        ]);

        //save returned data to db
        $todo = Todo::create($data);

        //return json response contain the added todo & 201 status
        return response($todo, 201);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todo $todo)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'completed' => 'required|boolean'
        ]);

        //CLient will send new data in body, & the id of updated todo in url & laravel will find todo with that id
        $todo->update($data);

        return response($todo, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();

        return response('Deleted Successfuly!!', 200);
    }
}
