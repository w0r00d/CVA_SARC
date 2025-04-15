<?php

namespace App\Filament\Resources\BeneficiaryResource\Pages;

use App\Filament\Resources\BeneficiaryResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use App\Models\Beneficiary;
use Filament\Infolists;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;



class ViewBeneficiary extends ViewRecord
{
    protected static string $resource = BeneficiaryResource::class;

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Beneficiary Personal Data')
                    ->icon('heroicon-s-user')
                    ->columns(3)
                    ->schema([
                        TextEntry::make('fullname'),
                        Infolists\Components\TextEntry::make('national_id'),
                        Infolists\Components\TextEntry::make('phonenumber')
                            ->label('Phone number')
                            ->icon('heroicon-s-phone'),
                        Infolists\Components\TextEntry::make('h_fullname')
                            ->label('Name Before update')
                            ->placeholder('not updated'),
                        Infolists\Components\TextEntry::make('h_national_id')
                            ->label('National ID Before update')
                            ->placeholder('not updated'),
                        Infolists\Components\TextEntry::make('h_phonenumber')
                            ->label('Phone Number Before update')
                            ->placeholder('not updated')
                            ->icon('heroicon-s-phone'),
                    ]),
                Section::make('Recipient Personal Data')
                    ->icon('heroicon-s-user')
                    ->columns(3)
                    ->schema([
                        Infolists\Components\TextEntry::make('recipient_name'),
                        Infolists\Components\TextEntry::make('recipient_nid'),
                        Infolists\Components\TextEntry::make('recipient_phone')
                            ->icon('heroicon-s-phone'),
                        Infolists\Components\TextEntry::make('h_recipient_name')
                            ->label('Name Before update')
                            ->placeholder('not updated'),
                        Infolists\Components\TextEntry::make('h_recipient_nid')
                            ->label('National ID Before update')
                            ->placeholder('not updated'),
                        Infolists\Components\TextEntry::make('h_recipient_phone')
                            ->label('Phone Number Before update')
                            ->placeholder('not updated')
                            ->icon('heroicon-s-phone'),
                    ]),

                Section::make('Project Detail')
                    ->icon('heroicon-s-information-circle')
                    ->columns(3)
                    ->schema([
                        Infolists\Components\TextEntry::make('project.name')
                        ->label('Project Name'),
                        Infolists\Components\TextEntry::make('project.partner')
                        ->label('Partner'),
                        Infolists\Components\TextEntry::make('project.sector')
                        ->label('Sector'),
                        Infolists\Components\TextEntry::make('project.modality')
                        ->label('Modality'),
                        Infolists\Components\TextEntry::make('project.start_date')
                            ->icon('heroicon-s-calendar-days')
                            ->label('Start Date'),
                        Infolists\Components\TextEntry::make('project.end_date')
                            ->icon('heroicon-s-calendar-days')
                            ->label('End Date'),
                    ]),

                Section::make('Transfer Details')
                    ->icon('heroicon-s-banknotes')
                    ->columns(3)
                    ->schema([
                        Infolists\Components\TextEntry::make('transfer_value')
                            ->icon('heroicon-s-banknotes'),
                        Infolists\Components\TextEntry::make('transfer_count'),
                        Infolists\Components\TextEntry::make('recieve_date')
                            ->icon('heroicon-s-calendar-days'),
                        Infolists\Components\TextEntry::make('h_transfer_value')
                            ->placeholder('not updated')
                            ->label('Transfer Value Before update')
                            ->icon('heroicon-s-banknotes'),
                        Infolists\Components\TextEntry::make('h_transfer_count')
                            ->placeholder('not updated')
                            ->label('Transfer Count Before update'),
                    ]),                              
                Section::make('Update Details')
                    ->icon('heroicon-s-pencil-square')
                    ->columns(2)
                    ->schema([
                       
                        Infolists\Components\TextEntry::make('created_at')->icon('heroicon-s-calendar-days')
                        ->placeholder('not updated'),
                        Infolists\Components\TextEntry::make('updated_at')->icon('heroicon-s-calendar-days')
                        ->label('Last updated at')
                        ->placeholder('not updated'),
                        Infolists\Components\TextEntry::make('created_by.name')->icon('heroicon-s-user')
                        ->placeholder('not updated'),
                        Infolists\Components\TextEntry::make('updated_by.name')->icon('heroicon-s-user')
                        ->label('Last updated by')
                        ->placeholder('not updated'),
                    ]),

              
            ]);
    }
}
