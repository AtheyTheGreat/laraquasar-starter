@extends('layout.layout')
@section('content')

    <div class="justify-between flex pl-4 p-6 border-b-[1.5px] md:pl-[25px] mt-14">
        <h2 class="lg:pl-12 text-xl md:text-2xl md:leading-tight text-white dark:text-gray-200 uppercase">Contact</h2>
    </div>

        <!-- Card Blog -->
    <div class="w-full lg:pl-16 px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto lg:mb-40 ">
        <!-- Grid -->
        <div class="grid lg:grid-cols-3 lg:gap-y-16 gap-10">
            <!-- Card -->
            <div class="md:w-80 w-full rounded-lg  bg-gray-100 p-4 dark:bg-gray-800 dark:border-gray-700">
                <div class="flex justify-between">
                    <p class="pt-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">Male' City</p>
                    <div class="pr-4">
                        <a href="mailto:info@localarchstudio.com?subject=Website%20Contact%20"
                        class="inline-flex items-center px-4 py-4 text-sm font-medium text-center rounded-full lg:rounded-full text-white bg-gray-300 sm:rounded-lg ">
                        <svg fill="#000000" class="w-3.5 h-3.5 ml-[1px] text-black" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 330.001 330.001" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g id="XMLID_348_"> <path id="XMLID_350_" d="M173.871,177.097c-2.641,1.936-5.756,2.903-8.87,2.903c-3.116,0-6.23-0.967-8.871-2.903L30,84.602 L0.001,62.603L0,275.001c0.001,8.284,6.716,15,15,15L315.001,290c8.285,0,15-6.716,15-14.999V62.602l-30.001,22L173.871,177.097z"></path> <polygon id="XMLID_351_" points="165.001,146.4 310.087,40.001 19.911,40 "></polygon> </g> </g></svg>
                        </a>
                    </div>
                </div>
                    <div class="justify-between flex">
                        <a href="">
                            <div class="pt-2">
                                <h5 class="mb-2 font-normal text-gray-800 dark:text-gray-400 text-xl">
                                    Lotus Building - 3rd Floor <br> +9607412292
                                </h5>
                            </div>
                        </a>
                    </div>
                </div>
            <!-- End Card -->

        </div>
        <!-- End Grid -->
    </div>
    <!-- End Card Blog -->

@endsection
