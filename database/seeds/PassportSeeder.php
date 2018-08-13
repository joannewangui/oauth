<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class PassportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('oauth_clients')->insert([
        	'name' => "Laravel Personal Access Client",
            'secret' => "64Pw8fgUQXv9gfiv10dlc93HAzfbyaUC7EfMFu25",
            'redirect' => 'http://localhost',
            'personal_access_client'=>1,
            'password_client'=>0,
            'revoked'=>0
        ]);


        DB::table('oauth_clients')->insert([
            'name' => 'Laravel Password Grant Client',
            'secret' => 'FabZtqrhgz4eb2tEuGa84M2MrPbIfzYu08IX5GAB',
            'redirect' => 'http://localhost',
            'personal_access_client' => 0,
            'password_client' => 1,
            'revoked' =>0
        ]);


    }
}
