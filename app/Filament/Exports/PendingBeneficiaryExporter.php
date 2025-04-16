<?php

namespace App\Filament\Exports;

use App\Models\PendingBeneficiary;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class PendingBeneficiaryExporter extends Exporter
{
    protected static ?string $model = PendingBeneficiary::class;

    public static function getColumns(): array
    {
        return [
            
            ExportColumn::make('national_id'),
            ExportColumn::make('fullname'),
            ExportColumn::make('phonenumber'),
            ExportColumn::make('recipient_name'),
            ExportColumn::make('recipient_phone'),
            ExportColumn::make('recipient_nid'),
            ExportColumn::make('transfer_value'),
            ExportColumn::make('transfer_count'),
            ExportColumn::make('recieve_date'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your pending beneficiary export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
