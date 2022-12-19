<?php

namespace App\Http\Livewire;

use Livewire\Component;

class EstimateBudget extends Component
{
    public $budget = '10m';

    protected $listeners = [
        'getBudget',
    ];

    public function render()
    {
        return view('livewire.estimate-budget');
    }

    public function getBudget()
    {
        $this->emit('budgetUpdated', $this->budget);
    }

}
