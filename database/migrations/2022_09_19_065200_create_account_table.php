<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('account_number');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('password');
            $table->string('birthday');
            $table->string('gender');
            $table->string('phone');
            $table->string('locale');
            $table->enum('role', ['ADMIN', 'SUPER_ADMIN', 'USER', 'STORE_OWNER', 'EMPLOYEE_STOCK', 'EMPLOYEE_ORDER'])->nullable();
            $table->string('role_id')->nullable();
            $table->boolean('keep_logging')->default('1');
            $table->timestamp('last_login_at')->nullable();
            $table->text('password_forgotten_token')->nullable();
            $table->text('password_forgotten_token_limit')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
};
