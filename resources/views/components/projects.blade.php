<div class="justify-left flex pt-10 pl-8 text-white sm:pl-20">
    <h2 class="text-2xl md:text-4xl md:leading-tight dark:text-gray-200 font-semibold uppercase">Projects</h2>
</div>
<!-- Card Blog -->
<div class="w-full px-6 py-4 lg:pl-20 sm:px-6 lg:px-8 lg:py-14 mx-auto">
    <!-- Grid -->
    <div class="grid lg:grid-cols-3 gap-6 sm:grid-cols-2">
        @foreach ($projects->take(6) as $project)
        <!-- Card -->
        <div>
            <a class="group relative block" href="{{ url('/project', $project->id) }}">
                <div class="rounded-lg flex-shrink-0 relative w-auto overflow-hidden h-[220px] lg:h-[300px] before:absolute before:inset-x-0 before:w-full before:h-full before:bg-gradient-to-t before:from-gray-900/[.7] before:z-[1]">
                    <img class="w-full h-full absolute top-0 left-0 object-cover aspect-square group-hover:scale-110 transition duration-300 ease-in-out" src="{{$project->getFirstMediaUrl('cover_image','thumb')}}" alt="Image Description">
                </div>

                <div class="absolute top-0 inset-x-0 z-10">
                    <div class="p-4 flex flex-col h-full sm:p-6">
                    </div>
                </div>

                <div class="bottom-0 inset-x-0 z-10 group-hover:opacity-0">
                    <div class="flex flex-col h-full p-4 sm:p-6 lg:pl-2 pl-0">
                        <h3 class="text-xl lg:text-2xl text-white group-hover:text-white/[.8] lg:text-start">
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
</div>
