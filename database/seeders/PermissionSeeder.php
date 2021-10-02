<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'ver-post',
            'crear-post',
            'editar-post',
            'borrar-post',

            'ver-rol',
            'crear-rol',
            'editar-rol',
            'borrar-rol',

            'ver-user',
            'crear-user',
            'editar-user',
            'borrar-user',
        ];
        foreach($permissions as $permiso){
            Permission::create(['name'=>$permiso]);
        }
    }
}
