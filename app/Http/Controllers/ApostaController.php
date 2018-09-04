<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use App\Voto;
use App\Sugestao;
use App\Aposta;

class ApostaController extends Controller {

    public $qtd_jogos;
    public $qtd_num;
    public $jogos = [];
    public $metodo;
    public $limite;
    public $array_limite;
    public $dezenas_teste;
    public $max_combinacoes;

    //-------------------------------------------------------
    function getMax_combinacoes() {
        return $this->max_combinacoes;
    }

    function setMax_combinacoes($max_combinacoes) {
        $this->max_combinacoes = $max_combinacoes;
    }

    function getDezenas_teste() {
        return $this->dezenas_teste;
    }

    function setDezenas_teste($dezenas_teste) {
        $this->dezenas_teste = $dezenas_teste;
    }

    function getArray_limite() {
        return $this->array_limite;
    }

    function setArray_limite($array_limite) {
        $this->array_limite = $array_limite;
    }

    function getLimite() {
        return $this->limite;
    }

    function setLimite($limite) {
        $this->limite = $limite;
    }

    function getMetodo() {
        return $this->metodo;
    }

    function setMetodo($metodo) {
        switch ($metodo) {
            case 1:
                $this->setArray_limite(Voto::orderBy('votos', 'desc')->limit($this->getLimite())->get());
                break;
            case 2:
                $this->setArray_limite(Voto::orderBy('votos')->limit($this->getLimite())->get());

                break;
            case 3:
                $this->metodo = $metodo;
                break;
        }
    }

    function getJogos() {
        return $this->jogos;
    }

    function setJogos($jogo) {
        $this->jogos[] = $jogo;
    }

    function getQtd_jogos() {
        return $this->qtd_jogos;
    }

    function getQtd_num() {
        return $this->qtd_num;
    }

    function setQtd_jogos($qtd_jogos) {
        $this->qtd_jogos = $qtd_jogos;
    }

    function setQtd_num($qtd_num) {
        $this->qtd_num = $qtd_num;
    }

//        ----------------------------------------------

    public function postGerarMaisFrequentes(Request $request) {
        $this->setQtd_jogos($request->qtd_jogos);
        $this->setQtd_num($request->qtd_num);
        $this->setLimite($request->limite);
        $this->setMetodo(1);
        $this->getCombinacoes();

        $this->getAposta();

        if (!session()->has('mais_freq')) {
            $mais_freq = new Sugestao();
            $mais_freq->metodo = "Maior Frequencia";
            $mais_freq->jogos = $this->getJogos();
            session()->put('mais_freq', $mais_freq);
        }

        return view('loto.folder.sugestoes');
    }

    public function postGerarMenosFrequentes(Request $request) {
        $this->setQtd_jogos($request->qtd_jogos);
        $this->setQtd_num($request->qtd_num);
        $this->setLimite($request->limite);
        $this->setMetodo(2);
        $this->getCombinacoes();

        $this->getAposta();
        if (!session()->has('menos_freq')) {
            $menos_freq = new Sugestao();
            $menos_freq->metodo = "Menor Frequencia";
            $menos_freq->jogos = $this->getJogos();
            session()->put('menos_freq', $menos_freq);
        }


        return view('loto.folder.sugestoes');
    }

    public function postGerarMisto(Request $request) {
        $this->setQtd_jogos($request->qtd_jogos);
//        ------------------------------------------------gerar num mais frequentes
        $this->setLimite($request->qtd_mais_freq);
        $this->setMetodo(1);
        $qtd_mais_freq = $this->getArray_limite();
//        --------------------------------------------------gerar menos frequentes
        $this->setLimite($request->qtd_menos_freq);
        $this->setMetodo(2);
        $qtd_menos_freq = $this->getArray_limite();
//        ---------------------------------------------------concateno array com a selecao de mais e menos frequentes
        $this->setArrayMisto($qtd_mais_freq, $qtd_menos_freq);

        $this->setQtd_num($request->qtd_num);
        $this->setLimite($request->limite);
        $this->getCombinacoes();

        $this->getAposta();
        if (!session()->has('misto')) {
            $misto = new Sugestao();
            $misto->metodo = "Misto";
            $misto->jogos = $this->getJogos();
            session()->put('misto', $misto);
        }
        return view('loto.folder.sugestoes');
    }

