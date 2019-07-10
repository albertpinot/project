@extends('layouts.app')

@section('content')
    @include("_chansons", ['chansons'=> $chansons]) 
@endsection