@extends('loto.layouts.mobile')
@section('content')

<h1 class="card-header">Editar Ganhador</h1>

<div class="row">
    <form class="col s12" action="/concurso/update" method="post">
        <div class="input-field col s12">
                <input name="concurso" placeholder="Concurso nº" id="first_name" type="text" class="validate" value="{{$concurso->concurso}}">
                <label for="first_name">Número do Concurso</label>
            </div>
        <div class="row">
            <?php $i = 0;?>
            @foreach(json_decode($concurso->dezenas) as $numero)
                        <?php $i++;?>
            <div class="input-field col s2">
                <input name="{{$i}}" placeholder="{{$i}}º" id="first_name" type="text" class="validate" value="{{$numero}}">
                <label for="first_name">Número</label>
            </div>
            @endforeach

        </div>
            <input type="hidden" name="id" value="{{$concurso->id}}"/>
            <input type="hidden" name="old" value="{{$concurso->dezenas}}"/>
        {!! csrf_field() !!}
        <div class="col s12">
            <input type="submit" class="btn btn-group-lg" />
        </div>

    </form>
</div>







@endsection