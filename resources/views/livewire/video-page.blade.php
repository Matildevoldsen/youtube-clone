<div class="max-w-7xl mx-auto mt-5">
    <div>
        <div class="card max-w bg-base-100 shadow-xl">
            <livewire:player :video="$video" :key="$video->id"/>

            <div class="card-body">
                <div class="card-title flex justify-between">
                    <h1>
                        {{ $video->title }}
                    </h1>

                    <div wire:poll.1m class="space-x-5">
                        @auth
                            <x-icon class="transition-all cursor-pointer hover:scale-125 hover:text-blue-500"
                                    wire:click="like"
                                    label="{{ Number::abbreviate($video->likes->count()) }}"
                                    name="fas.thumbs-up"/>
                            <x-icon class="transition-all cursor-pointer hover:scale-125 hover:text-red-500"
                                    wire:click="dislike"
                                    label="{{ Number::abbreviate($video->dislikes->count()) }}"
                                    name="fas.thumbs-down"/>
                        @endauth

                        @guest
                            <x-icon label="{{ Number::abbreviate($video->likes->count()) }}"
                                    name="fas.thumbs-up"/>
                            <x-icon label="{{ Number::abbreviate($video->dislikes->count()) }}"
                                    name="fas.thumbs-down"/>
                        @endguest
                    </div>
                </div>
                <div class="flex flex-col space-y-2">
                    <div>
                        <small class="text-sm flex">
                            <x-icon name="far.eye" label="{{ Number::abbreviate(views($video)->unique()->count()) }}"/>
                            <span class="border-l-2 border-gray-300 ml-2 mr-2"></span>
                            <time datetime="{{ $video->created_at }}" title="{{ $video->created_at }}">
                                {{ $video->created_at->diffForHumans() }}
                            </time>
                        </small>
                    </div>
                    <p>
                        {{ $video->description }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
