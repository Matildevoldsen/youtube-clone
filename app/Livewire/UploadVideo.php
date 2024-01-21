<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class UploadVideo extends Component
{
    public bool $modal = false;

    #[On('toggleModal')]
    public function toggleModal()
    {
        $this->modal = !$this->modal;

    }

    public function render()
    {
        return view('livewire.upload-video');
    }
}
