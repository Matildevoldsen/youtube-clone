<x-modal wire:model="modal" title="Upload Video">
    <form x-data="{
        uploader: null,
        progress: 0,
        submit() {
            const file = $refs.file.files[0]

            if (!file) {
                return
            }

            this.uploader = createUpload({
                file: file,
                endpoint: '{{ route('video.upload') }}',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                method: 'post',
                chunkSize: 10 * 1024, // 10mb
            })

            this.uploader.on('chunkSuccess', (response) => {
                if (!response.detail.response.body) {
                    return
                }

                $wire.call('handleSuccess', file.name, JSON.parse(response.detail.response.body).file)
            })

            this.uploader.on('progress', (progress) => {
                this.progress = progress.detail
            })

            this.uploader.on('success', () => {
                this.uploader = null
                this.progress = 100
            })
        }
    }">
        <div>
            <label x-show="progress === 0"
                   class="flex w-full h-40 border-2 border-gray-400 border-dashed justify-center items-center"
                   for="video">
                <span>
                    <x-icon name="fas.upload" label="Upload Video"/>
                </span>
                <input type="file" x-on:change.prevent="submit" x-ref="file" class="hidden" id="video"
            </label>
        </div>
        <template x-if="uploader">
            <div class="space-y-1">
                <x-progress x-bind:value="progress" max="100"/>
            </div>
        </template>
    </form>
    @if ($uploaded)
        <x-form wire:submit="updateVideo">
            <div wire:poll>
                @if (!$video->thumbnail_path)
                    <div class="skeleton w-full h-52"></div>
                @endif
                @if ($video->thumbnail_path)
                    <x-file wire:model="form.thumbnail_path" class="w-full" crop-after-change>
                        <img src="{{ $video->thumbnail_path }}" class="w-full rounded-lg"/>
                    </x-file>
                @endif
            </div>
            <div class="space-y-2">
                <x-input label="Title" wire:model="form.title"/>
                <x-textarea hint="Max 1000 characters" label="Description" wire:model="form.description"/>
                <x-tags id="tags" label="Tags" wire:model="form.tags"/>
                <x-datetime label="Schedule For" wire:model="form.live_at" icon="o-calendar" type="datetime-local"/>
            </div>
            @if ($video->thumbnail_path)
                <x-slot:actions>
                    <x-button wire:click="updateVideo" label="Publish" class="btn-primary" spinner="save" type="submit"/>
                </x-slot:actions>
            @endif
        </x-form>
    @endif
</x-modal>
