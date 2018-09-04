<?php

namespace App\Http\Controllers;
use App\Events\Atualizar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;

class LotoController extends Controller
{
    
    public function getIndex() {
        event(new Atualizar());
        return view('loto.folder.inicio');
    }
}
