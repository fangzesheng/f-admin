<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdminRoleMenuTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('admin_role_menu', function(Blueprint $table)
		{
			$table->integer('role_id');
			$table->integer('menu_id');
			$table->index(['role_id','menu_id'], 'role_menu_role_id_menu_id_index');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('admin_role_menu');
	}

}
