@extends('layouts.master')


@section('content')

<h3> Página principal para el usuario {{ \Auth::user()->name }}</h3>


@include('products.create')





@endsection