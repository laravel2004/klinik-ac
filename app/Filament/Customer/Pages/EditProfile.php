<?php

namespace App\Filament\Customer\Pages;

use App\Enums\Gender;
use App\Enums\Occupation;
use App\Models\User;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Auth\EditProfile as BasePage;
use Illuminate\Database\Eloquent\Model;

class EditProfile extends BasePage
{
    protected function fillForm(): void
    {
        $user = $this->getUser();

        $data = array_merge(
            $user->attributesToArray(),
            $user->customerProfile?->attributesToArray() ?? []
        );

        $this->callHook('beforeFill');
        $data = $this->mutateFormDataBeforeFill($data);
        $this->form->fill($data);
        $this->callHook('afterFill');
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $userData = collect($data)->only(['name', 'email', 'password'])->toArray();
        $customerProfileData = collect($data)->except(['name', 'email', 'password'])->toArray();

        $record->update($userData);

        if ($record->customerProfile()->exists()) {
            $record->customerProfile()->update($customerProfileData);
        } else {
            $record->customerProfile()->create($customerProfileData);
        }

        return $record;
    }

    public function form(Form $form): Form
    {
        return $this->makeForm()
            ->schema([
                Section::make()
                    ->schema([
                        Grid::make()
                            ->schema([
                                Group::make([
                                    $this->getNameFormComponent(),
                                    $this->getEmailFormComponent()
                                        ->disabled(),
                                    $this->getPasswordFormComponent(),
                                    $this->getPasswordConfirmationFormComponent(),
                                ]),
                                Group::make([
                                    $this->getGenderFormComponent(),
                                    $this->getBirthDateFormComponent(),
                                    $this->getPhoneFormComponent(),
                                    $this->getOccupationFormComponent(),
                                ]),
                                Group::make([
                                    $this->getAddressFormComponent(),
                                ])->columnSpanFull(),
                            ]),
                        Grid::make()
                            ->schema([
                                Placeholder::make('created_at')
                                    ->label(__('label.created_at'))
                                    ->content(fn (User $record): string =>
                                        $record->created_at->translatedFormat('l, j F Y H:i:s')
                                    ),
                                Placeholder::make('updated_at')
                                    ->label(__('label.updated_at'))
                                    ->content(fn (User $record): string =>
                                        $record->updated_at->translatedFormat('l, j F Y H:i:s')
                                    ),
                            ]),
                    ]),
            ])
            ->operation('edit')
            ->model($this->getUser())
            ->statePath('data');
    }

    protected function getGenderFormComponent(): Component
    {
        return Select::make('gender')
            ->label(__('label.gender'))
            ->options(
				collect(Gender::cases())
                    ->mapWithKeys(fn ($case) => [$case->value => $case->getLabel()])
                    ->toArray()
			);
    }

    protected function getBirthDateFormComponent(): Component
    {
        return DatePicker::make('birth_date')
            ->label(__('label.birth_date'))
            ->displayFormat('d/m/Y');
    }

    protected function getPhoneFormComponent(): Component
    {
        return TextInput::make('phone')
            ->label(__('label.phone'))
            ->tel()
            ->telRegex('/^(?:\+62|0)8[1-9][0-9]{6,9}$/');
    }

    protected function getOccupationFormComponent(): Component
    {
        return Select::make('occupation')
            ->label(__('label.occupation'))
            ->options(
                collect(Occupation::cases())
                    ->mapWithKeys(fn ($case) => [$case->value => $case->getLabel()])
                    ->toArray()
            )
            ->searchable();
    }

    protected function getAddressFormComponent(): Component
    {
        return Textarea::make('address')
            ->label(__('label.address'))
            ->rows(5);
    }
}
