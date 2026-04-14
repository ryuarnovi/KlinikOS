<?php

namespace App\Livewire\Dokter;

use Livewire\Component;
use App\Models\MedicalRecord;
use App\Models\Patient;

class EmrCrud extends Component
{
    public $records;
    public $patient_id, $subjective, $objective, $assessment, $plan, $icd10;

    public function mount()
    {
        if (!auth()->user() || !auth()->user()->hasRole('dokter')) {
            abort(403, 'Unauthorized');
        }
        $this->getRecords();
    }

    public function getRecords()
    {
        $this->records = MedicalRecord::where('doctor_id', auth()->id())->with('patient')->get();
    }

    public function saveEMR()
    {
        MedicalRecord::create([
            'clinic_id' => auth()->user()->clinic_id,
            'patient_id' => $this->patient_id,
            'doctor_id' => auth()->id(),
            'subjective' => $this->subjective,
            'objective' => $this->objective,
            'assessment' => $this->assessment,
            'plan' => $this->plan,
            'icd10_code' => $this->icd10,
        ]);
        $this->reset(['patient_id', 'subjective', 'objective', 'assessment', 'plan', 'icd10']);
        $this->getRecords();
    }

    public function render()
    {
        return view('livewire.dokter.emr-crud');
    }
}
