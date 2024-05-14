@props(['heading'])

<section class="py-8 max-w-4xl mx-auto">

    <div class="mb-8 flex">
        <x-button class="mr-4">
            <a href="{{ url()->previous() }}"> Go Back </a>
        </x-button>

        <h1 class="text-lg font-bold pb-2 border-b">
            {{ $heading }}
        </h1>
    </div>

    <x-panel {{ $attributes->merge([ 'class' => '']) }} >
        {{ $slot }}
    </x-panel>
    </div>
</section>
