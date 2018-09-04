@extends('loto.layouts.mobile')
@section('content')
@foreach($return as $aposta)
{{date('d/m/Y H:i:s', strtotime($aposta->created_at))}}<br/>
@endforeach

pagina de apostas feitas
@endsection