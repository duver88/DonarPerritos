<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class BloodDonor extends Model
{
    use HasFactory;

    protected $fillable = [
        'tutor_name',
        'tutor_email',
        'tutor_document',
        'tutor_phone',
        'animal_breed',
        'animal_name',
        'animal_species',
        'animal_species_other',
        'health_status',
        'health_status_detail',
        'animal_age',
        'animal_weight',
        'vaccinated',
        'missing_vaccine',
        'previous_donation',
        'previous_donation_date',
        'has_diagnosed_disease',
        'diagnosed_disease_detail',
        'under_treatment',
        'treatment_detail',
        'recent_surgery',
        'surgery_detail',
        'diseases',
        'other_diseases',
        'animal_photo',
        'status',
        'admin_notes',
        'reviewed_at',
        'reviewed_by',
    ];

    protected $casts = [
        'vaccinated' => 'boolean',
        'previous_donation' => 'boolean',
        'has_diagnosed_disease' => 'boolean',
        'under_treatment' => 'boolean',
        'recent_surgery' => 'boolean',
        'diseases' => 'array',
        'previous_donation_date' => 'date',
        'reviewed_at' => 'datetime',
    ];

    // Relaciones
    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    // Scopes
    public function scopeApproved($query)
    {
        return $query->where('status', 'aprobado');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pendiente');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rechazado');
    }

    // Accessors
    public function getAnimalPhotoUrlAttribute()
    {
        return $this->animal_photo ? Storage::url($this->animal_photo) : null;
    }

    public function getFormattedSpeciesAttribute()
    {
        if ($this->animal_species === 'otro') {
            return $this->animal_species_other;
        }
        return ucfirst($this->animal_species);
    }

    public function getFormattedHealthStatusAttribute()
    {
        $statuses = [
            'excelente' => 'Excelente',
            'bueno' => 'Bueno',
            'requiere_tratamiento' => 'Requiere tratamiento'
        ];
        
        $status = $statuses[$this->health_status] ?? $this->health_status;
        
        if ($this->health_status === 'requiere_tratamiento' && $this->health_status_detail) {
            $status .= ': ' . $this->health_status_detail;
        }
        
        return $status;
    }

    public function getFormattedDiseasesAttribute()
    {
        if (!$this->diseases) {
            return 'Ninguna';
        }
        
        $diseaseNames = [
            'leishmaniasis' => 'Leishmaniasis',
            'ehrlichiosis' => 'Ehrlichiosis',
            'parvovirus' => 'Parvovirus',
            'anemia' => 'Anemia',
            'hepatitis' => 'Hepatitis',
            'cancer' => 'Cáncer',
            'otros' => 'Otros'
        ];
        
        $formatted = [];
        foreach ($this->diseases as $disease) {
            $formatted[] = $diseaseNames[$disease] ?? $disease;
        }
        
        $result = implode(', ', $formatted);
        
        if (in_array('otros', $this->diseases) && $this->other_diseases) {
            $result .= ' (' . $this->other_diseases . ')';
        }
        
        return $result;
    }

    // Mutators
    public function setAnimalPhotoAttribute($value)
    {
        if ($value && $value instanceof \Illuminate\Http\UploadedFile) {
            $this->attributes['animal_photo'] = $value->store('animal-photos', 'public');
        } elseif (is_string($value)) {
            $this->attributes['animal_photo'] = $value;
        }
    }

    // Métodos auxiliares
    public function isPending()
    {
        return $this->status === 'pendiente';
    }

    public function isApproved()
    {
        return $this->status === 'aprobado';
    }

    public function isRejected()
    {
        return $this->status === 'rechazado';
    }

    public function approve($adminId, $notes = null)
    {
        $this->update([
            'status' => 'aprobado',
            'reviewed_by' => $adminId,
            'reviewed_at' => now(),
            'admin_notes' => $notes,
        ]);
    }

    public function reject($adminId, $notes = null)
    {
        $this->update([
            'status' => 'rechazado',
            'reviewed_by' => $adminId,
            'reviewed_at' => now(),
            'admin_notes' => $notes,
        ]);
    }
}