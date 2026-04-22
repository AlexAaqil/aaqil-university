<?php

namespace App\Livewire\Pages\General;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.pages.general.index')->layout('layouts.guest');
    }
}
