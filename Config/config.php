<?php

return [
    'name' => 'HR',
    'setting'=>[
        'label'=>'Human Resources',
        'icon'=>'heroicon-o-identification'
    ],
    'resources'=>[
        "company"=>[
            "name"=>"Company",
            'icon'=>'heroicon-o-library',
        ],
        ""
    ],
    'models'=>[
        'Company'=>[
            'icon'=>'heroicon-o-library'
        ],
        'Employee'=>[
            'icon'=>'heroicon-o-user-group'
        ],
        'Department'=>[
            'icon'=>'heroicon-o-folder'
        ],
        'Designation'=>[
            'icon'=>'heroicon-o-grid'
        ],
        'Holiday'=>[
            'icon'=>'heroicon-o-clipboard-list'
        ],
        'LeaveType'=>[
            'icon'=>'heroicon-o-folder'
        ],
    ],
    'hr-navigation'=>[
        'name' => 'Human Resources',
        'enabled' => true,
    ],
    'setting-navigation'=>[
        'name' => 'Settings',
        'enabled' => true,
    ],
    'leave-navigation'=>[
        'name' => 'Leave',
        'enabled' => true,
    ],
];
