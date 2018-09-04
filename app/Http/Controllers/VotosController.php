<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Voto;
use App\Http\Requests;

class VotosController extends Controller
{
    public $mais;
    public $menos;
    function getMais() {
        return Voto::orderBy('votos', 'desc')->orderBy('numero')->limit(13)->get(); 
    }

    function getMenos() {
        return Voto::orderBy('votos')->orderBy('numero')->limit(13)->get();
    }

    public function getFrequencia(){
        $frequencia = new \stdClass();
        $frequencia->mais = $this->getMais();
        $frequencia->menos = $this->getMenos();
        return $frequencia;
    }
}
