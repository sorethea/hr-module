<?php

namespace Modules\HR\Filament\Resources;

use Modules\HR\Filament\Resources\EmployeeResource\Pages;
use Modules\HR\Filament\Resources\EmployeeResource\RelationManagers;
use Modules\HR\Models\Employee;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\HR\Settings\HRSetting;
use Spatie\LaravelSettings\Settings;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static function getNavigationIcon(): string
    {
        return config('hr.models.Employee.icon');
    }

    protected static function getNavigationGroup(): ?string
    {
        return config('hr.hr-navigation.name');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Wizard::make([
                    Forms\Components\Wizard\Step::make("info")->schema([
                        Forms\Components\Card::make([
                            Forms\Components\TextInput::make("first_name")
                                ->required(),
                            Forms\Components\TextInput::make("last_name")
                                ->required(),
                            Forms\Components\BelongsToSelect::make("company")
                                ->relationship("company", "name")
                                ->searchable()
                                ->createOptionForm([
                                    Forms\Components\Group::make([
                                        Forms\Components\TextInput::make("name")
                                            ->unique("companies","name",fn($record)=>$record)
                                            ->required(),
                                        Forms\Components\TextInput::make("abbr")
                                            ->unique("companies","abbr",fn($record)=>$record)
                                            ->required(),
                                        Forms\Components\BelongsToSelect::make("parent")
                                            ->relationship("parent","name",fn($query)=>$query->where("is_group",true))
                                            ->nullable(),
                                        Forms\Components\Toggle::make("is_group")
                                            ->default(false),
                                    ])->columns(2),
                                ])
                                ->required(),
                            Forms\Components\Hidden::make("user_id"),
                            Forms\Components\Toggle::make("is_system_user")
                                ->reactive()
                                ->default(false),
                            Forms\Components\TextInput::make("properties.email")
                                ->visible(fn($record,\Closure $get)=>$get("is_system_user") && empty($record->user_id))
                                ->required(),
                            Forms\Components\TextInput::make("properties.password")
                                ->password()
                                ->required()
                                ->visible(fn($record,\Closure $get)=>$get("is_system_user") && empty($record->user_id))
                                ->same("password_confirmation"),
                            Forms\Components\TextInput::make("password_confirmation")
                                ->password()
                                ->visible(fn($record,\Closure $get)=>$get("is_system_user") && empty($record->user_id))
                                ->required(),
                            Forms\Components\Select::make("gender")
                                ->options(app(HRSetting::class)->gender)
                                ->searchable()
                                ->required(),
                            Forms\Components\Select::make("employment_type")
                                ->searchable()
                                ->options(app(HRSetting::class)->employment_type),
                            Forms\Components\DatePicker::make("date_of_birth")
                                ->required(),
                            Forms\Components\DatePicker::make("date_of_joining")
                                ->required(),
                            Forms\Components\Toggle::make("active")
                                ->default(true),
                            Forms\Components\SpatieMediaLibraryFileUpload::make("avatar")
                                ->collection("avatar")
                                ->nullable(),
                        ])->columns(2),
                    ]),
                    Forms\Components\Wizard\Step::make("contact details")->schema([
                        Forms\Components\Card::make([
                            Forms\Components\TextInput::make("contact_details.id_number")
                                ->helperText("ID card number or passport number")
                                ->required(),
                            Forms\Components\TextInput::make("contact_details.mobile_number")
                                ->required(),
                            Forms\Components\TextInput::make("contact_details.personal_email")
                                ->nullable(),
                            Forms\Components\TextInput::make("contact_details.company_email")
                                ->nullable(),
                            Forms\Components\Textarea::make("contact_details.permanent_address")
                                ->nullable(),
                            Forms\Components\Textarea::make("contact_details.current_address")
                                ->nullable(),
                        ])->columnSpan(2)->columns(2),
                    ]),
                    Forms\Components\Wizard\Step::make("educations")->schema([
                        Forms\Components\Card::make([
                            Forms\Components\Repeater::make("educations")->schema([
                                Forms\Components\TextInput::make("educations.education_institution")->required(),
                                Forms\Components\TextInput::make("educations.year_of_passing")->required(),
                                Forms\Components\TextInput::make("educations.qualification")->nullable(),
                                Forms\Components\TextInput::make("educations.level")->nullable(),
                            ])->columnSpan(2)->columns(4),
                        ])->columnSpan(2)->columns(2),
                    ]),
                    Forms\Components\Wizard\Step::make("work experiences")->schema([
                        Forms\Components\Card::make([
                            Forms\Components\Repeater::make("work_experiences")->schema([
                                Forms\Components\TextInput::make("work_experiences.company")->required(),
                                Forms\Components\TextInput::make("work_experiences.designation")->required(),
                                Forms\Components\TextInput::make("work_experiences.from_year")->nullable(),
                                Forms\Components\TextInput::make("work_experiences.to_year")->nullable(),
                            ])->columnSpan(2)->columns(4),
                        ])->columnSpan(2)->columns(2),
                    ]),
                    Forms\Components\Wizard\Step::make("attachments")->schema([
                        Forms\Components\Card::make([
                            Forms\Components\SpatieMediaLibraryFileUpload::make("attachments")
                                ->collection("employee_attachments")
                                ->columnSpan(2)
                                ->multiple(),
                        ]),
                    ]),
                ])->columnSpan(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make("avatar")
                    ->collection("avatar")
                    ->rounded(),
                Tables\Columns\TextColumn::make("first_name")->searchable(),
                Tables\Columns\TextColumn::make("last_name")->searchable(),
                Tables\Columns\TextColumn::make("company.name")->searchable(),
                Tables\Columns\TextColumn::make("gender")->searchable(),
                Tables\Columns\TextColumn::make("employment_type")->searchable(),
                Tables\Columns\BooleanColumn::make("is_system_user"),
                Tables\Columns\BooleanColumn::make("active"),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}
