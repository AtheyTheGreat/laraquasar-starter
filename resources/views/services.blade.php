@extends('layout.layout')
@section('content')
<div class="w-full">
    <img class="flex items-center h-[33.3rem] w-full lg:h-[38rem] object-cover justify-center md:justify-start" src="https://images.unsplash.com/photo-1435575653489-b0873ec954e2?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Image Description">
    <span class="text-white  font-semibold text-4xl relative bottom-20 left-12 lg:left-20 z-10 uppercase drop-shadow-[0_1.2px_1.2px_rgba(0,0,0,0.8)]">Services</span>
</div>

<!-- Card Blog -->
<div class="max-w-full px-4 py-10 sm:px-6 lg:px-16 lg:py-14 ">
    <!-- Grid -->
    <div class="grid lg:grid-cols-2 lg:gap-y-6 gap-3">
        <!-- Card -->
        @foreach ($services as $service)
        <div>
            <a class="group relative block" href="{{ url('/service', $service->id) }}">
                <div class="rounded-lg flex-shrink-0 relative w-auto overflow-hidden h-[220px] lg:h-[250px] before:absolute before:inset-x-0 before:w-full before:h-full before:bg-gradient-to-t before:from-gray-900/[.7] before:z-[1]">
                    <img class="w-full h-full absolute top-0 left-0 object-cover aspect-square group-hover:scale-110 transition duration-300 ease-in-out" src="{{$service->getFirstMediaUrl('service_cover','thumb')}}" alt="Image Description">
                </div>

                <div class="absolute top-0 inset-x-0 z-10">
                    <div class="p-4 flex flex-col h-full sm:p-6">
                    </div>
                </div>

                <div class="absolute bottom-0 inset-x-0 z-10">
                    <div class="flex flex-col h-full p-4 sm:p-6 pl-8">
                        <h3 class="text-2xl lg:text-3xl text-white group-hover:text-scale-2xl">
                            {{ $service->service_name }}
                        </h3>
                    </div>
                </div>
            </a>
            <!-- End Card -->
        </div>
        @endforeach
        <!-- End Card -->

    </div>
    <!-- End Grid -->
</div>
<!-- End Card Blog -->

@endsection