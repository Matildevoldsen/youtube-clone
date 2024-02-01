<x-app-layout>
    <div class="py-12 max-w-7xl mx-auto">
        <div class="grid gap-x-8 gap-y-4 grid-cols-3">
            @foreach ($videos as $video)
                <livewire:video-card lazy :video="$video" :key="$video->id"/>
            @endforeach
        </div>
    </div>
</x-app-layout>
