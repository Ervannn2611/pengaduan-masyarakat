<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('description');
            $table->enum('type', ['KEJAHATAN', 'PEMBANGUNAN', 'SOSIAL']);
            $table->string('province');
            $table->string('regency');
            $table->string('subdistrict');
            $table->string('village');
            $table->json('voting')->nullable(); // Hapus default
            $table->integer('viewers')->default(0);
            $table->string('image')->nullable();
            $table->boolean('statement')->default(false);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down()
{
    {
        Schema::dropIfExists('reports');
    }

}
};
