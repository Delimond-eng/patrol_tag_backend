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
        Schema::create('patrols', function (Blueprint $table) {
            $table->id();
            $table->timestamp("started_at")->nullable()->comment("datetime of patrol MM-DD-AAAA HH:MM");
            $table->timestamp("ended_at")->nullable()->comment("datetime of patrol MM-DD-AAAA HH:MM");
            $table->string("comment_text")->nullable();
            $table->string("comment_audio")->nullable();
            $table->unsignedBigInteger("site_id");
            $table->unsignedBigInteger("agent_id");
            $table->unsignedBigInteger("agency_id");
            $table->string("status")->default("actif");
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
        Schema::dropIfExists('patrols');
    }
};