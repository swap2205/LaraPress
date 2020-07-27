<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminNavigationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_navigations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('uri');
            $table->string('icon_class');
            $table->bigInteger('parent_id')->default(0);
            $table->bigInteger('nav_order')->default(0);
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('admin_navigation');
    }
}
