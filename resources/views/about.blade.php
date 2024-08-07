@extends('layout.layout')
@section('content')
<div class=" mt-14">
    <div class="justify-between flex pl-4 p-6 border-b-[1.5px] lg:pl-[4.6rem]">
        <h2 class="text-xl md:text-2xl md:leading-tight text-white dark:text-gray-200 uppercase">About</h2>
    </div>
    <!-- Card Blog -->
    <div class="p-6 pl-4 pb-1 py-6 lg:pl-[4.4rem]">
        <span class="bg-white text-black font-semibold text-md mr-2 px-4 py-1.5 rounded-full">About Local Arch Studio</span>
    </div>
</div>
<!-- Grid -->
<div class="">
    @foreach ($abouts as $about)
    <div class="w-full pt-6 relative">
        <img class="flex items-center h-auto  w-full lg:h-[38rem] lg:object-cover object-fit justify-center md:justify-start" src="{{$about->getFirstMediaUrl('about','thumb')}}" alt="Image Description">
        <span class="text-white  font-semibold text-4xl relative bottom-20 left-20 z-10 drop-shadow-[0_1.2px_1.2px_rgba(0,0,0,0.8)]">About</span>
    </div>
    <!-- End Col -->

    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto text-center">
        <h1 class="text-2xl text-white font-semibold">About Local Arch Studio</h1>
        <h2 class="-Thin lg:leading-tight xl:text-xl text-lg xl:leading-tight text-gray-300 dark:text-gray-200 tracking-wide pt-8">
            {!! $about->desc !!}
        </h2>
        <!-- End Col -->
    </div>
    @endforeach
</div>
<!-- End Grid -->
<!-- End Card Blog -->
@endsection