<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenreRequest;
use App\Http\Resources\GenreResource;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    protected $model;
    public function __construct()
    {
        $this->model = new Genre();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $genres = $this->model::paginate(10);
        $paginationLinks = getPaginationLinks($genres);
        return $this->success(__("common.listing_records"),GenreResource::collection($genres->items()),pagination: $paginationLinks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GenreRequest $request)
    {
        $validatedData = $request->validated();

        $genre =    $this->model::create([
            "name"=>$validatedData['name']
        ]);
        if ($genre)
        {
            return $this->success(__("common.record_created"),$genre);
        }
        return $this->failure(__("common.something_wrong"));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $genre = $this->model::find($id);
            $genre = $genre->load("books");
            return $this->success(__("common.record_details"),$genre);
        }catch (\Throwable $throwable){
            return $this->failure($throwable->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GenreRequest $request, Genre $genre)
    {
        $data = $request->validated();
        $res = $genre->update([
            "name"  =>  $data['name']
        ]);
        if ($res){
            return $this->success(__("common.record_updated"),$res);
        }
        return $this->failure(__("common.something_wrong"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Genre $genre)
    {
        $res = $genre->delete();
        if ($res){
            return $this->success(__("common.record_deleted"),$res);
        }
        return $this->failure(__("common.something_wrong"));
    }
}
