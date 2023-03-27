<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Book::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name"=>"required",
            "author"=>"required",
            "price"=>"required"
        ]);

        $book = new Book();
        $book->name = $request->name;
        $book->slug = Str::slug($request->name);
        $book->desc = $request->desc;
        $book->author = $request->author;
        $book->price = $request->price;
        $book->save();
        return ($book);
        
        //return Book::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Book::find($id);
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
        /*
        $book = Book::find($id);
        $book->update($request->all());
        return $book;
        */
        $request->validate([
            "name"=>"required",
            "author"=>"required",
            "price"=>"required",
        ]);

        $book = Book::find($id);
        $book->name = $request->name;
        $book->slug = Str::slug($request->name);
        $book->desc = $request->desc;
        $book->author = $request->author;
        $book->price = $request->price;
        $book->save();
        return ($book);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Book::destroy($id);
    }

    /**
     * Search for a name
     *
     * @param  str  $name
     * @return \Illuminate\Http\Response
     */
    public function search($name)
    {
        return Book::where('name', 'like', '%'.$name.'%')->get();
    }
}
