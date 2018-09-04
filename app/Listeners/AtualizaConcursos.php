<?php

namespace App\Listeners;
use App\Concurso;
use App\Voto;
use App\Events\Atualizar;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AtualizaConcursos
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Atualizar  $event
     * @return void
     */
    public function handle(Atualizar $event)
    {
        $sessao['concursos'] = Concurso::orderBy('id', 'desc')->get();
        $sessao['mais_frequentes'] = Voto::orderBy('votos', 'desc')->limit(15)->get();
        $sessao['menos_frequentes'] = Voto::orderBy('votos', 'asc')->limit(15)->get();
       
        session()->put('sessao', $sessao);
    }
}
