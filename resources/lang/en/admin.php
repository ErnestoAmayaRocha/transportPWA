<?php

return [
    'admin-user' => [
        'title' => 'Users',

        'actions' => [
            'index' => 'Users',
            'create' => 'New User',
            'edit' => 'Edit :name',
            'edit_profile' => 'Edit Profile',
            'edit_password' => 'Edit Password',
        ],

        'columns' => [
            'id' => 'ID',
            'last_login_at' => 'Last login',
            'first_name' => 'First name',
            'last_name' => 'Last name',
            'email' => 'Email',
            'password' => 'Password',
            'password_repeat' => 'Password Confirmation',
            'activated' => 'Activated',
            'forbidden' => 'Forbidden',
            'language' => 'Language',
                
            //Belongs to many relations
            'roles' => 'Roles',
                
        ],
    ],

    'rutasazule' => [
        'title' => 'Rutasazules',

        'actions' => [
            'index' => 'Rutasazules',
            'create' => 'New Rutasazule',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'nombre_ruta' => 'Nombre ruta',
            'costo' => 'Costo',
            
        ],
    ],

    'rutasroja' => [
        'title' => 'Rutasrojas',

        'actions' => [
            'index' => 'Rutasrojas',
            'create' => 'New Rutasroja',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'nombre_ruta' => 'Nombre ruta',
            'costo' => 'Costo',
            
        ],
    ],

    'rutasverde' => [
        'title' => 'Rutasverdes',

        'actions' => [
            'index' => 'Rutasverdes',
            'create' => 'New Rutasverde',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            
        ],
    ],

    'rutasverde' => [
        'title' => 'Rutasverdes',

        'actions' => [
            'index' => 'Rutasverdes',
            'create' => 'New Rutasverde',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'nombre_ruta' => 'Nombre ruta',
            'costo' => 'Costo',
            
        ],
    ],

    'rutaverde' => [
        'title' => 'Rutaverdes',

        'actions' => [
            'index' => 'Rutaverdes',
            'create' => 'New Rutaverde',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'nombre_ruta' => 'Nombre ruta',
            'costo' => 'Costo',
            
        ],
    ],

    'rutasamarilla' => [
        'title' => 'Rutasamarillas',

        'actions' => [
            'index' => 'Rutasamarillas',
            'create' => 'New Rutasamarilla',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'nombre_ruta' => 'Nombre ruta',
            'costo' => 'Costo',
            
        ],
    ],

    'user' => [
        'title' => 'Users',

        'actions' => [
            'index' => 'Users',
            'create' => 'New User',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'email_verified_at' => 'Email verified at',
            'password' => 'Password',
            
        ],
    ],

    'usuario' => [
        'title' => 'Usuarios',

        'actions' => [
            'index' => 'Usuarios',
            'create' => 'New Usuario',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            
        ],
    ],

    'usuarioss' => [
        'title' => 'Usuarioss',

        'actions' => [
            'index' => 'Usuarioss',
            'create' => 'New Usuarioss',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'correo' => 'Correo',
            'telefono' => 'Telefono',
            'password' => 'Password',
            
        ],
    ],

    'rutasnaranja' => [
        'title' => 'Rutasnaranjas',

        'actions' => [
            'index' => 'Rutasnaranjas',
            'create' => 'New Rutasnaranja',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'nombre_ruta' => 'Nombre ruta',
            'costo' => 'Costo',
            
        ],
    ],

    'rutasnaranjass' => [
        'title' => 'Rutasnaranjass',

        'actions' => [
            'index' => 'Rutasnaranjass',
            'create' => 'New Rutasnaranjass',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'nombre_ruta' => 'Nombre ruta',
            'costo' => 'Costo',
            
        ],
    ],

    'rutasblanca' => [
        'title' => 'Rutasblancas',

        'actions' => [
            'index' => 'Rutasblancas',
            'create' => 'New Rutasblanca',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'nombre_ruta' => 'Nombre ruta',
            'costo' => 'Costo',
            
        ],
    ],

    // Do not delete me :) I'm used for auto-generation
];