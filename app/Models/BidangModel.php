<?php

namespace App\Models;

use CodeIgniter\Model;

class BidangModel extends Model
{
	protected $table = 'bidang';
	protected $primaryKey = 'id_bidang';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	// protected $allowedFields = ['divisi_id','cabang_id','nama_bidang'];
	protected $allowedFields = ['divisi_id', 'nama_bidang'];
	protected $useTimestamps =  true;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;
}
