<?php

namespace App\Http\Controllers;

use App\Models\MedicalHistory;
use Illuminate\Http\Request;
use App\Models\{
    Patient,
    Employee,
    Person
};

class MedicalHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener estadísticas de manera más eficiente
        $stats = [
            'serviceCount' => MedicalHistory::count(),
            'activeServices' => MedicalHistory::where('status', 'active')->count(),
            'todayServices' => MedicalHistory::whereDate('created_at', today())->count()
        ];
        $patients = Patient::with('person')->get()->map(function($patient) {
            return [
                'id' => $patient->id,
                'full_name' => $patient->person->name_1 . ' ' . $patient->person->surname_1
            ];
        });
        $doctors = Employee::where('employee_type', 'Doctor')
        ->with(['person', 'speciality'])
        ->get()
        ->map(function($doctor) {
            return [
                'id' => $doctor->id,
                'full_name' => $doctor->person->name_1 . ' ' . $doctor->person->surname_1,
                'speciality' => $doctor->speciality->name ?? 'Sin especialidad'
            ];
        });
        // Cargar relaciones necesarias con paginación
        $services = MedicalHistory::with([
            'patient.person',
            'doctor.person'
        ])->latest()->paginate(10);

        return view('service.history.index', compact('stats', 'services', 'patients', 'doctors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Obtener pacientes y doctores de manera más eficiente
        $patients = Patient::with('person')
            ->get()
            ->map(function($patient) {
                return [
                    'id' => $patient->id,
                    'full_name' => $patient->person->full_name ?? 'N/A'
                ];
            });

        $doctors = Employee::with('person')
            ->whereHas('person', function($query) {
                $query->where('is_employee', true);
            })
            ->get()
            ->map(function($doctor) {
                return [
                    'id' => $doctor->id,
                    'full_name' => $doctor->person->full_name ?? 'N/A'
                ];
            });

        return view('service.history.create', compact('patients', 'doctors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'nullable|exists:employees,id',
            'date' => 'required|date',
            'diagnosis' => 'nullable|string',
            'treatment' => 'nullable|string',
            'status' => 'required|in:active,inactive,suspended',
        ]);

        MedicalHistory::create($validated);

        return redirect()->route('history')->with('success', 'Historial médico creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(MedicalHistory $medicalHistory)
    {
        // Cargar relaciones necesarias para la vista
        $medicalHistory->load(['patient.person', 'doctor.person']);
        
        return view('service.history.show', compact('medicalHistory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MedicalHistory $medicalHistory)
    {
        // Obtener pacientes y doctores de manera eficiente
        $patients = Patient::with('person')
            ->get()
            ->map(function($patient) {
                return [
                    'id' => $patient->id,
                    'full_name' => $patient->person->full_name ?? 'N/A'
                ];
            });

        $doctors = Employee::with('person')
            ->whereHas('person', function($query) {
                $query->where('is_employee', true);
            })
            ->get()
            ->map(function($doctor) {
                return [
                    'id' => $doctor->id,
                    'full_name' => $doctor->person->full_name ?? 'N/A'
                ];
            });

        return view('service.history.edit', compact('medicalHistory', 'patients', 'doctors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MedicalHistory $medicalHistory)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'nullable|exists:employees,id',
            'date' => 'required|date',
            'diagnosis' => 'nullable|string',
            'treatment' => 'nullable|string',
            'status' => 'required|in:active,inactive,suspended',
        ]);

        $medicalHistory->update($validated);

        return redirect()->route('history')->with('success', 'Historial médico actualizado correctamente.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MedicalHistory $medicalHistory)
    {
        $medicalHistory->delete();

        return redirect()->route('history')->with('success', 'Historial médico eliminado correctamente.');
    }
}
