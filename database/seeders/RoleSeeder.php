<?php

namespace Database\Seeders;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       

        $admin = new Role;
        $admin->name = 'Admin menowatt';
        $admin->givePermissionTo(
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
        'borrar-user');
        $admin->save();

        $societyrole = new Role;
        $societyrole->name = 'Client Society';
        $societyrole->givePermissionTo( 
        'ver-post',
        'crear-post',
        'ver-user');
        $societyrole->save();

        $engineerole = new Role;
        $engineerole->name = 'Engineer';
        $engineerole->givePermissionTo( 
        'ver-post',
        'crear-post',
        'ver-user');
        $engineerole->save();

        $employeerole = new Role;
        $employeerole->name = 'Employee menowatt';
        $employeerole->givePermissionTo( 
        'ver-post',
        'crear-post',
        'ver-user');
        $employeerole->save();

    }
}
