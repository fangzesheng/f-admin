<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdminUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('admin_users', function(Blueprint $table)
		{
			$table->increments('id')->comment('ID');
			$table->string('username')->unique('users_username_unique')->comment('用户名');
			$table->string('email')->unique('users_email_unique')->comment('邮件');
			$table->string('mobile', 11)->nullable()->comment('手机号码');
            $table->smallInteger('sex')->default(1)->comment('性别');
			$table->string('password', 60)->comment('密码');
			$table->string('remember_token', 100)->nullable()->comment('TOKEN');
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
		Schema::drop('admin_users');
	}

}
