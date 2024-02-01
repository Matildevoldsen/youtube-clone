<?php

namespace App\Livewire;

use App\Models\Video;
use Livewire\Component;

class VideoCard extends Component
{
    public Video $video;

    public function render()
    {
        return view('livewire.video-card');
    }
}
