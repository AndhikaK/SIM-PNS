<?php

namespace App\Models;

use CodeIgniter\Model;

class BagianModel extends Model
{
    protected $table = 'bagian';
    protected $allowedFields = ['id_bagian', 'nama_bagian'];

    public function getBagian()
    {
        return $this->findAll();
    }
}
