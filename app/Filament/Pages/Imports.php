<?php

namespace App\Filament\Pages;

use App\Imports\CandidatesImport;
use App\Imports\ClientsImport;
use App\Imports\ContractorsImport;
use App\Imports\FrameworksImport;
use App\Imports\OrganisationsImport;
use App\Models\Framework;
use Filament\Pages\Page;
use Illuminate\Http\Request;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class Imports extends Page
{
    use WithFileUploads;

    protected static ?string $navigationIcon = 'heroicon-o-upload';

    protected static string $view = 'filament.pages.imports';

    protected static ?string $navigationGroup = 'Settings';

    protected static ?int $navigationSort = 3;

    public $file;

    public $type;

    public $candidates;

    public $frameworks;

    public $framework;

    public function mount()
    {
        $this->candidates = false;
        $this->frameworks = Framework::all()->pluck('full_title', 'id')->toArray();
    }

    public function updated($prop)
    {
        if ($prop == 'type') {
            $this->candidates = ($this->type == 'candidates');
        }
    }

    public function upload(Request $request)
    {
        $this->validate([
            'type' => 'required',
            'framework' => 'required_if:type,candidates',
            'file' => 'mimes:xlsx',
        ]);

        switch ($this->type) {
            case 'clients':
                Excel::import(new ClientsImport, $this->file);
                return redirect()->to('/admin/clients');
                break;
            case 'organisations':
                Excel::import(new OrganisationsImport, $this->file);
                return redirect()->to('/admin/organisations');
                break;
            case 'frameworks':
                Excel::import(new FrameworksImport, $this->file);
                return redirect()->to('/admin/frameworks');
                break;
            case 'contractors':
                Excel::import(new ContractorsImport, $this->file);
                return redirect()->to('/admin/contractors');
                break;
            case 'candidates':
                $framework = Framework::with('lots', 'regions')->find($this->framework);
                Excel::import(new CandidatesImport($framework), $this->file);
                return redirect()->to('/admin/contractors');
                break;
            default:
                break;
        }

        return back();
    }
}
