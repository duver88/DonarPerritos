<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('blood_donors', function (Blueprint $table) {
            $table->id();
            
            // Datos del Tutor Responsable
            $table->string('tutor_name');
            $table->string('tutor_email');
            $table->string('tutor_document');
            $table->string('tutor_phone');
            
            // Datos del Animal
            $table->string('animal_breed');
            $table->string('animal_name');
            $table->enum('animal_species', ['perro', 'gato', 'otro']);
            $table->string('animal_species_other')->nullable();
            $table->enum('health_status', ['excelente', 'bueno', 'requiere_tratamiento']);
            $table->string('health_status_detail')->nullable();
            $table->integer('animal_age');
            $table->decimal('animal_weight', 5, 2);
            $table->boolean('vaccinated');
            $table->string('missing_vaccine')->nullable();
            $table->boolean('previous_donation');
            $table->date('previous_donation_date')->nullable();
            
            // Condiciones de Salud
            $table->boolean('has_diagnosed_disease');
            $table->text('diagnosed_disease_detail')->nullable();
            $table->boolean('under_treatment');
            $table->text('treatment_detail')->nullable();
            $table->boolean('recent_surgery');
            $table->text('surgery_detail')->nullable();
            
            // Enfermedades específicas
            $table->json('diseases')->nullable(); // Para almacenar array de enfermedades
            $table->text('other_diseases')->nullable();
            
            // Foto del animal
            $table->string('animal_photo')->nullable();
            
            // Estado de aprobación
            $table->enum('status', ['pendiente', 'aprobado', 'rechazado'])->default('pendiente');
            $table->text('admin_notes')->nullable();
            $table->timestamp('reviewed_at')->nullable();
            $table->unsignedBigInteger('reviewed_by')->nullable();
            
            $table->timestamps();
            
            // Índices
            $table->index(['status', 'created_at']);
            $table->index('tutor_email');
            $table->foreign('reviewed_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blood_donors');
    }
};