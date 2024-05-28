<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Models\Employee;

class ImportData extends Component
{
    use WithFileUploads;

    public $file;
    public $fileName;

    public function updatedFile()
    {
        // SE DEREM UPLOAD AO FICHEIRO, O NOME DO MESMO É GUARDADO NA VARIAVÉL GLOBAL FILENAME

        if ($this->file) {
            $this->fileName = $this->file->getClientOriginalName();
        }
    }

    public function render()
    {
        return view('livewire.import-data');
    }

    public function save()
    {
        if ($this->file) {
            $extension = $this->file->getClientOriginalExtension();

            // VERIFICA SE O FICHEIRO É CSV

            if ($extension !== 'csv') {
                session()->flash('flash.banner', 'Por favor introduz um ficheiro CSV.');
                session()->flash('flash.bannerStyle', 'danger');
                $this->reset('file');
                return redirect()->route('import');
            }

            $path = $this->file->storeAs('uploads', $this->fileName);

            $file_handle = fopen(Storage::path($path), 'r');

            if ($file_handle !== FALSE) {
                // LIMPA TODOS OS DADOS ATUAIS DOS EMPREGADOS
                Employee::truncate();

                // GUARDA OS DADOS AO LER AS RESPETIVAS COLUNAS DO FICHEIRO, STATE É COLUNA 3, TEAM COLUNA 4 E ASSIM EM DIANTE
                $header = fgetcsv($file_handle);
                while (($line = fgetcsv($file_handle)) !== false) {
                    if (!empty(array_filter($line))) {
                        $employeeData = [
                            'employee_id' => $line[1],
                            'allocations' => $line[2],
                            'state' => $line[3],
                            'team' => $line[4],
                            'billing_company' => $line[5],
                            'role' => $line[6],
                            'skill' => $line[7],
                            'seniority' => $line[8],
                            'location' => $line[9],
                            'office' => $line[10],
                            'start_date' => $line[11],
                            'end_date' => $line[12],
                            'sphere' => $line[13],
                            'classification' => $line[14],
                            'billing_code' => $line[15],
                            'order' => $line[16],
                            'invoice_desc' => $line[17],
                            'value' => $line[18],
                            'currency' => $line[19],
                            'rate' => $line[20],
                            'discount' => $line[21],
                            'flagged' => $line[22],
                            'notes' => $line[23],
                            'email' => $line[24],
                        ];


                        Employee::create($employeeData);
                    }
                }
                fclose($file_handle);

                session()->flash('flash.banner', 'Ficheiro importado com sucesso.');
                session()->flash('flash.bannerStyle', 'success');
                return redirect()->route('import');
            } else {
                session()->flash('flash.banner', 'Erro ao importar ficheiro.');
                session()->flash('flash.bannerStyle', 'danger');
                return redirect()->route('import');
            }
        }
    }
}
