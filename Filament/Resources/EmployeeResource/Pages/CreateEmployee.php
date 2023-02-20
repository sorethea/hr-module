<?php

namespace Modules\HR\Filament\Resources\EmployeeResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Coresys\Models\User;
use Modules\HR\Filament\Resources\EmployeeResource;

class CreateEmployee extends CreateRecord
{
    protected static string $resource = EmployeeResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if($data["is_system_user"] && !empty($data['properties'])){

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
