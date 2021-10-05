<?php

namespace Database\Seeders;

use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new User;
        $admin->name = 'Alessandro Benigni';
        $admin->email = 'alebeni02@gmail.com';
        $admin->password = bcrypt('gggggggg');
        $admin->assignRole('Admin menowatt');
        $admin->state = 'Sono l Admin';
        $admin->save();
    }
}
