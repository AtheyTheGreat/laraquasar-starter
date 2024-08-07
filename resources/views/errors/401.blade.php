@extends('layout.layout')

@section('content')

<div class="pt-24 py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
    <div class="mx-auto max-w-screen-sm text-center text-white">
        <h1 class="mb-4 text-4xl tracking-tight font-semibold lg:text-9xl text-primary-600 dark:text-primary-500">401</h1>
        <p class="mb-4 text-xl tracking-tight font-bold text-gray-300 md:text-4xl dark:text-white">Unauthorized.</p>
        <p class="mb-4 text-lg font-light text-gray-200 dark:text-gray-400">Sorry, You'll find lots to explore on the home page. </p>
    </div>
    <div class="pt-4 mx-auto max-w-screen-sm text-center">
        <a href="{{ url('/') }}">
            <span class="bg-gray-200 text-gray-800 text-md mr-2 px-4 py-1.5 rounded-full">Back to home page</span>
        </a>
    </div>
</div>

@endsection
