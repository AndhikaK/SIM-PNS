<?php

namespace App\Models;

use CodeIgniter\Model;

class RwyPenempatanModel extends Model
{
    public function getRiwayat($nip)
    {
        $query = "SELECT *
        FROM riwayat_penempatan as q
        LEFT OUTER JOIN satker ON
                    q.id_satker = satker.id_satker
                LEFT OUTER JOIN bagian ON
                    q.id_bagian = bagian.id_bagian
                LEFT OUTER JOIN subbag ON
                    q.id_subbag = subbag.id_subbag
        where 
            q.nip = '" . $nip . "'
        ORDER BY
            tanggal_mulai DESC
        ";

        return $this->db->query($query)->getResultArray();
    }
}
