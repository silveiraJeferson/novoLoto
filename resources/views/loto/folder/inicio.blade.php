@extends('loto.layouts.mobile')
@section('content')
<div class="">
   @if(session()->has('alerta'))
    {{session()->get('alerta')}}
   @endif
</div>


@endsection