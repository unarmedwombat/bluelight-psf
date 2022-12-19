<?php

namespace App\Filament\Pages;

use App\Exports\ContractorsExport;
use App\Exports\FrameworksExport;
use App\Exports\LotsExport;
use App\Exports\OrganisationsExport;
use App\Models\Framework;
use Filament\Pages\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class Exports extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-download';

    protected static string $view = 'filament.pages.exports';

    protected static ?string $navigationGroup = 'Settings';

    protected static ?int $navigationSort = 4;

    public $type;

    public $lots;

    public array $frameworks;

    public $framework;

    public function mount()
    {
        $this->lots = false;
        $this->frameworks = Framework::all()->pluck('full_title', 'id')->toArray();
    }

    public function updated($prop)
    {
        if ($prop == 'type') {
            $this->lots = ($this->type == 'lots');
        }
    }

    public function download(Request $request)
    {
        $this->validate([
            'type' => 'required',
            'framework' => 'required_if:type,lots',
        ]);

        switch ($this->type) {
            case 'clients':
                Excel::store(new ClientsExport(), 'public/clients-template.xlsx');
                return response()->download('storage/clients-template.xlsx');
                break;
            case 'organisations':
                Excel::store(new OrganisationsExport(), 'public/organisations-template.xlsx');
                return response()->download('storage/organisations-template.xlsx');
                break;
            case 'frameworks':
                Excel::store(new FrameworksExport, 'public/frameworks-template.xlsx');
                return response()->download('storage/frameworks-template.xlsx');
                break;
            case 'contractors':
                Excel::store(new ContractorsExport, 'public/contractors-template.xlsx');
                return response()->download('storage/contractors-template.xlsx');
                break;
            case 'lots':
                $framework = Framework::with('lots', 'regions')->find($this->framework);
                Excel::store(new LotsExport($this->framework), 'public/candidates-' . Str::slug($framework->fullTitle) . '.xlsx');
                return response()->download('storage/candidates-' . Str::slug($framework->fullTitle) . '.xlsx');
                break;

            default:
                break;
        }

        return back();
    }
}
