<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorRequest;
use App\Http\Resources\AuthorResource;
use App\Http\Resources\GenreResource;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorController extends Controller
{
    protected $model;
    public function __construct()
    {
        $this->model = new Author();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $genres = $this->model::paginate(10);
        $paginationLinks = getPaginationLinks($genres);
        return $this->success(__("common.listing_records"),AuthorResource::collection($genres->items()),pagination: $paginationLinks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AuthorRequest $request)
    {
        $validatedData = $request->validated();
        $this->model->fill($validatedData);
        $author = $this->model->save();
        if ($author)
        {
            return $this->success(__("common.record_created"),$genre);
        }
        return $this->failure(__("common.something_wrong"));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $author = $this->model::find($id);
            $author = $autho->load("books");
            return $this->success(__("common.record_details"),$author);
        }catch (\Throwable $throwable){
            return $this->failure($throwable->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AuthorRequest $request, string $id)
    {
        $data = $request->validated();
        $this->model->fill($data);
        $res = $this->model->save();
        if ($res){
            return $this->success(__("common.record_updated"),$res);
        }
        return $this->failure(__("common.something_wrong"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        $res = $author->delete();
        if ($res){
            return $this->success(__("common.record_deleted"),$res);
        }
        return $this->failure(__("common.something_wrong"));
    }
}