    public function setArrayMisto($qtd_mais_freq, $qtd_menos_freq) {
        $array = [];
        foreach ($qtd_mais_freq as $num) {
            $array[] = $num;
        }
        foreach ($qtd_menos_freq as $num) {
            $array[] = $num;
        }

        $this->setArray_limite($array);
    }

//    ---------------------------------------------Construindo jogos
    public function getAposta() {

        if (intval($this->getQtd_jogos()) > $this->getMax_combinacoes()) {
            $num_jogos = $this->getMax_combinacoes();
            session()->put('alerta', $this->getMax_combinacoes() . " é o maximo de combinaçes possiveis");
        } else {
            $num_jogos = $this->getQtd_jogos();
            session()->forget('alerta');
        }


        foreach (range(1, $num_jogos) as $i) {
            do {
                $dezenas = $this->getDezenas();
                $flag = $this->getJogoRepetido($this->setDezenas_teste($dezenas));
            } while ($flag);

            $this->setJogos($dezenas);
        }
    }

    public function getDezenas() {
        $array = [];
        foreach (range(1, $this->getQtd_num()) as $i) {
            do {
                $posicao = rand(0, $this->getLimite() - 1);

                $numero = $this->getArray_limite()[$posicao]->numero;
                $flag = $this->repeat($array, $numero);
            } while ($flag);
            $array[] = $numero;
        }
        sort($array);
        return $array;
    }

    public function repeat($array, $numero) {
        foreach ($array as $dezena) {
            if ($dezena == $numero) {
                return true;
            }
        }
        return false;
    }

    public function getJogoRepetido() {

        foreach ($this->getJogos() as $jogo) {
            $count = 0;
            $i = 0;
            foreach ($jogo as $numero) {
                if ($numero == $this->getDezenas_teste()[$i]) {
                    $count++;
                    $i++;
                }
            }

            if ($count == $this->getQtd_num()) {
                return true;
            }
        }
        return false;
    }

//    ----------------------------------combinacoes possiveis
//    Cn,p =      n!     
//             p! (n – p)!
//    n => getLimite() é a quantidade de elementos de um conjunto 
//    p => getQtd_num()  representa a quantidade de elementos que irão formar os agrupamentos.

    public function getCombinacoes() {
        $n_fat = $this->getFatorial($this->getLimite());
        $p_fat = $this->getFatorial($this->getQtd_num());
        $n_p_fat = $this->getFatorial($this->getLimite() - $this->getQtd_num());

        $this->setMax_combinacoes($n_fat / $p_fat * $n_p_fat);
    }

    public function getFatorial($fat) {
        $resul = 1;
        for ($i = $fat; $i > 1; $i--) {
            $resul *= $fat;
            $fat--;
        }
        return $resul;
    }

    public function getDestroy($request) {
        session()->forget($request);
        return view('loto.folder.sugestoes');
    }

    public function getRelacao() {
        return view('loto.folder.relatorio');
    }

    public function getGerarRelatorio() {
        session()->forget('conferido');
        session()->forget('relatorio');

        $mais = session()->get('mais_freq');
        $menos = session()->get('menos_freq');
        $misto = session()->get('misto');
        $total = count($mais->jogos) + count($menos->jogos) + count($misto->jogos);

        $this->getRelatorio($mais->jogos);
        $this->getRelatorio($menos->jogos);
        $this->getRelatorio($misto->jogos);
        session()->put('relatorio', $this->getJogos());
        $jogos = $this->getJogos();
        return redirect('/aposta/relacao');
//        return \PDF::loadView('loto.folder.pdf', compact('jogos'))
//                // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')
//                ->stream('jeferson.pdf');
    }

    public function getRelatorio($jogos) {

        foreach ($jogos as $jogo) {
            $this->setJogos($jogo);
        }
        return;
    }

    public function getStore() {
        $jogos = json_encode(session()->get('relatorio'));
        $apostas = new Aposta();
        $apostas['apostas'] = $jogos;
        $apostas->save();
        $return = Aposta::all();
        return \PDF::loadView('loto.folder.pdf', compact('jogos'))
                        // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')
                        ->stream('jeferson.pdf');
//        return view('loto.folder.apostas', compact('return'));
    }

}
