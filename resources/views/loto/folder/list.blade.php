<?php
$sessao = session()->get('sessao');
?>
@extends('loto.layouts.mobile')
@section('content')
<div class="container">

    <ul class="collection with-header">
        @foreach($sessao['concursos'] as $concurso)
        <li class="collection-item row">
            <div class="col s1">
                {{$concurso->concurso}}
            </div>

            <div class="col s9">
                @foreach(json_decode($concurso['dezenas']) as $numero)
                @if($numero < 10)
                0{{$numero}} - 
                @else
                {{$numero}} - 
                @endif

                @endforeach
            </div>

            <div class="col s1">
                <a href="/concurso/edit/{{$concurso->id}}" class="secondary-content" >                    
                    <i class="material-icons">edit</i>                    
                </a>                
            </div>
            <div class="col s1">
                <a href="#modal1" class="secondary-content modal-trigger" onclick="setId({{$concurso->id}}, 'excluir')">   

                    <i class="material-icons">delete_forever</i>                    
                </a>              
            </div>
        </li>
        @endforeach
    </ul>
</div>


@endsection

<!-- Modal Structure -->
<div id="modal1" class="modal">
    <div class="modal-content">
        <h4 id="pergunta"></h4>        
    </div>
    <div class="modal-footer">
        
        <a href="" id="destroy" class="modal-close waves-effect waves-green btn-flat">Excluir</a>
        <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancelar</a>
    </div>
</div>

<script type="text/javascript">
   
</script>