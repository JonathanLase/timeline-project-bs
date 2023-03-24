<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectModel extends Model
{

	protected $table = 'project';
	protected $primaryKey = 'id_project';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['name_project', 'bidang_id', 'nama_pic', 'start', 'deadline', 'status'];
	protected $useTimestamps = true;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;

	public function get_project_done()
	{
		return $this->select("bidang.nama_bidang as nm_bidang, COUNT(project.id_project) as total_project_done")
			->where('status', 1)
			->join('bidang', 'bidang.id_bidang = project.bidang_id')
			->groupBy('nama_bidang')
			->get()->getResultArray();
	}

	public function get_project_progress()
	{
		return $this->select("bidang.nama_bidang as nm_bidang, COUNT(project.id_project) as total_project_progress")
			->where('status', 0)
			->join('bidang', 'bidang.id_bidang = project.bidang_id')
			->groupBy('nama_bidang')
			->get()->getResultArray();
	}

	// public function getTotalProject()
	// {
	// 	$result = $this->db->query('SELECT * FROM project WHERE bidang_id = 3')->getNumRows();
	// 	return $result;
	// }

	// public function getTotalProjectOSA()
	// {
	// 	return $this->select("bidang.nama_bidang as nm_bidang, COUNT(project.id_project) as totalProjectOsa")
	// 		->where('bidang_id', 3)
	// 		->join('bidang', 'bidang.id_bidang = project.bidang_id')
	// 		->groupBy('nama_bidang')->get()->getResultArray();
	// }
	public function getTotalProjectPASI()
	{
		return $this->select("bidang.nama_bidang as nm_bidang, COUNT(project.id_project) as totalProjectPasi")
			->where('bidang_id', 35)
			->join('bidang', 'bidang.id_bidang = project.bidang_id')
			->groupBy('nama_bidang')->get()->getResultArray();
	}
	// public function getTotalProjectPATI()
	// {
	// 	return $this->select("bidang.nama_bidang as nm_bidang, COUNT(project.id_project) as totalProjectPati")
	// 		->where('bidang_id', 34)
	// 		->join('bidang', 'bidang.id_bidang = project.bidang_id')
	// 		->groupBy('nama_bidang')->get()->getResultArray();
	// }
	// public function getTotalProjectIDS()
	// {
	// 	return $this->select("bidang.nama_bidang as nm_bidang, COUNT(project.id_project) as totalProjectIds")
	// 		->where('bidang_id', 59)
	// 		->join('bidang', 'bidang.id_bidang = project.bidang_id')
	// 		->groupBy('nama_bidang')->get()->getResultArray();
	// }
}
