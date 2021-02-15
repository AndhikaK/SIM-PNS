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

    public function deleteData($id, $field, $table)
    {
        $builder = $this->db->table($table);
        $builder->where($field, $id);
        $builder->delete();
        return $this->affectedRows();
    }
}
