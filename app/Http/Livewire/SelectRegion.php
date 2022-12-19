<?php

namespace App\Http\Livewire;

use App\Models\Region;
use Livewire\Component;

class SelectRegion extends Component
{
    public $regions;
    public $regionId;

    protected $listeners = [
        'getRegion',
    ];

    public $rules = [
        'regions' => '',
        'regionId' => '',
    ];

    public function mount()
    {
        $this->regions = Region::all();
        if (auth()->user()->client->region_id)
        {
            $this->selectRegionId(auth()->user()->client->region_id);
        }
    }

    public function selectRegionId($id)
    {
        $this->regionId = $id;
        $this->emit('regionIdUpdated', $this->regionId);
    }

    public function render()
    {
        return view('livewire.select-region');
    }

    public function getRegion()
    {
        $this->emit('regionIdUpdated', $this->regionId);
    }
}
