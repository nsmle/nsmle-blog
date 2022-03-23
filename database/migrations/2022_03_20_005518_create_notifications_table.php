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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('trigger_user_id');
            $table->bigInteger('entity_id');
            $table->string('entity_type', 50);
            $table->bigInteger('entity_event_id');
            $table->string('entity_event_type', 50);
            //$table->text('url');
            //$table->text('content');
            $table->boolean('read')->default(false);
            $table->boolean('trash')->default(false);
            $table->timestamp('read_at')->nullable();
            $table->timestamp('trash_at')->nullable();
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
        Schema::dropIfExists('notifications');
    }
};
