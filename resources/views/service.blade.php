@extends('layout.layout')
@section('content')
<div class="justify-between flex pl-4 p-6 md:pl-[25px] mt-14">
    <h2 class="text-xl md:pl-12 md:text-2xl md:leading-tight text-white dark:text-gray-200 font-dosis">
        <a href="{{ url('/service')}}">
            <span class="text-gray-400">Services /</span>
        </a>

        {{ $service->service_name }}
    </h2>
</div>

<div class="">
    <div class="w-full relative">
        <img class="flex items-center h-[33.3rem] w-full lg:h-[38rem] object-cover justify-center md:justify-start" src="{{$service->getFirstMediaUrl('service_cover','thumb')}}" alt="Image Description">
    </div>
    <!-- End Col -->

    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto text-center">
        <h1 class="text-2xl text-white font-semibold">{{$service->service_name}} by Local Arch Studio</h1>
        <h2 class="-Thin lg:leading-tight xl:text-xl text-lg xl:leading-tight text-gray-300 dark:text-gray-200 tracking-wide pt-8">
            {!!$service->service_desc!!}
        </h2>
        <!-- End Col -->
    </div>
</div>

@endsection