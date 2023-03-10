<?php

namespace Modules\HR\Filament\Resources;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Modules\HR\Filament\Resources\CompanyResource\Pages;
use Modules\HR\Models\Company;
use Modules\LAM\Filament\Resources\UserResource\RelationManagers\AddressesRelationManager;

class CompanyResource extends Resource
{
    protected static ?string $model = Company::class;

    protected static function getNavigationIcon(): string
    {
        return config('hr.models.Company.icon');
    }

    protected static function getNavigationGroup(): ?string
    {
        return config('hr.hr-navigation.name');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make([
                    Forms\Components\TextInput::make("name")
                        ->unique("companies","name",fn($record)=>$record)
                        ->required(),
                    Forms\Components\TextInput::make("abbr")
                        ->unique("companies","abbr",fn($record)=>$record)
                        ->required(),
                    Forms\Components\BelongsToSelect::make("parent")
                        ->relationship("parent","name",fn($query)=>$query->where("is_group",true))
                        ->createOptionForm([
                            Forms\Components\Group::make([
                                Forms\Components\TextInput::make("name")
                                    ->unique("companies","name",fn($record)=>$record)
                                    ->required(),
                                Forms\Components\TextInput::make("abbr")
                                    ->unique("companies","abbr",fn($record)=>$record)
                                    ->required(),
                                Forms\Components\Hidden::make("is_group")
                                    ->default(true),
                            ])->columns(2),
                        ])
                        ->nullable(),
                    Forms\Components\TextInput::make("domain")
                        ->nullable(),
                    Forms\Components\Toggle::make("is_group"),
                    Forms\Components\SpatieMediaLibraryFileUpload::make("logo")
                        ->collection("logo"),
                    Forms\Components\MarkdownEditor::make("description")
                        ->columnSpan(2)
                        ->nullable(),
                ])->columns(2),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make("logo")
                    ->collection("logo")
                    ->conversion("thumb")
                    ->rounded(),
                Tables\Columns\TextColumn::make("name")->searchable(),
                Tables\Columns\TextColumn::make("abbr")->searchable(),
                Tables\Columns\TextColumn::make("domain")->searchable(),
                Tables\Columns\TextColumn::make("parent.name")->searchable(),
                Tables\Columns\BooleanColumn::make("is_group"),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            AddressesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCompanies::route('/'),
            'create' => Pages\CreateCompany::route('/create'),
            'edit' => Pages\EditCompany::route('/{record}/edit'),
        ];
    }
}
