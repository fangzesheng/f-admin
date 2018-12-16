<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdminPermissionMenuTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('admin_permission_menu', function(Blueprint $table)
		{
			$table->integer('permission_id');
			$table->integer('menu_id');
			$table->index(['permission_id','menu_id'], 'permission_menu_permission_id_menu_id_index');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('admin_permission_menu');
	}

}
