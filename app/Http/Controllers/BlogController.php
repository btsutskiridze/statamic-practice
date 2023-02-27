<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Statamic\Facades\Collection;
use Statamic\Facades\Entry;
use Statamic\View\View;

class BlogController extends Controller
{
    public function index()
    {
        $entries = Entry::query()
            ->where("collection", "blogs")
            ->get();

        return view("blogs.index", ["entries" => $entries]);
    }

    public function show($slug)
    {
        // $collections = Collection::findByHandle("pages");
        $blog = Entry::query()
            ->where("collection", "blogs")
            ->where("slug", $slug)
            ->first();
        // dd($blog);

        return view("blogs.show", ["blog" => $blog]);
    }

    public function filtered(Request $request)
    {
        $blogs = Entry::query()
            ->where("collection", "blogs")
            ->where("categories", $request->category)
            ->get();

        return (new View())
            ->template("blogs.index")
            ->layout("layout")
            ->with(["blogs" => $blogs]);
    }
}
