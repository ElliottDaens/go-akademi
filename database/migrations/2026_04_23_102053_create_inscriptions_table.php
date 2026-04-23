<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inscriptions', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('email');
            $table->string('telephone')->nullable();
            $table->date('date_naissance')->nullable();
            $table->enum('discipline', ['jjb', 'kosen_judo', 'luta_livre', 'indifferent'])->default('indifferent');
            $table->enum('niveau', ['debutant', 'intermediaire', 'avance'])->default('debutant');
            $table->text('message')->nullable();
            $table->boolean('accord_reglement')->default(false);
            $table->boolean('traitee')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inscriptions');
    }
};
