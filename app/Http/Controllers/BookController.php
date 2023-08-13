<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Http\Resources\BookResource;
use App\Http\Resources\GenreResource;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\Request;

class BookController extends Controller
{
    protected $model;
    public function __construct()
    {
        $this->model = new Book();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = $this->model::with("genre","author")->paginate(10);
        $paginationLinks = getPaginationLinks($books);
        return $this->success(__("common.listing_records"),BookResource::collection($books->items()),pagination: $paginationLinks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookRequest $request)
    {
        $validatedData = $request->validated();
        $this->model->fill($validatedData);
        $res = $this->model->save();
        if ($res){
            return $this->success(__("common.record_created"),$res);
        }
        return $this->failure(__("common.something_wrong"));
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return $this->success(__("common.record_details"),$book);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookRequest $request, Book $book)
    {
        $data = $request->validated();
        $book->fill($data);
        $res =$book->save();

        if ($res){
            return $this->success(__("common.record_updated"),$res);
        }
        return $this->failure(__("common.something_wrong"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $res = $book->delete();
        if ($res){
            return $this->success(__("common.record_deleted"),$res);
        }
        return $this->failure(__("common.something_wrong"));
    }
}
