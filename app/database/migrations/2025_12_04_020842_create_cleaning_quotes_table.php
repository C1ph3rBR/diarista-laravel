<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cleaning_quotes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');

            $table->string('property_type');
            $table->unsignedInteger('rooms');
            $table->unsignedInteger('bathrooms');
            $table->boolean('has_pets')->default(false);
            $table->date('service_date');
            $table->string('frequency');
            $table->text('details')->nullable();

            $table->string('status')->default('novo');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cleaning_quotes');
    }
};
