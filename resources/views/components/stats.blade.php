<div class="w-full px-6 py-10 lg:pl-20 sm:px-6 lg:px-8 lg:py-14 mx-auto">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <dl class="grid grid-cols-1 gap-x-8 gap-y-16 text-center lg:grid-cols-2">
            <div class="mx-auto flex max-w-xs flex-col gap-y-4">
                <dt class="leading-7 text-gray-200 text-4xl">Projects</dt>
                <dd class="order-first text-4xl font-semibold tracking-tight text-white sm:text-5xl"> {{ $projects->count() }} +</dd>
            </div>
            <div class="mx-auto flex max-w-xs flex-col gap-y-4">
                <dt class="text-4xl leading-7 text-gray-200">Clients</dt>
                <dd class="order-first text-4xl font-semibold tracking-tight text-white sm:text-5xl">{{ $clients->count() }} +</dd>
            </div>
        </dl>
    </div>
</div>