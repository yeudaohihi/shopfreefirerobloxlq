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
    Schema::create('item_orders', function (Blueprint $table) {
      $table->id();
      $table->string('name')->nullable();
      $table->string('type')->default('item');
      $table->string('code')->unique();
      $table->json('data')->nullable();
      $table->double('payment', 20, 2)->default(0);
      $table->double('discount')->default(0);
      $table->string('status')->default('Pending');
      $table->string('input_user')->nullable();
      $table->string('input_pass')->nullable();
      $table->string('input_auth')->nullable();
      $table->json('input_ingame')->nullable();
      $table->string('admin_note')->nullable();
      $table->string('order_note')->nullable();
      $table->json('extra_data')->nullable();
      $table->string('user_id');
      $table->string('username');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('item_orders');
  }
};
