<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Http\Resources\BookResource;

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
        return BookResource::collection(Book::orderBy('id','desc')->get());
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
            'body'=>'required|max:50|min:3',
           
        ]);

        $book = new Book();
        $book ->title = $request->title;
        $book ->body = $request->body;
        $book ->author_id = $request->author_id;
        $book->save();

        return response()->json(['message' => 'Book Created'], 200);
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
        return BookResource(Book::findOrFail($id));
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
            'body'=>'required|max:50|min:3',
           
        ]);

        $book = Book::findOrFail($id);
        $book ->title = $request->title;
        $book ->body = $request->body;
        $book ->author_id = $request->author_id;
        $book->save();

        return response()->json(['message' => 'Book Update'], 201);
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
