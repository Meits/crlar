<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PagesTable::class);
        $this->call(CreateSettings::class);
        $this->call(CreateAdminUser::class);
        $this->call(CreatePermissions::class);
        $this->call(CreateRoles::class);
        $this->call(CreateEmailsTable::class);
        $this->call(CreatePermissionsRoles::class);
        $this->call(CreateRolesUsers::class);
    }
}
