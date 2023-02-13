<?php

namespace Modules\HR\Filament\Resources\EmployeeResource\Pages;

use App\Models\User;
use Modules\HR\Filament\Resources\EmployeeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEmployee extends EditRecord
{
    protected static string $resource = EmployeeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if($data["is_system_user"]){
            $name = $data["first_name"]." ".$data["last_name"];
            $user = User::where("email",$data["properties.email"])
                ->firstOrCreate([
                    "name" => $name,
                    "email" => $data["properties.email"],
                    "password" => \Hash::make($data['properties.password']),
                ]);
            $data["user_id"] = $user->id;
        }
        return $data;
    }
}
