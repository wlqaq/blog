<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogallTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogall', function (Blueprint $table) {
            $table->string('name',100)->default('niee');
            $table->string('email',50)->default('1032902096@qq.com');
            $table->string('wechat',100)->default('w18319537819');
            $table->string('qq',11)->default('1032902096');
            $table->string('title')->default('niee博客后台');
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
        Schema::dropIfExists('blogall');
    }
}
