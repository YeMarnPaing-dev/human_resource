<?php

namespace App\Exports;

use App\Models\User; // You missed this import
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class UsersExport implements FromView, ShouldAutoSize
{
    use Exportable;

    private $users;

    public function __construct($users)
    {
        $this->users =$users; // Corrected assignment
    }

    public function view(): \Illuminate\Contracts\View\View
    {
        return view('employee.excel', [
            'employees' => $this->users
        ]);
    }


}
