<div>
    <video id="player" playsinline controls data-poster="{{ $video->thumbnail_path }}">
        @foreach($video->formats as $format)
            <source src="/{{ $format->file_path }}" type="video/mp4" size="{{ $format->quality }}"/>
        @endforeach
    </video>
</div>
@script
<script>
    const player = new Plyr('#player', {
        previewThumbnails: {
            enabled: true,
            src: '{{ $video->vtt_file }}',
        }
    });
</script>
@endscript
