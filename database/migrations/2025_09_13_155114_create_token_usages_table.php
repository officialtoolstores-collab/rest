<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('token_usages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('action');               // що саме викликали (e.g., "content.generate")
            $table->unsignedInteger('tokens');      // скільки списали
            $table->json('meta')->nullable();       // довільні деталі
            $table->timestamps();
            $table->index(['user_id', 'created_at']);
        });
    }
    public function down(): void {
        Schema::dropIfExists('token_usages');
    }
};
