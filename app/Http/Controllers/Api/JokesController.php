<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Joke;

class JokesController extends Controller
{
    public function index()
    {
        return response()->json(Joke::all());
    }
}
