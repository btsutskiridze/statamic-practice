<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Statamic\Facades\Site;

class LayoutController extends Controller
{
    public function index()
    {
        return view("layout", ["site", Site::all()]);
    }
}
