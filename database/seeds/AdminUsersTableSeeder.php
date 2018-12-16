<?php

use Illuminate\Database\Seeder;

class AdminUsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('admin_users')->delete();
        \DB::table('admin_users')->insert(array (
            0 => 
		        array (
                    'id'		        =>	1,
	                'username'	        =>	'admin',
	                'email'		        =>	'admin@admin.com',
		            'mobile'	        =>	'18888888888',
		            'sex'	            =>	1,
		            'password'	        =>	'$2y$10$0nZ2IJJQzkuwTUvmsxVCYOAFw09sGceAk5b9p.AQ.h7I0YEj975rO', //f123456
		            'remember_token'    =>	'',
		            'created_at'	    =>	date('Y-m-d H:i:s',time()),
		            'updated_at'	    =>	date('Y-m-d H:i:s',time()),
		        ),
	        )
	    );
    }
}
