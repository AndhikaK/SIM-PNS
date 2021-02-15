<?php

namespace App\Models;

use CodeIgniter\Model;

class SubbagModel extends Model
{
    protected $table = 'subbag';
    protected $allowedFields = ['id_subbag', 'nama_subbag'];

    public function getSubbag()
    {
        return $this->findAll();
    }
}
