<div>
    <div class="flex">
        banner
    </div>
    <div class="flex justify-between">
        <div class="flex">
            <img src="{{ $channel?->profile_photo_url }}"
                 alt="{{ $channel?->name }}'s profile picture"
                 class="rounded-full z-50 mt-[-15px] shadow-sm border-slate-300 w-24"/>
            <div class="ml-2">
                <h1 class="font-bold text-2xl">{{ $channel?->name }}</h1>
                <p>
                    <span>{{ '@' . $channel?->username }}</span>
                    <span class="border-l-2 h-4 border-gray-300 nl-3 mr-2"></span>
                    <span>
                         1k subscribers
                    </span>
                    <span class="border-l-2 h-4 border-gray-300 nl-3 mr-2"></span>
                    <span>
                        {{ Number::abbreviate($channel->totalViews()) }} {{ Str::plural('views',  $channel->totalViews()) }}
                    </span>
                </p>
            </div>
        </div>
    </div>
    <div class="mt-5">
        <x-tabs selected="home">
            <x-tab name="home" label="Home">
                <div>Home</div>
            </x-tab>
            <x-tab name="videos" label="Videos">
                <div class="grid gap-x-8 gap-y-4 grid-cols-3">
                    @foreach ($channel->videos as $video)
                        <livewire:video-card lazy :video="$video" wire:key="$video->id"/>
                    @endforeach
                </div>
            </x-tab>
        </x-tabs>
    </div>
</div>
