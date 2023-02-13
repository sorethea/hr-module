<?php

namespace Modules\HR\Filament\Resources\EmployeeResource\Pages;

use App\Models\User;
use Modules\HR\Filament\Resources\EmployeeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEmployee extends CreateRecord
{
    protected static string $resource = EmployeeResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if($data["is_system_user"]){

            $name = $data["first_name"]." ".$data["last_name"];
            $user = User::where("email",$data["properties"]["email"])
                ->firstOrCreate([
                    "name" => $name,
                    "email" => $data["properties"]["email"],
                    "password" => \Hash::make($data["properties"]["password"]),
                ]);
            $data["user_id"] = $user->id;

        }
        return $data;
    }
}
