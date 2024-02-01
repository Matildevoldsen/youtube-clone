<?php

namespace App\Livewire;

use App\Models\Video;
use Livewire\Component;

class Player extends Component
{
    public Video $video;
    public function render()
    {
        return view('livewire.player');
    }
}
