<?php

namespace App\Livewire;

use App\Models\Video;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;

class VideoPage extends Component
{
    public Video $video;
    public function mount()
    {
        views($this->video)->record();
    }
    public function like(): void
    {
        $this->video->updateLikeStatus('like');
        $this->video->loadCount(['likes', 'dislikes']);
    }

    public function dislike(): void
    {
        $this->video->updateLikeStatus('dislike');
        $this->video->loadCount(['likes', 'dislikes']);
    }


    public function render(): View
    {
        return view('livewire.video-page');
    }
}
