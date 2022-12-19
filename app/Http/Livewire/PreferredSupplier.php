<?php

namespace App\Http\Livewire;

use App\Models\Contractor;
use Livewire\Component;

class PreferredSupplier extends Component
{
    public $title;
    public $contractorId;
    public $contractors;

    public $contractor;

    protected $rules = [
        'contractors.*.id' => '',
        'contractors.*.title' => '',

        'contractor.id' => '',
        'contractor.title' => '',
    ];

    public function mount()
    {
        $this->getContractors();
    }

    public function updatedContractorId()
    {
        $this->contractor = Contractor::find($this->contractorId);
        $this->emit('contractorUpdated', $this->contractorId);
    }

    public function updatedTitle()
    {
        $this->getContractors();
    }

    public function getContractors()
    {
        $this->contractors = Contractor::query()
            ->when($this->title, function ($query, $name) {
                return $query->where('title', 'LIKE', '%' . $name . '%');
            })
            ->orderBy('title')
            ->get();
    }

    public function render()
    {
        return view('livewire.preferred-supplier');
    }
}
