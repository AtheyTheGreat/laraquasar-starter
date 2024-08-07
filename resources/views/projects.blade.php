@extends('layout.layout')
@section('content')
<div class="justify-between flex pl-4 p-6 border-b-[1.5px] md:pl-[25px] mt-14">
    <h2 class="md:pl-12 text-xl md:text-2xl md:leading-tight text-white dark:text-gray-200  uppercase">Projects</h2>
    <h2 class="md:pr-12 text-xl md:text-2xl md:leading-tight text-white dark:text-gray-200 ">
        {{ $projects->count() }} Projects
    </h2>
</div>


<!-- Add a form for the tag selector -->
<div class="max-w-full px-4 py-10 sm:px-6 lg:px-8 lg:py-5 border-b-[1.5px]">
    <form id="filterForm" action="{{ route('filter-projects-by-tag') }}" method="GET">
        @csrf
        <div class="flex items-center">
            <select name="tag" id="tag" style="background-color: rgba(37, 37, 38);" class="block py-2.5 px-0 w-full text-2xl text-white border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                <option selected class="text-white">Choose a project type</option>
                {{-- <option value="all">All</option> --}}
                @foreach($tags as $tag)
                <option value="{{ $tag->tags }}">{{ $tag->tags }}</option>
                @endforeach
            </select>
        </div>
    </form>
</div>

<script>
    // function resetForm() {
    //     Reset the select value
    //     document.getElementById('tag').selectedIndex = 0;

    //     Reload the page or redirect to /projects
    //     window.location.href = '/projects';
    // }
    // Add an event listener to the select element
    document.getElementById('tag').addEventListener('change', function() {
        // Trigger the form submission when the select element changes
        document.getElementById('filterForm').submit();
    });
</script>

<!-- Card Blog -->
<div class="max-w-full px-4 py-10 sm:px-6 lg:px-16 lg:py-14">
    <!-- Grid -->
    <div class="grid lg:grid-cols-3 lg:gap-y-6 gap-3">
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
    </div>

    @if (!isset($projects) || $projects->isEmpty())
    <div class="pt-24 py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
        <div class="mx-auto max-w-screen-sm text-center text-white">
            <p class="mb-4 text-xl tracking-tight font-bold text-gray-300 md:text-4xl dark:text-white">No projects under the selected project type.</p>
            <p class="mb-4 text-lg font-light text-gray-200 dark:text-gray-400">Try another type category..</p>
        </div>
        <div class="pt-4 mx-auto max-w-screen-sm text-center">
        </div>
        @endif
        <!-- End Card -->

    </div>
    <!-- End Grid -->
</div>
<!-- End Card Blog -->
@endsection