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
            $user = User::where("email",$data["email"])
                ->firstOrCreate([
                    "name" => $name,
                    "email" => $data["email"],
                    "password" => \Hash::make($data['password']),
                ]);
            $data["user_id"] = $user->id;
        }
        return $data;
    }
}
