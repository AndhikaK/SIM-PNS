<?php

namespace App\Models;

use CodeIgniter\Model;

class JabatanModel extends Model
{
    protected $table = 'jabatan';
    protected $allowedFields = ['id_jabatan', 'nama_jabatan'];

    public function getJabatan()
    {
        return $this->findAll();
    }

    public function getTableCollumn()
    {
        $fields = $this->getFieldNames('pegawai');

        return $fields;
    }

    public function getRows()
    {
        return $this->affectedRows();
    }
}
