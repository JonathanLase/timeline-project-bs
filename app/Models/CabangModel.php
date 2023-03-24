<?php
namespace App\Models;
use CodeIgniter\Model;

class CabangModel extends Model {
    
	protected $table = 'cabang';
	protected $primaryKey = 'id_cabang';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['nama_cabang', 'alamat', 'kota_provinsi', 'no_telp'];
	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;    
	
}