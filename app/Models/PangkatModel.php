<?php

namespace App\Models;

use CodeIgniter\Model;

class PangkatModel extends Model
{
    protected $table = 'golongan';
    protected $allowedFields = ['id_golongan', 'nama_pangkat', 'golongan', 'ruang'];

    public function getPangkat()
    {
        return $this->findAll();
    }
}
