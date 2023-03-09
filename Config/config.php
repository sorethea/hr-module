<?php

return [
    'name' => 'HR',
    'setting'=>[
        'label'=>'HR Settings',
        'icon'=>'heroicon-o-cog'
    ],
    'models'=>[
        'Company'=>[
            'icon'=>'heroicon-o-library'
        ],
        'Employee'=>[
            'icon'=>'heroicon-o-user-group'
        ],
        'Holiday'=>[
            'icon'=>'heroicon-o-clipboard-list'
        ],
        'LeaveType'=>[
            'icon'=>'heroicon-o-folder'
        ],
    ],
    'navigation'=>[
        'name' => 'Human Resources',
        'enabled' => true,
    ],
];
