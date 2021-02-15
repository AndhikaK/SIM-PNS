<?php

namespace App\Models;

use CodeIgniter\Model;

class SatkerModel extends Model
{
    protected $table = 'satker';
    protected $allowedFields = ['id_satker', 'nama_satker'];

    public function getSatker()
    {
        return $this->findAll();
    }
}
