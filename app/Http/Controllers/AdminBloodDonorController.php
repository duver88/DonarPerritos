<?php

namespace App\Http\Controllers;

use App\Models\BloodDonor;
use Illuminate\Http\Request;

class AdminBloodDonorController extends Controller
{
    /**
     * Panel de administración - AQUÍ VE TODAS LAS SOLICITUDES
     */
    public function index(Request $request)
    {
        $query = BloodDonor::query();
        
        // Filtros
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('tutor_name', 'like', "%{$search}%")
                  ->orWhere('animal_name', 'like', "%{$search}%")
                  ->orWhere('tutor_email', 'like', "%{$search}%");
            });
        }
        
        $donors = $query->orderBy('created_at', 'desc')->paginate(15);
        
        // Estadísticas
        $stats = [
            'total' => BloodDonor::count(),
            'pending' => BloodDonor::pending()->count(),
            'approved' => BloodDonor::approved()->count(),
            'rejected' => BloodDonor::rejected()->count(),
        ];
        
        return view('admin.blood-donors.index', compact('donors', 'stats'));
    }

    /**
     * Ver detalle de un donante
     */
    public function show(BloodDonor $donor)
    {
        return view('admin.blood-donors.show', compact('donor'));
    }

    /**
     * Aprobar un donante - AQUÍ APRUEBA PARA QUE SE VEA EN LA WEB PÚBLICA
     */
    public function approve(BloodDonor $donor, Request $request)
    {
        $request->validate([
            'admin_notes' => 'nullable|string|max:1000',
        ]);

        $donor->approve(auth()->id(), $request->admin_notes);

        return redirect()->route('admin.blood-donors.index')
            ->with('success', 'Donante aprobado exitosamente. Ahora aparecerá en la web pública.');
    }

    /**
     * Rechazar un donante - AQUÍ RECHAZA PARA QUE NO SE VEA
     */
    public function reject(BloodDonor $donor, Request $request)
    {
        $request->validate([
            'admin_notes' => 'required|string|max:1000',
        ]);

        $donor->reject(auth()->id(), $request->admin_notes);

        return redirect()->route('admin.blood-donors.index')
            ->with('success', 'Donante rechazado. No aparecerá en la web pública.');
    }

    /**
     * Cambiar estado de un donante (para correcciones)
     */
    public function changeStatus(BloodDonor $donor, Request $request)
    {
        $request->validate([
            'new_status' => 'required|in:pendiente,aprobado,rechazado',
            'admin_notes' => 'nullable|string|max:1000',
        ]);

        $oldStatus = $donor->status;
        $newStatus = $request->new_status;
        
        // Actualizar el estado
        $donor->update([
            'status' => $newStatus,
            'reviewed_by' => auth()->id(),
            'reviewed_at' => now(),
            'admin_notes' => $request->admin_notes ?: "Estado cambiado de '{$oldStatus}' a '{$newStatus}' por corrección.",
        ]);

        $statusNames = [
            'pendiente' => 'Pendiente',
            'aprobado' => 'Aprobado',
            'rechazado' => 'Rechazado'
        ];

        return redirect()->route('admin.blood-donors.index')
            ->with('success', "Estado cambiado de '{$statusNames[$oldStatus]}' a '{$statusNames[$newStatus]}' exitosamente.");
    }

    /**
     * Cambiar estado de múltiples donantes
     */
    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:approve,reject',
            'donors' => 'required|array',
            'donors.*' => 'exists:blood_donors,id',
            'bulk_notes' => 'nullable|string|max:1000',
        ]);

        $donors = BloodDonor::whereIn('id', $request->donors)->get();

        foreach ($donors as $donor) {
            if ($request->action === 'approve') {
                $donor->approve(auth()->id(), $request->bulk_notes);
            } else {
                $donor->reject(auth()->id(), $request->bulk_notes);
            }
        }

        $message = $request->action === 'approve' ? 'Donantes aprobados' : 'Donantes rechazados';
        return redirect()->back()->with('success', $message . ' exitosamente.');
    }
}