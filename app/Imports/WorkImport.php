<?php

namespace App\Imports;


use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\Work;
class WorkImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Work([
            'work_content' => $row[0],
            'date_book' => $row[1],
            'work_note' => $row[2],
            'name_cus' => $row[3],
            'street' => $row[4],
            'district' => $row[5],
            'phone_number' => $row[6],
            'kind_work' => $row[7],
            'status_work' => $row[8],
        ]);
    }
}
