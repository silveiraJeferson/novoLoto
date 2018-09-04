@extends('loto.layouts.mobile')
@section('content')
<div class="container">
    <h1 class="card-header">Adicionar</h1>

    <div class="row">
        <form class="col s12" action="/concurso/store" method="post">
            <div class="input-field col s12">
                <input name="concurso" placeholder="Concurso nº" id="first_name" type="text" class="validate">
                <label for="first_name">Número</label>
            </div>
            <div class="row">

                @foreach(range(1, 15) as $i)
                <div class="input-field col s2">
                    <input name="{{$i}}" placeholder="{{$i}}º" id="first_name" type="text" class="validate">
                    <label for="first_name">Número</label>
                </div>
                @endforeach

            </div>
            {!! csrf_field() !!}
            <div class="col s12">
                <input type="submit" class="btn btn-group-lg" />
            </div>

        </form>
    </div>
</div>






@endsection