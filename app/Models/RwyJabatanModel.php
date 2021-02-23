<?php

namespace App\Models;

use CodeIgniter\Model;

class RwyJabatanModel extends Model
{
    public function getRiwayat($nip)
    {
        $query = "SELECT *
        FROM riwayat_jabatan as q
        LEFT OUTER JOIN jabatan ON
            q.id_jabatan = jabatan.id_jabatan
        where 
            q.nip = '" . $nip . "'
        ORDER BY
            tahun DESC
        ";

        return $this->db->query($query)->getResultArray();
    }
}
