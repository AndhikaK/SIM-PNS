<?php

namespace App\Models;

use CodeIgniter\Model;

class PoldaModel extends Model
{
    public function getTableCollumn($table)
    {
        return $this->getFieldNames($table);
    }

    public function getAllData($table)
    {
        $builder = $this->db->table($table)->get()->getResultArray();

        return $builder;
    }

    public function insertDataArray($table, $data)
    {
        $builder = $this->db->table($table);
        $builder->insert($data);

        return $this->affectedRows();
    }

    public function deleteData($id, $field, $table)
    {
        $builder = $this->db->table($table);
        $builder->where($field, $id);
        $builder->delete();
        return $this->affectedRows();
    }

    public function lihatDetailPegawai($nip)
    {
        $query = "SELECT 
            p.*, satker.nama_satker, bagian.nama_bagian, subbag.nama_subbag, q.*
            FROM 
                    pegawai p
                LEFT OUTER JOIN (
                    SELECT t1.* 
                    FROM riwayat_penempatan t1
                    WHERE t1.tanggal_mulai = (
                        SELECT tanggal_mulai FROM riwayat_penempatan
                         WHERE nip = t1.nip
                         ORDER BY tanggal_mulai DESC
                         LIMIT 1
                    )
                ) as q 
                    on q.nip = p.nip
                LEFT OUTER JOIN (
                    SELECT t2.*
                    FROM riwayat_jabatan t2
                    WHERE t2.tahun = (
                        SELECT tahun from riwayat_jabatan
                        WHERE nip = t2.nip
                        ORDER by tahun DESC
                        LIMIT 1
                    )
                ) as r
                    ON r.nip = p.nip
                LEFT OUTER JOIN (
                    SELECT t3.*
                    FROM riwayat_golongan t3
                    WHERE t3.tahun = (
                        SELECT tahun from riwayat_golongan
                        WHERE nip = t3.nip
                        ORDER by tahun DESC
                        LIMIT 1
                    )
                ) as s
                    ON s.nip = p.nip
                LEFT OUTER JOIN satker ON
                    q.id_satker = satker.id_satker
                LEFT OUTER JOIN bagian ON
                    q.id_bagian = bagian.id_bagian
                LEFT OUTER JOIN subbag ON
                    q.id_subbag = subbag.id_subbag
                LEFT OUTER JOIN jabatan ON
                    r.id_jabatan = jabatan.id_jabatan
                LEFT OUTER JOIN golongan_pangkat ON
                    s.id_golongan = golongan_pangkat.id_golongan
        WHERE
            p.nip = '$nip'
        ";

        return $this->db->query($query)->getResultArray();
    }

    public function getDataFromKey($columns)
    {
        $selectClause = '';
        foreach ($columns as $c) {
            $selectClause .= $c;
            $selectClause .= ',';
        }

        $selectClause = substr_replace($selectClause, '', -1);

        $query = "
            SELECT 
            " . $selectClause . "
                FROM 
                    pegawai p
                LEFT OUTER JOIN (
                    SELECT t1.* 
                    FROM riwayat_penempatan t1
                    WHERE t1.tanggal_mulai = (
                        SELECT tanggal_mulai FROM riwayat_penempatan
                         WHERE nip = t1.nip
                         ORDER BY tanggal_mulai DESC
                         LIMIT 1
                    )
                ) as q 
                    on q.nip = p.nip
                LEFT OUTER JOIN (
                    SELECT t2.*
                    FROM riwayat_jabatan t2
                    WHERE t2.tahun = (
                        SELECT tahun from riwayat_jabatan
                        WHERE nip = t2.nip
                        ORDER by tahun DESC
                        LIMIT 1
                    )
                ) as r
                    ON r.nip = p.nip
                LEFT OUTER JOIN (
                    SELECT t3.*
                    FROM riwayat_golongan t3
                    WHERE t3.tahun = (
                        SELECT tahun from riwayat_golongan
                        WHERE nip = t3.nip
                        ORDER by tahun DESC
                        LIMIT 1
                    )
                ) as s
                    ON s.nip = p.nip
                LEFT OUTER JOIN satker ON
                    q.id_satker = satker.id_satker
                LEFT OUTER JOIN bagian ON
                    q.id_bagian = bagian.id_bagian
                LEFT OUTER JOIN subbag ON
                    q.id_subbag = subbag.id_subbag
                LEFT OUTER JOIN jabatan ON
                    r.id_jabatan = jabatan.id_jabatan
                LEFT OUTER JOIN golongan_pangkat ON
                    s.id_golongan = golongan_pangkat.id_golongan
        ";

        return $this->db->query($query)->getResultArray();
    }

