@extends('layout.layout')
@section('content')
<x-slider :galleries="$galleries" />
<x-projects :projects="$projects" />
{{-- <x-stats  :projects="$projects" :clients="$clients"/> --}}
@endsection