<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class CheckDuplicates extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-duplicate';
    protected static ?int $navigationSort = 2;
    protected static string $view = 'filament.pages.check-duplicates';
    protected static ?string $navigationGroup = 'Projects';
}
