<div x-data="{playing: false}">
    <div class="col-span-4">
        <x-card>
            <x-slot:figure>
                <video x-ref="player"
                       @mouseenter="playing = true; $refs.player.play"
                       @mouseleave="playing = false; $refs.player.pause();$refs.player.currentTime = 0"
                       id="player"
                       muted
                       loop
                       poster="/{{ $video->thumbnail_path ?? '' }}"
                       data-poster="/{{ $video->thumbnail_path ?? '' }}">
                    @foreach($video->formats as $format)
                        <source src="/{{ $format->file_path }}" type="video/mp4" size="{{ $format->quality }}"/>
                    @endforeach
                </video>
            </x-slot:figure>
            <div class="space-y-2">
                <div class="flex justify-between items-center">
                    <div class="flex-grow-1 w-[150px]">
                        <a href="#" wire:navigate>
                            <img src="{{ $video->user->profile_photo_url }}" class="rounded-full w-10"/>
                        </a>
                    </div>
                    <a href="{{ route('video.show', $video) }}" wire:navigate class="flex flex-col space-y-1.5">
                        <h2 class="text-2xl flex-wrap">
                            {{ $video->title }}
                        </h2>
                        <div>
                            {{ $video->user->name }}
                            <span class="border-l-2 h-4 border-gray-300 ml-2 mr-2"></span>
                            {{ Number::abbreviate(views($video)->unique()->count()) }}
                            <span class="border-l-2 h-4 border-gray-300 ml-2 mr-2"></span>
                            <time datetime="{{ $video->created_at }}" title="{{ $video->created_at }}">
                                {{ $video->created_at->diffForHumans() }}
                            </time>
                        </div>
                    </a>
                </div>
            </div>
        </x-card>
    </div>
</div>
