<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Models\Employee;

class ViewData extends Component
{
    public $employees;
    public $teams;
    public $selectedTeam;

    public function mount($employees, $teams)
    {
        $this->employees = $employees ?? [];
        $this->teams = $teams;
    }

    public function filterEmployees($selectedTeam)
    {
        $this->selectedTeam = $selectedTeam;
    }

    public function clearFilter()
    {
        $this->selectedTeam = [];
    }

    public function render()
    {
        $filteredEmployees = $this->selectedTeam ?
            $this->employees->where('team', $this->selectedTeam) :
            $this->employees;

        return view('livewire.view-data', ['filteredEmployees' => $filteredEmployees]);
    }
}
