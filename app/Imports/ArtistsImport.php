<?php

namespace App\Imports;

use App\Models\Artist;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ArtistsImport implements ToModel ,WithHeadingRow ,WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Artist([
            'id'         => $row['id'],
            'firstname'  => $row['email'], 
            'lastname'   => $row['lastname'],
        ]);
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function rules(): array
    {
        return [
            'id' => 'required',
            'firstname' => 'required',
            'lastname' => 'required'
        ];
    }
}
