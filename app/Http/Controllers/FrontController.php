<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        return view('aplicacion.front.index', compact('rooms'));
    }
}
