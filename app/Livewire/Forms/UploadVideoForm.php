<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class UploadVideoForm extends Form
{
    #[Validate('required')]
    public string $title;
    #[Validate('required')]
    public string $description;
    #[Validate('required')]
    public array $tags;
    #[Validate('required')]
    public $thumbnail_path;

    #[Validate('required')]
    public $live_at;
}
