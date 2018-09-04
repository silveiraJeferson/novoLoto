@extends('loto.layouts.mobile')
@section('content')
<div class="container">

    <h5 class="">Relatório</h5>
    <div class="row">
        @if(session()->has('relatorio') ? $jogos = session()->get('relatorio') : $flag = false)

        <div class="col s12">
            Total de Jogos = {{(count($jogos))}}
        </div>
        @foreach($jogos as $jogo)
        <div class="col s4 fonte_peq">
            @foreach($jogo as $numero)
            @if($numero < 10)
            0{{$numero}}
            @else
            {{$numero}}
            @endif
            @endforeach
        </div>

        @endforeach
        @endif
        
        <div class="col s12">
            <br/>
            <a class="btn blue" href="/conferencia/sugestao-repetida">Conferir Jogos Repetidos</a>
        </div>
    </div>

</div>








@endsection