@if(session()->has('frequencia')? $frequencia = session()->get('frequencia') : $frequencia = "")
@endif
@extends('loto.layouts.mobile')
@section('content')

<div class="row">
<!--    <div class="col s2">
        <ul class="collection ">
            @forelse($frequencia->mais as $numero)
            @if($numero->numero < 10)
            <a href="#!" class="collection-item"><span class="e0f2f1 teal lighten-5 badge">{{$numero->votos}}X</span>0{{$numero->numero}}</a>
            @else
            <a href="#!" class="collection-item"><span class="e0f2f1 teal lighten-5 badge">{{$numero->votos}}X</span>{{$numero->numero}}</a>
            @endif
            @empty
            Nada
            @endforelse
        </ul>
    </div>-->
    
    
    
    
    
    
    
    
    <div class="col s12">
        @include('loto.folder.metodos_sugest')
    </div>
    
    
    
    
    
    
    
    
<!--    <div class="col s2">
        <div class="collection">
            @forelse($frequencia->menos as $numero)
            @if($numero->numero < 10)
            <a href="#!" class="collection-item"><span class="e0f2f1 teal lighten-5 badge">{{$numero->votos}}X</span>0{{$numero->numero}}</a>
            @else
            <a href="#!" class="collection-item"><span class="e0f2f1 teal lighten-5 badge">{{$numero->votos}}X</span>{{$numero->numero}}</a>
            @endif
            @empty
            Nada
            @endforelse
        </div>
    </div>-->
</div>


@endsection