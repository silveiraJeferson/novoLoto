<?php

namespace App\Http\Controllers;

use App\Numero;
use Illuminate\Http\Request;
use App\Http\Requests;

class ConferenciaController extends Controller {

    public $indice;
    public $numero;
    public $jogo;
    public $jogos;
    public $conferido;

    function getConferido() {
        return $this->conferido;
    }

    function setConferido($conferido) {
        $this->conferido[] = $conferido;
    }

    function getIndice() {
        return $this->indice;
    }

    function getNumero() {
        return $this->numero;
    }

    function getJogo() {
        return $this->jogo;
    }

    function getJogos() {
        return $this->jogos;
    }

    function setIndice($indice) {
        $this->indice = $indice;
    }

    function setNumero($numero) {
        $this->numero = $numero;
    }

    function setJogo($jogo) {
        $this->jogo = $jogo;
    }

    function setJogos($jogos) {
        $this->jogos = $jogos;
    }

    public function getJogoRepetido() {
        
    }

    public function getSugestaoRepetida() {
        session()->put('alerta', 'Não existem jogos repetidos!');
        $this->setJogos(session()->get('relatorio'));
        foreach ($this->getJogos() as $jogo) {
            $this->setJogo($jogo);

            foreach ($this->getJogos() as $aux) {
                $count = 0;
                $repetido = 0;
                for ($i = 0; $i <= count($aux) - 1; $i++) {

                    if ($aux[$i] == $this->getJogo()[$i]) {
                        $count++;
                    }
                    if ($count == count($aux)) {
                        $repetido++;
                    }
                }
                if ($repetido >= 2) {
                    $array = [];
                    foreach ($this->getJogo() as $numero) {
                        $n = new Numero();
                        $n->valor = $numero;
                        $n->msg = 'red';
                        $array[] = $n;
                    }
                    session()->put('alerta', 'Existem jogos repetidos!');
                } else {
                    $array = [];
                    foreach ($this->getJogo() as $numero) {
                        $n = new Numero();
                        $n->valor = $numero;
                        $n->msg = '';
                        $array[] = $n;
                    }
                }
                
            }
            $this->setConferido($array);
            
        }
        
        session()->put('conferido', $this->getConferido());
        
        return view('loto.folder.conferido');
    }
}