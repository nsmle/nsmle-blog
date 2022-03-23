<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostReadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
        Schema::create('post_reads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('post_id')->nullable();
            $table->timestamps();
        });
        */
        
        Schema::create('post_reads', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('post_id');
            $table->foreignId('user_id')->nullable();
            $table->string('read_type');
            $table->ipAddress('ip_address');
            $table->string('user_agent');
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
        Schema::dropIfExists('post_reads');
    }
}
