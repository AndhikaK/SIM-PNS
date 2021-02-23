<?php

namespace App\Models;

use CodeIgniter\Model;

class RwyGolonganModel extends Model
{
    public function getRiwayat($nip)
    {
        $query = "SELECT *
        FROM riwayat_golongan as q
        LEFT OUTER JOIN golongan_pangkat ON
                    q.id_golongan = golongan_pangkat.id_golongan
        where 
            q.nip = '" . $nip . "'
        ORDER BY
            tahun DESC
        ";

        return $this->db->query($query)->getResultArray();
    }
}