    public function searchData($keyword, $columns, $filterItem)
    {
        $likeClause = '';
        $selectClause = '';
        $filterClause = '';
        if ($keyword != '') {
            foreach ($columns as $c) {
                $likeItem = $c . " LIKE '%" . $keyword . "%'";
                $likeClause .= $likeItem;
                $likeClause .= ' or ';
            }
        }

        foreach ($columns as $c) {
            $selectClause .= $c;
            $selectClause .= ',';
        }

        $field = '';
        foreach ($filterItem as $name => $value) {
            $filter = '';
            if ($field == '') {
                $filter = '';
            } else {
                $filter = $field == $value ? " or " : " and ";
            }
            $filter .= $value . " = '" . $name . "'";
            $filter = str_replace("@", ".", $filter);
            $filterClause .= $filter;

            $field = $value;
        }

        d($filterClause);

        // $field = '';
        // foreach ($filterItem as $name => $value) {
        //     $filter = $value . " = '" . $name . "'";
        //     $filter .= $field == $value ? " or " : " and ";
        //     $filter = str_replace("@", ".", $filter);
        //     $filterClause .= $filter;
        //     $field = $value;
        // }


        // $filterClause = substr_replace($filterClause, '', -3);
        $likeClause = substr_replace($likeClause, '', -3);
        $selectClause = substr_replace($selectClause, '', -1);


        $query = "
            SELECT 
            " . $selectClause . "
                FROM 
                    pegawai p
                LEFT OUTER JOIN (
                    SELECT t1.* 
                    FROM riwayat_penempatan t1
                    WHERE t1.tanggal_mulai = (
                        SELECT tanggal_mulai FROM riwayat_penempatan
                         WHERE nip = t1.nip
                         ORDER BY tanggal_mulai DESC
                         LIMIT 1
                    )
                ) as q 
                    on q.nip = p.nip
                LEFT OUTER JOIN (
                    SELECT t2.*
                    FROM riwayat_jabatan t2
                    WHERE t2.tahun = (
                        SELECT tahun from riwayat_jabatan
                        WHERE nip = t2.nip
                        ORDER by tahun DESC
                        LIMIT 1
                    )
                ) as r
                    ON r.nip = p.nip
                LEFT OUTER JOIN (
                    SELECT t3.*
                    FROM riwayat_golongan t3
                    WHERE t3.tahun = (
                        SELECT tahun from riwayat_golongan
                        WHERE nip = t3.nip
                        ORDER by tahun DESC
                        LIMIT 1
                    )
                ) as s
                    ON s.nip = p.nip
                LEFT OUTER JOIN satker ON
                    q.id_satker = satker.id_satker
                LEFT OUTER JOIN bagian ON
                    q.id_bagian = bagian.id_bagian
                LEFT OUTER JOIN subbag ON
                    q.id_subbag = subbag.id_subbag
                LEFT OUTER JOIN jabatan ON
                    r.id_jabatan = jabatan.id_jabatan
                LEFT OUTER JOIN golongan_pangkat ON
                    s.id_golongan = golongan_pangkat.id_golongan
";
        if ($keyword != "" || !empty($filterItem)) {
            $query .= " WHERE ";

            if (!empty($filterItem)) {
                $query .= $filterClause;
                if ($keyword != "") {
                    $query .= " and ";
                }
            }

            if ($keyword != "") {
                $query .= "(" . $likeClause . ")";
            }
        }

        d($query);

        return $this->db->query($query)->getResultArray();
    }
}
