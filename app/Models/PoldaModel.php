<?php

namespace App\Models;

use CodeIgniter\Model;

class PoldaModel extends Model
{
    public function getTableCollumn($table)
    {
        return $this->getFieldNames($table);
    }

    public function getTableData($table)
    {
        return $this->db->table($table)
            ->get()->getResultArray();
    }

    public function insertData($table, $data)
    {
        $builder = $this->db->table($table);
        $builder->insert($data);
        return $this->affectedRows();
    }

    public function insertPegawai()
    {
    }

    public function deleteData($id, $field, $table)
    {
        $builder = $this->db->table($table);
        $builder->where($field, $id);
        $builder->delete();
        return $this->affectedRows();
    }

    public function getDetailData($table, $field, $UID)
    {
        $builder = $this->db->table($table);
        $builder->where($field, $UID);
        return $builder->get()->getResultArray();
    }

    public function lihatDataPegawai()
    {
        $query = "SELECT 
            p.nip, p.nama_pegawai, p.jabatan, satker.nama_satker, bagian.nama_bagian, subbag.nama_subbag
        FROM 
            pegawai p
        LEFT OUTER JOIN (
            SELECT t1.* 
            FROM riwayat_pekerjaan t1
            WHERE t1.tanggal_mulai = (
                SELECT tanggal_mulai FROM riwayat_pekerjaan
                 WHERE nip = t1.nip
                 ORDER BY tanggal_mulai DESC
                 LIMIT 1
            )
        ) as q 
            on q.nip = p.nip
        LEFT OUTER JOIN satker ON
            q.id_satker = satker.id_satker
        LEFT OUTER JOIN bagian ON
            q.id_bagian = bagian.id_bagian
        LEFT OUTER JOIN subbag ON
            q.id_subbag = subbag.id_subbag
        ";

        return $this->db->query($query)->getResultArray();
    }

    public function lihatDetailPegawai($nip)
    {
        $query = "SELECT 
            p.*, satker.nama_satker, bagian.nama_bagian, subbag.nama_subbag, q.*
        FROM 
            pegawai p
        LEFT OUTER JOIN (
            SELECT t1.* 
            FROM riwayat_pekerjaan t1
            WHERE t1.tanggal_mulai = (
                SELECT tanggal_mulai FROM riwayat_pekerjaan
                 WHERE nip = t1.nip
                 ORDER BY tanggal_mulai DESC
                 LIMIT 1
            )
        ) as q 
            on q.nip = p.nip
        LEFT OUTER JOIN satker ON
            q.id_satker = satker.id_satker
        LEFT OUTER JOIN bagian ON
            q.id_bagian = bagian.id_bagian
        LEFT OUTER JOIN subbag ON
            q.id_subbag = subbag.id_subbag
        WHERE
            p.nip = '$nip'
        ";

        return $this->db->query($query)->getResultArray();
    }

    public function testingQuery()
    {
        // $builder = $this->db->table("pegawai");
        // $builder->select('pegawai.*, riwayat_pekerjaan.*, satker.*, bagian.*, subbag.*');
        // $builder->select('riwayat_pekerjaan.id_satker');
        // $builder->selectMax('riwayat_pekerjaan.tanggal_mulai');

        // $builder->orderBy('riwayat_pekerjaan.tanggal_mulai', 'ASC');

        // $builder->join('riwayat_pekerjaan', 'riwayat_pekerjaan.nip = pegawai.nip');
        // $builder->join('satker', 'satker.id_satker = riwayat_pekerjaan.id_satker');
        // $builder->join('bagian', 'bagian.id_bagian = riwayat_pekerjaan.id_bagian');
        // $builder->join('subbag', 'subbag.id_subbag = riwayat_pekerjaan.id_subbag');

        // $builder->groupBy('pegawai.nip');
        // $builder = $this->db->table('riwayat_pekerjaan');
        // $builder->select('*');
        // $builder->orderBy('tanggal_mulai', 'DESC');
        // $builder->distinct();

        // dd($builder->get()->getResultArray());
        // valid query for joining
        // dd($this->db->query("SELECT
        //     p.*, MAX(rp.tanggal_mulai), rp.no_sk
        //   FROM pegawai as p
        //   JOIN riwayat_pekerjaan as rp on p.nip = rp.nip
        //   GROUP by p.nip")->getResultArray());
    }
}
