<?php

namespace App\Filament\Imports;

use App\Models\PendingBeneficiary;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class PendingBeneficiaryImporter extends Importer
{
    protected static ?string $model = PendingBeneficiary::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('national_id')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('fullname')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('phonenumber')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('recipient_name')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('recipient_phone')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('recipient_nid')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('transfer_value')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
            ImportColumn::make('transfer_count')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
            ImportColumn::make('recieve_date')
                ->requiredMapping()
                ->rules(['required', 'date'])
                ->validationAttribute('date issue'),
        ];
    }

    public function resolveRecord(): ?PendingBeneficiary
    {
        // return PendingBeneficiary::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);
        return PendingBeneficiary::firstOrNew([
            //     // Update existing records, matching them by `$this->data['column_name']`
            'national_id' => $this->data['national_id'],
            'project_id' => '0',
         
          

        ]);
     
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your pending beneficiary import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
