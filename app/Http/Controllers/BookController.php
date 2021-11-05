<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Book::orderBy('id','desc')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title'=>'required|max:10|min:3',
            'body'=>'required|max:3|min:50',
           
        ]);

        $book = new Book();
        $book ->title = $request->title;
        $book ->body = $request->body;
        $author->save();

        return response()->json(['message' => 'Book Created'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return Book::findOrFail($id);
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
        //
        $request->validate([
            'title'=>'required|max:10|min:3',
            'body'=>'required|max:3|min:50',
           
        ]);

        $book = Book::findOrFail($id);
        $book ->title = $request->title;
        $book ->body = $request->body;
        $author->save();

        return response()->json(['message' => 'Book Update'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $isDelete = Book::destroy($id);
        if($isDelete == 1){
            return response()->json(['message'=>'Deleted'], 200);
        }else{
            return response()->json(['message' => 'Cannote delete, no id found'],404);
        }
    }
}
