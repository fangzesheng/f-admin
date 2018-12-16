<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdminRolesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('admin_roles', function(Blueprint $table)
		{
			$table->increments('id')->comment('ID');
			$table->string('name')->unique('roles_name_unique')->comment('角色名');
			$table->string('display_name')->nullable()->comment('显示名');
			$table->string('description')->nullable()->comment('描述');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('admin_roles');
	}

}
