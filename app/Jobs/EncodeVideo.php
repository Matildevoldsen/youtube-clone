<?php

namespace App\Jobs;

use App\Models\Video;
use FFMpeg\Filters\Video\VideoFilters;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class EncodeVideo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $timeout = 0;
    /**
     * Create a new job instance.
     */
    public function __construct(public Video $video)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $qualities = [
            '360' => ['width' => 640, 'height' => 360, 'bitrate' => 800],
            '720' => ['width' => 1280, 'height' => 720, 'bitrate' => 2500],
            '1080' => ['width' => 1920, 'height' => 1080, 'bitrate' => 5000],
            '2160' => ['width' => 3840, 'height' => 2160, 'bitrate' => 15000],
        ];

        $media = FFMpeg::fromDisk('public')->open($this->video->original_file_path);
        $videoDimensions = $media->getVideoStream()->getDimensions();

        foreach ($qualities as $quality => $specs) {
            if ($videoDimensions->getWidth() >= $specs['width'] && $videoDimensions->getHeight() >= $specs['height']) {
                $format = (new \FFMpeg\Format\Video\X264('aac','libx264'))
                    ->setKiloBitrate($specs['bitrate']);

                $export = $media->export()
                    ->toDisk('public')
                    ->inFormat($format)
                    ->addFilter(function (VideoFilters $filters) use ($specs) {
                        $filters->resize(new \FFMpeg\Coordinate\Dimension($specs['width'], $specs['height']));
                    });

                $fileName = Str::random(16) . '_' . $quality . '.mp4';
                $export->save('exports/' . $fileName);

                $this->video->formats()->create([
                    'name' => $quality,
                    'file_path' => 'exports/' . $fileName,
                    'quality' => $quality
                ]);
            }
        }
    }
}
