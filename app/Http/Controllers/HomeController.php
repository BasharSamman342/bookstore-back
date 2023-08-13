<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Author;

class HomeController extends Controller
{
    public function statistics()
    {
        $res = [];
        $res['books'] = Book::all()->count();
        $res['genres'] = Genre::all()->count();
        $res['authors'] = Author::all()->count();
        return $this->success(__("common.record_listing"),$res);
    }
}
