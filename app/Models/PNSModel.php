<?php

namespace App\Models;

use CodeIgniter\Model;

class PNSModel extends Model
{
    protected $table = 'pegawai';
    protected $allowedFields = ['nip', 'nik', 'nama_pegawai', 'ttl', 'tempat_lahir', 'pangkat_gol', 'jabatan', 'alamat', 'id_satker', 'id_bagian', 'id_subbag', 'jenis_kelamin', 'agama'];

    public function getPegawai()
    {
        // $db = \Config\Database::connect();
        $builder = $this->db->table($this->table)
            ->join('satker', 'satker.id_satker = pegawai.id_satker')
            ->join('bagian', 'bagian.id_bagian = pegawai.id_bagian')
            ->join('subbag', 'subbag.id_subbag = pegawai.id_subbag');

        return $builder->get()->getResultArray();
    }
}
