<?php
namespace App\Models;
use CodeIgniter\Model;

class DivisiModel extends Model {
    
	protected $table = 'divisi';
	protected $primaryKey = 'id_divisi';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['divisi', 'timestamp'];
	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;    
	
}