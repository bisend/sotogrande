<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	
   		// $sql = file_get_contents(database_path('seeds/booksi_sql.sql'));
		// DB::unprepared($sql);
        // $this->command->info('Demo table seeded!');
        // DB::table('users')->insert(
        //     [
        //         'role_id' => 1,
        //         'username' => 'admin1',
        //         'email' => 'admin@admin.com',
        //         'is_active' => 1,
        //         'password' => bcrypt('admin')
        //     ]
        // );
        $this->call(CategoriesSeeder::class);
        $this->call(CountriesSeeder::class);
        $this->call(LocationsSeeder::class);
        $this->call(PropertiesSeeder::class);
    }
}
