<?php

namespace App\Http\Controllers;

use App\Models\BloodDonor;
use Illuminate\Http\Request;

class BloodDonorController extends Controller
{
    /**
     * Mostrar el formulario de registro de donantes
     */
    public function create()
    {
        return view('blood-donors.create');
    }

    /**
     * Almacenar un nuevo donante
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            // Datos del tutor
            'tutor_name' => 'required|string|max:255',
            'tutor_email' => 'required|email|max:255',
            'tutor_document' => 'required|string|max:20',
            'tutor_phone' => 'required|string|max:20',
            
            // Datos básicos del animal
            'animal_breed' => 'required|string|max:100',
            'animal_name' => 'required|string|max:100',
            'animal_species' => 'required|in:perro,gato,otro',
            'animal_species_other' => 'nullable|required_if:animal_species,otro|string|max:50',
            'health_status' => 'required|in:excelente,bueno,requiere_tratamiento',
            'health_status_detail' => 'nullable|required_if:health_status,requiere_tratamiento|string|max:500',
            'animal_age' => 'required|integer|min:1|max:30',
            'animal_weight' => 'required|numeric|min:0.1|max:100',
            'vaccinated' => 'required|boolean',
            'missing_vaccine' => 'nullable|required_if:vaccinated,false|string|max:255',
            'previous_donation' => 'required|boolean',
            'previous_donation_date' => 'nullable|required_if:previous_donation,true|date|before_or_equal:today',
            
            // Condiciones de salud
            'has_diagnosed_disease' => 'required|boolean',
            'diagnosed_disease_detail' => 'nullable|required_if:has_diagnosed_disease,true|string|max:1000',
            'under_treatment' => 'required|boolean',
            'treatment_detail' => 'nullable|required_if:under_treatment,true|string|max:1000',
            'recent_surgery' => 'required|boolean',
            'surgery_detail' => 'nullable|required_if:recent_surgery,true|string|max:1000',
            
            // Enfermedades específicas
            'diseases' => 'nullable|array',
            'diseases.*' => 'string|in:leishmaniasis,ehrlichiosis,parvovirus,anemia,hepatitis,cancer,otros',
            'other_diseases' => 'nullable|required_if:diseases.*,otros|string|max:500',
            
            // Foto
            'animal_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            // Crear el donante con estado 'pendiente' por defecto
            $donor = BloodDonor::create($validated);
            
            return redirect()->route('blood-donors.success')
                ->with('success', '¡Registro exitoso! Tu solicitud ha sido enviada y será revisada por nuestro equipo.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Ocurrió un error al procesar tu solicitud. Por favor, intenta nuevamente.'])
                ->withInput();
        }
    }

    /**
     * Mostrar página de éxito
     */
    public function success()
    {
        return view('blood-donors.success');
    }

    /**
     * Mostrar donantes aprobados (web pública) - SOLO LOS APROBADOS
     */
    public function index()
    {
        $donors = BloodDonor::approved()
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('blood-donors.index', compact('donors'));
    }

    /**
     * Mostrar detalle de un donante específico
     */
    public function show(BloodDonor $donor)
    {
        // Solo mostrar si está aprobado
        if (!$donor->isApproved()) {
            abort(404);
        }

        return view('blood-donors.show', compact('donor'));
    }
}