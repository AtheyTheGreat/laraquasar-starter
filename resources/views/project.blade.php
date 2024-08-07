@extends('layout.layout')
@section('content')
<div class="justify-between flex pl-4 p-6  md:pl-[25px] mt-14">
    <h2 class="text-xl md:pl-12 md:text-2xl md:leading-tight text-white dark:text-gray-200 ">
        <a href="{{ url('/project')}}">
            <span class="text-gray-400">Projects /</span>
        </a>

        {{ $project->title }}
    </h2>
</div>

<!-- {{-- @foreach ($project->attachments as $attachment) --}} -->
<div class="w-full relative">
    <img class="flex items-center h-[24rem] object-cover object-center justify-center lg:w-full lg:h-[39rem]" src="{{$project->getFirstMediaUrl('cover_image','thumb')}}" alt="Image Description">
    <span class="text-white text-2xl relative bottom-32 left-5 z-10 lg:text-5xl lg:pl-12 lg:font-semibold drop-shadow-[0_1.2px_1.2px_rgba(0,0,0,0.8)]">{{ $project->title }}</span>
    <div>
        @foreach($project->tags as $tag)
        <div class="w-full relative bottom-32 flex md:pr-12 md:justify-end pl-4 pt-3 md:pt-0">
            <span class="bg-white text-black font-semibold text-md mr-2 px-4 py-1.5 rounded-full z-10 md:right-5 ">{{ $tag->tags}}</span>
        </div>
        @endforeach
    </div>
</div>
<!-- {{-- @endforeach --}} -->

<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
    <!-- Avatar -->
    <h2 class="-Thin lg:leading-tight text-md lg:text-2xl xl:leading-tight text-gray-300 dark:text-gray-200 tracking-wide lg:pt-4 text-xl text-center">
        {!! $project->desc !!}</h2>
    <!-- End Avatar -->
</div>

<div>
    <h2 class="text-3xl lg:pl-[7.5rem] pl-3">
        <span class="text-white font-semibold">Details</span>
    </h2>
    <div i>
        <div class="w-3/4 md:mx-auto p-5 pl-8">
            <p class="mb-2  text-xl text-gray-200 dark:text-gray-400"><b>Project Year :</b> {{$project->project_year}}</p>
            <p class="mb-2 text-xl  text-gray-200 dark:text-gray-400"><b>Area :</b> {{$project->project_area}}</p>
            <!-- <p class="mb-2 text-xl  text-gray-200 dark:text-gray-400"><b>Client :</b> {{$project->client_name}}</p> -->
        </div>
    </div>
</div>

<div class="">
    <div class="justify-center flex pl-4 p-6 md:pl-[25px]">
        <div class="p-6 pl-4 pb-1 py-6">
            <span class="bg-white text-black font-semibold text-md mr-2 px-4 py-1.5 rounded-full">Image Gallery</span>
        </div>
    </div>
    <!-- Card Blog -->
</div>


<div class="container py-10 sm:px-6 lg:px-18 lg:py-14 mx-auto px-4">
    <div class="grid gap-4">
        <a class="relative group p-1">
            <img class="h-full max-w-full rounded-lg object-cover object-center w-full" src="{{ $project->getFirstMediaUrl('cover_image','thumb') }}" alt="">
        </a>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
            @foreach($project->getMedia('images') as $image)
            <a class="relative group" data-dialog-target="image-dialog-{{ $loop->index }}">
                <img class="w-full h-56 max-w-full rounded-lg object-cover object-center group-hover:scale-110 transition-transform duration-300" src="{{ $image->getUrl() }}" alt="">
            </a>
            @endforeach
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Get the reference to the top image
        var topImage = $(".p-1 img");

        // Add click event handlers to the images below
        $(".grid img").on("click", function() {
            // Get the source of the clicked image
            var newImageSrc = $(this).attr("src");

            // Update the source of the top image
            topImage.attr("src", newImageSrc);
        });
    });
</script>





<div class="pt-24  justify-between flex pl-4 p-6 border-b-[1.5px] border-t-[1.5px] md:pl-[25px]">
    <h2 class="lg:pl-24 text-3xl font-semibold md:text-2xl md:leading-tight text-white dark:text-gray-200 ">More Projects</h2>
</div>
<div class="max-w-full px-4 py-10 sm:px-6 lg:px-8 lg:py-5 border-b-[1.5px]">
    <form id="filterForm" action="{{ route('filter-projects-by-tag') }}" method="GET">
        @csrf
        <div class="flex items-center">
            <select name="tag" id="tag" style="background-color: rgba(37, 37, 38);" class="block py-2.5 px-0 w-full text-2xl text-white border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                <option selected class="text-white">Choose a project type</option>
                @foreach($tags as $tag)
                <option value="{{ $tag->tags }}">{{ $tag->tags }}</option>
                @endforeach
            </select>
        </div>
    </form>
</div>

<script>
    document.getElementById('tag').addEventListener('change', function() {
        document.getElementById('filterForm').submit();
    });
</script>

<div class="max-w-full px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto ">
    <!-- Grid -->
    <div class="grid lg:grid-cols-3 lg:gap-y-16 gap-2">
        <!-- Card -->
        @foreach ($projects as $project)
        <div>
            <a class="group relative block" href="{{ url('/project', $project->id) }}">
                <div class="rounded-lg flex-shrink-0 relative w-auto overflow-hidden h-[220px] lg:h-[250px] before:absolute before:inset-x-0 before:w-full before:h-full before:bg-gradient-to-t before:from-gray-900/[.7] before:z-[1]">
                    <img class="w-full h-full absolute top-0 left-0 object-cover aspect-square group-hover:scale-110 transition duration-300 ease-in-out" src="{{$project->getFirstMediaUrl('cover_image','thumb')}}" alt="Image Description">
                </div>

                <div class="absolute top-0 inset-x-0 z-10">
                    <div class="p-4 flex flex-col h-full sm:p-6">
                    </div>
                </div>

                <div class="absolute bottom-0 inset-x-0 z-10 group-hover:opacity-0">
                    <div class="flex flex-col h-full p-4 sm:p-6 pl-8">
                        <h3 class="text-2xl lg:text-3xl text-white group-hover:text-white/[.8]">
                            {{ $project->title }}
                        </h3>
                    </div>
                </div>
                <div class="z-50 rounded-b-lg opacity-0 group-hover:opacity-100 transition duration-300 ease-in-out cursor-pointer absolute from-black/80 to-transparent bg-gradient-to-t inset-x-0 -bottom-2 pt-30 text-white flex items-end">
                    <div>
                        <div class="transform-gpu  p-4 space-y-3 text-xl group-hover:opacity-100 group-hover:translate-y-0 translate-y-4 pb-10 transform transition duration-300 ease-in-out">

                            <div class="font-semibold text-md tracking-wider  group-hover:text-white/[.8]">


                                <h3 class="text-2xl lg:text-3xl text-white group-hover:text-white/[.8]">
                                    {{ $project->title }}
                                </h3>
                                Project Year: {{$project->project_year}}<br />
                                Project Area: {{ $project->project_area}}
                                <!-- Client Name: {{ $project->client_name}} -->
                            </div>
                            @foreach($project->tags as $tag)
                            <div class="font-semibold">{{ $tag->tags }}</div>
                            @endforeach
                        </div>
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
@endsection