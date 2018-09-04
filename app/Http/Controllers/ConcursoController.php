<?php

namespace App\Http\Controllers;
use App\Concurso;
use App\Voto;
use App\Http\Controllers\VotosController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Events\Atualizar;

class ConcursoController extends Controller {

    public function getList() {
        
        return view('loto.folder.list');
    }

    public function getCreate() {
        return view('loto.folder.create');
    }

    public function getSugestoes() {
        $a = new VotosController();
       session()->put('frequencia', $a->getFrequencia());             
        return view('loto.folder.sugestoes');
    }

    public function postStore(Request $request) {
        
        $request_form = $request->all();
        $dezenas = $this->prepararVencedor($request_form);
        $vencedor = new Concurso($request->all());
        $vencedor->dezenas = json_encode($dezenas);       
        $vencedor->save();
        event(new Atualizar());
        return redirect('/concurso/create');
    }

    public function prepararVencedor($request) {
        foreach (range(1, 15) as $i) {
            $array[] = intval($request[$i]);            
        }
        $this->incrementVotos($array);
        sort($array);
        return $array;
    }

    public function getDestroy($id){
        $id = intval($id);
        $concurso = Concurso::where('id', $id)->get();
        $dezenas = json_decode($concurso[0]->dezenas);
        $this->decrementVotos($dezenas);        
        Concurso::where('id', $id)->delete();
        event(new Atualizar());
        return redirect('/concurso/list');
    }
    public function getEdit($id){
        $concurso = Concurso::where('id',$id)->get();
        $concurso = $concurso[0];
        return view('loto.folder.edit', compact('concurso'));
    }
    
    public function postUpdate(Request $request){
        $this->decrementVotos(json_decode($request->old));        
        $request_form = $request->all();
        $dezenas = $this->prepararVencedor($request_form);
        $vencedor = new Concurso($request->all());
        
        $vencedor->where('id',$request->id)->update(['dezenas'=> json_encode($dezenas)]);
        event(new Atualizar());
        return redirect('/concurso/list');
    }
    
    public function incrementVotos($dezenas){
        foreach ($dezenas as $numero){
            Voto::where('numero', $numero)->increment('votos');
        }
    }
    public function decrementVotos($dezenas){
        foreach ($dezenas as $numero){
            Voto::where('numero', $numero)->decrement('votos');
        }
    }
    
}
