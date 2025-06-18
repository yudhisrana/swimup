<?php

namespace App\Models;

use CodeIgniter\Model;

class Pendaftaran extends Model
{
    protected $table            = 'tbl_pendaftaran';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'event_id', 'nama_peserta', 'tanggal_lahir', 'gender', 'email', 'phone', 'address', 'image', 'status', 'created_at', 'updated_at'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = '';
    protected $deletedField  = '';

    public function findAllDataWithRelation()
    {
        return $this->select('
            tbl_pendaftaran.*,
            tbl_event.name AS event_name
        ')
            ->join('tbl_event', 'tbl_event.id = tbl_pendaftaran.event_id')
            ->findAll();
    }

    public function findDataWithRelationById($id)
    {
        return $this->select('
            tbl_pendaftaran.*,
            tbl_event.name AS event_name
        ')
            ->join('tbl_event', 'tbl_event.id = tbl_pendaftaran.event_id')
            ->where('tbl_pendaftaran.id', $id)
            ->first();
    }

    public function countApprovedByEvent($eventId)
    {
        return $this->where('event_id', $eventId)
            ->where('status', 'Disetujui')
            ->countAllResults();
    }

    public function countAllRegister()
    {
        return $this->countAllResults();
    }
}
