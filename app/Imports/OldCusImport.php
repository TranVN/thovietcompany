<?php

namespace App\Imports;


use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\OldCustu;
class OldCusImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new OldCustu([
            'work_content' => $row[0],
            'date_book' => $row[1],
            'warranty_period' => $row[2],
            'name_cus' => $row[3],
            'add_cus' => $row[4],
            'des_cus' => $row[5],
            'phone_cus' => $row[6],
            'note_cus' => $row[7],
            'worker_name' => $row[8],
            'spending_total' => $row[9],
            'income_total' => $row[10],
            'seri_number' => $row[11],
            'cus_show' => $row[12],
        ]);
    }
}
