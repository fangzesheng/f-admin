<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdminPermissionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('admin_permissions', function(Blueprint $table)
		{
			$table->increments('id')->comment('ID');
			$table->string('name')->unique('permissions_name_unique')->comment('权限名 英文');
			$table->string('display_name')->nullable()->comment('显示名 中文');
			$table->string('description')->nullable()->comment('描述');
			$table->string('controllers', 512)->nullable()->comment('对应的controllers');
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
		Schema::drop('admin_permissions');
	}

}
