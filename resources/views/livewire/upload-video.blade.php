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
        }
    }">
        <div>
            <label class="flex w-full h-40 border-2 border-gray-400 border-dashed justify-center items-center"
                   for="video">
                <span>
                    <x-icon name="fas.upload" label="Upload Video"/>
                </span>
                <input type="file" x-on:change.prevent="submit" x-ref="file" class="hidden" id="video"
            </label>
        </div>
    </form>
</x-modal>
