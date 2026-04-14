<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\StaffSchedule;

class StaffScheduleCrud extends Component
{
    public $schedules;
    public $user_id, $date, $shift, $start_time, $end_time, $scheduleId;
    public $users;

    public function mount()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }
        $this->getSchedules();
        $this->users = User::where('role', '!=', 'admin')->get();
    }

    public function getSchedules()
    {
        $this->schedules = StaffSchedule::with('user')->get();
    }

    public function createSchedule()
    {
        StaffSchedule::create([
            'clinic_id' => Auth::user()->clinic_id,
            'user_id' => $this->user_id,
            'date' => $this->date,
            'shift' => $this->shift,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
        ]);
        $this->reset(['user_id', 'date', 'shift', 'start_time', 'end_time']);
        $this->getSchedules();
    }

    public function editSchedule($id)
    {
        $schedule = StaffSchedule::findOrFail($id);
        $this->scheduleId = $schedule->id;
        $this->user_id = $schedule->user_id;
        $this->date = $schedule->date;
        $this->shift = $schedule->shift;
        $this->start_time = $schedule->start_time;
        $this->end_time = $schedule->end_time;
    }

    public function updateSchedule()
    {
        if ($this->scheduleId) {
            $schedule = StaffSchedule::find($this->scheduleId);
            $schedule->update([
                'user_id' => $this->user_id,
                'date' => $this->date,
                'shift' => $this->shift,
                'start_time' => $this->start_time,
                'end_time' => $this->end_time,
            ]);
            $this->reset(['scheduleId', 'user_id', 'date', 'shift', 'start_time', 'end_time']);
            $this->getSchedules();
        }
    }

    public function deleteSchedule($id)
    {
        StaffSchedule::destroy($id);
        $this->getSchedules();
    }

    public function render()
    {
        return view('livewire.admin.staff-schedule-crud');
    }
}
