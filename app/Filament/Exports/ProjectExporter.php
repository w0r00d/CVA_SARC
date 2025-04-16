<?php

namespace App\Filament\Exports;

use App\Models\ProjectResource;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class ProjectExporter extends Exporter
{
    protected static ?string $model = ProjectResource::class;

    public static function getColumns(): array
    {
        return [
            //
            ExportColumn::make('name'),
            ExportColumn::make('donor'),
            ExportColumn::make('partner'),
            ExportColumn::make('start_date'),
            ExportColumn::make('end_date'),
            ExportColumn::make('status'),
            ExportColumn::make('governate'),
            ExportColumn::make('sector'),
            ExportColumn::make('modality'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your project resource export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
