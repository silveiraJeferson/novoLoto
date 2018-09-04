@extends('loto.layouts.mobile')
@section('content')
<div class="container">

    <h5 class="">Relatório Conferido <span class="right text-blue">{{session()->get('alerta')}}</span></h5>
    <div class="row">
        @if(session()->get('conferido') ? $jogos = session()->get('conferido') : header('Location: url("/aposta/relacao")'))


        <div class="col s12">
            Total de Jogos = {{(count($jogos))}}
        </div>
        @foreach($jogos as $jogo)
        <div class="col s4 fonte_peq">
            @foreach($jogo as $numero)
            

            @if($numero->valor < 10)
            0{{$numero->valor}}
            @else
            {{$numero->valor}}
            @endif
            @endforeach
        </div>

        @endforeach
        @endif

        <div class="col s12">
            <br/>
            <a class="btn blue" href="/aposta/store">Salvar?</a>
        </div>
    </div>

</div>








@endsection
