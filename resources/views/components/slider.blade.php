<div id="default-carousel" class="relative w-full pb-12 lg:min-h-screen h-52  overflow-hidden lg:mt-0 mt-[64px] " data-carousel="slide">
    <div class="w-full inline-flex flex-nowrap rounded-lg">
    @foreach ($galleries as $gallery)
        <div class="relative duration-700 ease-in-out" data-carousel-item>
            <img src="{{ $gallery->getFirstMediaUrl('gallery') }}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 lg:h-full lg:object-cover object-contain" alt="...">
        </div>
    @endforeach
    </div>
</div>

<script>
    const carouselElement = document.getElementById('default-carousel');
    const options = {
        defaultPosition: 1,
        interval: 5000,
    };
</script> 

 