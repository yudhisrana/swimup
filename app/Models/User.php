<?php

namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
    protected $table            = 'tbl_user';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'name', 'username', 'password', 'email', 'phone', 'address', 'image', 'status', 'role_id', 'created_at', 'updated_at'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = '';
    protected $deletedField  = '';

    public function findDataWithRelation()
    {
        return $this->select('tbl_user.*, tbl_role.name')
            ->join('tbl_role', 'id = tbl_user.role_id')
            ->findAll();
    }
}
