<?php

namespace App\Filament\Resources\ApplicationResource\Pages;

use App\Filament\Resources\ApplicationResource;
use App\Mail\WelcomeMail;
use App\Models\User;
use Filament\Pages\Actions\ButtonAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Livewire\Redirector;

class EditApplication extends EditRecord
{
    protected static string $resource = ApplicationResource::class;

    protected function getFormActions(): array
    {
        return array_merge(parent::getFormActions(), [
            ButtonAction::make('create_user')->color('success')->action('createUser'),
        ]);
    }

    public function createUser(): RedirectResponse|Redirector
    {
        $user = New User;
        $user->client_id = $this->data['client_id'];
        $user->name = $this->data['name'];
        $user->email = $this->data['email'];
        $user->phone = $this->data['phone'];
        $user->job_title = $this->data['job_title'];
        $user->job_category = $this->data['job_category'];
        $user->notes = $this->data['notes'];
        $user->password = Hash::make($this->data['password']);
        $user->save();

        Mail::to($user->email)
            ->bcc('david@dsc.co.uk')
            ->queue(new WelcomeMail($user, $this->data['password']));

        $this->record->password = null;
        $this->record->user_id = $user->id;
        $this->record->save();
        $this->record->delete();

        $this->notify('success', 'User created and notified');
        return redirect()->route('filament.resources.applications.index');
    }

}
