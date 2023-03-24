<?php
namespace App\Models;
use CodeIgniter\Model;

class KeteranganprojectModel extends Model {
	protected $table = 'keterangan_project';
	protected $primaryKey = 'id_keterangan';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['keterangan', 'project_id'];
	protected $useTimestamps = true;	
}