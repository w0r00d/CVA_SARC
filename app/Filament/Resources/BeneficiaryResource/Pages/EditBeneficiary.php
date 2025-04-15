<?php

namespace App\Filament\Resources\BeneficiaryResource\Pages;

use App\Filament\Resources\BeneficiaryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBeneficiary extends EditRecord
{
    protected static string $resource = BeneficiaryResource::class;

    protected function getHeaderActions(): array
    {
        return [
          //  Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['updated_by'] = auth()->id();
      //  dump( $data['fullname']);
        return $data;
    }
}
