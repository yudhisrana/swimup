<?php

namespace App\Models;

use CodeIgniter\Model;

class Event extends Model
{
    protected $table            = 'tbl_event';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'name', 'slug', 'kategori_umur_id', 'gaya_renang_id', 'jarak_renang_id', 'max_participant', 'description', 'even_date', 'status', 'created_by', 'updated_by', 'created_at', 'updated_at'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = '';
    protected $deletedField  = '';

    public function findAllDataWithRelation()
    {
        return $this->select('
            tbl_event.*,
            tbl_kategori_umur.name AS kategori_umur_name,
            tbl_gaya_renang.name AS gaya_renang_name,
            tbl_jarak_renang.name AS jarak_renang_name
        ')
            ->join('tbl_kategori_umur', 'tbl_kategori_umur.id = tbl_event.kategori_umur_id')
            ->join('tbl_gaya_renang', 'tbl_gaya_renang.id = tbl_event.gaya_renang_id')
            ->join('tbl_jarak_renang', 'tbl_jarak_renang.id = tbl_event.jarak_renang_id')
            ->findAll();
    }
}
