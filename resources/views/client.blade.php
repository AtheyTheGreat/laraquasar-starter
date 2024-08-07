@extends('layout.layout')
@section('content')

<div class="justify-between flex pl-4 p-6 border-b-[1.5px] md:pl-[25px]">
    <h2 class="lg:pl-12 text-xl md:text-2xl md:leading-tight text-white dark:text-gray-200 uppercase">Clients</h2>
    <h2 class="lg:pr-12 text-xl md:text-2xl md:leading-tight text-gray-400 dark:text-gray-200 ">
        {{ $clients->count() }} Clients
    </h2>
</div>

<!-- Card Blog -->
<div class="max-w-full lg:pl-14 px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto ">
    <!-- Grid -->
    <div class="grid lg:grid-cols-3 lg:gap-y-16 gap-10">
        <!-- Card -->
        @foreach ($clients as $client)
        <div class=" bg-white dark:bg-gray-800 dark:border-gray-700">

            <div class="flex items-center h-64">
                <img class="object-cover h-64 w-full" src="{{$client->getFirstMediaUrl('logo','thumb')}}" alt="" />
            </div>
            <div class="p-5 bg-gray-100">
                <p class="mb-2 font-normal text-gray-700 dark:text-gray-400"><b>Client:</b> {{$client->name}}</p>
                <div class="justify-between flex">
                    <div class="pt-2">
                        <h5 class="text-xl tracking-tight text-gray-900 dark:text-white">
                            {!! $client->testimonial !!}</h5>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        <!-- End Card -->

    </div>
    <!-- End Grid -->
</div>
<!-- End Card Blog -->

@endsection