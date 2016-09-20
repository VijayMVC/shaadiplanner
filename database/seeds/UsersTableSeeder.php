<?php

use Illuminate\Database\Seeder;
use App\User;
use Kodeine\Acl\Models\Eloquent\Permission;
use Kodeine\Acl\Models\Eloquent\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        $admin=User::create(array(
            'name'     => 'Luke Deaken',
            'email'    => 'dev@instantwebsitesolutions.co.uk',
            'password' => Hash::make('instant'),
        ));
        $admin->assignRole('administrator');

        $moderator=User::create(array(
            'name'     => 'Business',
            'email'    => 'business@instantwebsitesolutions.co.uk',
            'password' => Hash::make('instant'),
        ));
        $moderator->assignRole('business');

        $moderator=User::create(array(
            'name'     => 'Second Business',
            'email'    => 'business-2@instantwebsitesolutions.co.uk',
            'password' => Hash::make('instant'),
        ));
        $moderator->assignRole('business');
    }
}
