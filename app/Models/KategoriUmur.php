<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriUmur extends Model
{
    protected $table            = 'tbl_kategori_umur';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'updated_at'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = '';
    protected $deletedField  = '';

    public function findAllData()
    {
        return $this->findAll();
    }

    public function findById($id)
    {
        return $this->where('id', $id)->first();
    }

    public function saveData($data)
    {
        return $this->insert($data);
    }

    public function updateData($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteData($id)
    {
        return $this->delete($id);
    }
}
