<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('g_b_orders', function (Blueprint $table) {
      $table->id();
      $table->string('code');
      $table->string('name');
      $table->string('input_user');
      $table->string('input_pass');
      $table->string('input_extra', 500);
      $table->double('payment');
      $table->integer('user_id');
      $table->string('username');
      $table->string('status')->default('Pending');
      $table->integer('package_id');
      $table->integer('group_id');
      $table->string('order_note')->nullable();
      $table->string('admin_note')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('g_b_orders');
  }
};