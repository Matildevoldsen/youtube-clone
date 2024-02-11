<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class Channel extends Component
{
    public User $channel;

    public function render()
    {
        return view('livewire.channel');
    }
}
