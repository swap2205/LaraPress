<?php

use Illuminate\Database\Seeder;
use Modules\Admin\Entities\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new Admin();
		$admin->name = 'Super Admin';
		$admin->email = 'admin@larapress.com';
		$admin->password = bcrypt('admin123');
		$admin->save();
    }
}
