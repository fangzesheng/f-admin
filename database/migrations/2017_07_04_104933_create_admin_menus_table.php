<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdminMenusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('admin_menus', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('parent_id')->default(0)->comment('上级ID');
			$table->integer('order')->default(0)->comment('菜单排序');
			$table->string('title', 50)->nullable()->comment('标题');
			$table->string('icon', 50)->comment('图标');
			$table->string('uri', 50)->comment('URI');
			$table->string('routes', 256)->nullable()->comment('路由,如url:/menu,controller:MenuController');
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
		Schema::drop('admin_menus');
	}

}
