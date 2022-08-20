<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('assigned_to_id');
            $table->foreign('assigned_to_id')
                ->references('id')->on('users');
            $table->unsignedBigInteger('assigned_by_id');
            $table->foreign('assigned_by_id')
                ->references('id')->on('users');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tasks');
    }
};
