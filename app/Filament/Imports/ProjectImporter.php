<?php

namespace App\Filament\Imports;

use App\Models\Project;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class ProjectImporter extends Importer
{
    protected static ?string $model = Project::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('name')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('donor')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('partner')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('start_date')
                ->requiredMapping()
                ->rules(['required', 'date']),
            ImportColumn::make('end_date')
                ->requiredMapping()
                ->rules(['required', 'date']),
            ImportColumn::make('status')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('governate')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('sector')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('modality')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
        ];
    }

    public function resolveRecord(): ?Project
    {
        // return Project::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new Project();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your project import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
