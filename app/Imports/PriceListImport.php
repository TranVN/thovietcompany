<?php

namespace App\Imports;


use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\PriceList;
class PriceListImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new PriceList([
            'ID_price_list' => $row[0],
            'name_price_list' => $row[1],
            'info_price' => $row[2],
            'price' => $row[3],
            'image_price' => $row[4],
            'note_price' => $row[5],
            
        ]);
    }
}
