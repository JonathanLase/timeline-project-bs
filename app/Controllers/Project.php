<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\ProjectModel;
use App\Models\KeteranganprojectModel;
use App\Models\BidangModel;

class Project extends BaseController
{

	protected $db;
	protected $projectModel;
	protected $keteranganprojectModel;
	protected $bidangModel;
	protected $validation;

	public function __construct()
	{
		$this->db = db_connect();
		$this->projectModel = new ProjectModel();
		$this->bidangModel = new BidangModel();
		$this->keteranganprojectModel = new KeteranganprojectModel();
		$this->validation =  \Config\Services::validation();
	}

	public function index()
	{
		$data = [
			'controller'    	=> ucwords('project'),
			'title'     		=> 'Data ' . ucwords('project'),
			'bidang' 			=> $this->bidangModel->findAll()
			// 'uri_divisi'		=> $this->revertSlug($this->request->uri->getSegment(2)),
			// 'uri_bidang'		=> $this->revertSlug($this->request->uri->getSegment(3)),
		];
		return view('project', $data);
	}

	public function getAll()
	{
		$data = [];
		date_default_timezone_set('Asia/Jakarta');
		$result = $this->projectModel->select('id_project,name_project,bidang_id,nama_pic,start,deadline,status,bidang.divisi_id,divisi.divisi,bidang.nama_bidang as nm_bidang')
			->join('bidang', 'bidang.id_bidang = project.bidang_id')
			->join('divisi', 'bidang.divisi_id = divisi.id_divisi')
			->findAll();
		$no = 1;
		foreach ($result as $value) {

			// row time left
			$output = '';
			$date_deadline = $this->timeLeft($value->deadline . ' 23:59:59');
			if ($date_deadline > 3) {
				$output = '<button type="button" class="btn btn-sm btn-success">' . $date_deadline . '</button>';
			} else if ($date_deadline <= 3 && $date_deadline >= 2) {
				$output = '<button type="button" class="btn btn-sm btn-warning">' . $date_deadline . '</button>';
			} else {
				$output = '<button type="button" class="btn btn-sm btn-danger">' . $date_deadline . '</button>';
			}

			$outputStatus = '';
			$status = $value->status;
			if ($status == 1) {
				$outputStatus = '<button type="button"  class="btn btn-sm btn-success">Done</button>';
			} else {
				$outputStatus = '<button type="button" class="btn btn-sm btn-warning" onclick="statusProject(' . $value->id_project . ')">On Progress</button>';
			}

			// if ($value->nm_bidang == $this->request->getPost('nm_bidangProject')) {
			// 	$deadline = $value->deadline;
			// 	$start = $value->start;
			// 	$row = [];
			// 	$row[] = $no++;
			// 	$row[] = $value->name_project;
			// 	$row[] = $value->nama_pic;
			// 	$row[] = date("d-m-Y", strtotime($start));
			// 	$row[] = date("d-m-Y", strtotime($deadline));
			// 	$row[] = $output;
			// 	$row[] = $outputStatus;
			// 	$ops = '<div class="btn-group text-white">';
			// 	$ops .= '<a class="btn btn-label-primary text-primary viewdata" data-start="' . $value->start . '" onClick="save(' . $value->id_project . ')"><i class="fa-solid fa-pen-to-square"></i></a>';
			// 	$ops .= '<a class="btn btn-label-danger text-danger" onClick="remove(' . $value->id_project . ')"><i class="fa-solid fa-trash-alt"></i></a>';
			// 	$ops .= '</div>';
			// 	$row[] = $ops;
			// 	$data[] = $row;
			// }

			$deadline = $value->deadline;
			$start = $value->start;
			$row = [];
			$row[] = $no++;
			$row[] = $value->name_project;
			$row[] = $value->nm_bidang;
			$row[] = $value->nama_pic;
			$row[] = date("d-m-Y", strtotime($start));
			$row[] = date("d-m-Y", strtotime($deadline));
			$row[] = $output;
			$row[] = $outputStatus;
			$ops = '<div class="btn-group text-white">';
			$ops .= '<a class="btn btn-label-secondary text-secondary viewdata" data-start="' . $value->start . '" onClick="keterangan(' . $value->id_project . ')"><i class="fa-solid fa-eye"></i></a>';
			$ops .= '<a class="btn btn-label-primary text-primary viewdata" data-start="' . $value->start . '" onClick="save(' . $value->id_project . ')"><i class="fa-solid fa-pen-to-square"></i></a>';
			$ops .= '<a class="btn btn-label-danger text-danger" onClick="remove(' . $value->id_project . ')"><i class="fa-solid fa-trash-alt"></i></a>';
			$ops .= '</div>';
			$row[] = $ops;
			$data[] = $row;
		}

		$output = [
			'data' => $data
		];
		return json_encode($output);
	}

	public function getKeterangan()
    {
        echo json_encode($this->keteranganprojectModel->where("project_id", $this->request->getPost('id_project'))->findAll());
    }


	public static function timeLeft($deadline)
	{
		$today = date('d-m-Y');
		$diff = strtotime($deadline) - strtotime($today);
		if ($diff <= 0) {
			return "Deadline has passed!";
		}
		$days = floor($diff / (60 * 60 * 24));
		return $days . ' days left';
	}



	private static function revertSlug($slug)
	{
		$revertedSlug = preg_replace('/-/', ' ', $slug);
		$revertedSlug = str_replace(' ', ' ', $revertedSlug);
		return $revertedSlug;
	}

	public function getOne()
	{
		$response = array();

		$id = $this->request->getPost('id_project');

		if ($this->validation->check($id, 'required|numeric')) {

			$data = $this->projectModel->where('id_project', $id)->first();

			return $this->response->setJSON($data);
		} else {
			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		}
	}

	public function add()
	{
		$response = array();

		// $revertingSlug = $this->revertSlug($this->request->getPost('bidang_id'));

		// $getBidang = $this->db->table('bidang')->getWhere(['nama_bidang' => $revertingSlug])->getRowArray();

		$fields['id_project'] = $this->request->getPost('id_project');
		$fields['name_project'] = $this->request->getPost('name_project');
		$fields['bidang_id'] =  $this->request->getPost('id_bidang');
		$fields['nama_pic'] = $this->request->getPost('nama_pic');
		$fields['start'] = $this->request->getPost('start');
		$fields['deadline'] = $this->request->getPost('deadline');
		$fields['status'] = 0;


		$this->validation->setRules([
			'name_project' => ['label' => 'Name project', 'rules' => 'required|min_length[0]|max_length[200]'],
			'nama_pic' => ['label' => 'Nama pic', 'rules' => 'required|min_length[0]'],
			'start' => ['label' => 'Start', 'rules' => 'required|valid_date|min_length[0]'],
			'deadline' => ['label' => 'Deadline', 'rules' => 'required|valid_date|min_length[0]']
		]);

		if ($this->validation->run($fields) == FALSE) {

			$response['success'] = false;
			$response['messages'] = $this->validation->getErrors(); //Show Error in Input Form

		} else {

			if ($this->projectModel->insert($fields)) {

				$response['success'] = true;
				$response['messages'] = lang("App.insert-success");
			} else {

				$response['success'] = false;
				$response['messages'] = lang("App.insert-error");
			}
		}

		return $this->response->setJSON($response);
	}



	public function edit()
	{
		$response = array();
		date_default_timezone_set('Asia/Jakarta');

		// $revertingSlug = $this->revertSlug($this->request->getPost('bidang_id'));

		// $getBidang = $this->db->table('bidang')->getWhere(['nama_bidang' => $revertingSlug])->getRowArray();
		$fields['id_project'] = $this->request->getPost('id_project');
		$fields['name_project'] = $this->request->getPost('name_project');
		// $fields['bidang_id'] = (int) $getBidang['id_bidang'];
		$fields['bidang_id'] =  $this->request->getPost('id_bidang');
		$fields['nama_pic'] = $this->request->getPost('nama_pic');
		$fields['start'] = $this->request->getPost('start');
		$fields['deadline'] = $this->request->getPost('deadline');
		$fields['status'] = 0;


		$this->validation->setRules([
			'name_project' => ['label' => 'Name project', 'rules' => 'required|min_length[0]|max_length[200]'],
			'nama_pic' => ['label' => 'Nama pic', 'rules' => 'required|min_length[0]'],
			'start' => ['label' => 'Start', 'rules' => 'required|valid_date|min_length[0]'],
			'deadline' => ['label' => 'Deadline', 'rules' => 'required|valid_date|min_length[0]']
		]);

		if ($this->validation->run($fields) == FALSE) {

			$response['success'] = false;
			$response['messages'] = $this->validation->getErrors(); //Show Error in Input Form

		} else {
			$master = [
				'keterangan' =>  (string) $this->request->getPost('keterangan'),
				'project_id' => (int) $this->request->getPost('id_project'),
			];
			$this->keteranganprojectModel->insert($master);

			if ($this->projectModel->update($fields['id_project'], $fields)) {
				$response['success'] = true;
				$response['messages'] = lang("App.insert-success");
			} else {

				$response['success'] = false;
				$response['messages'] = lang("App.insert-error");
			}
		}

		return $this->response->setJSON($response);
	}


	public function remove()
	{
		$response = array();

		$id = $this->request->getPost('id_project');

		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		} else {

			if ($this->projectModel->where('id_project', $id)->delete()) {

				$response['success'] = true;
				$response['messages'] = lang("App.delete-success");
			} else {

				$response['success'] = false;
				$response['messages'] = lang("App.delete-error");
			}
		}

		return $this->response->setJSON($response);
	}

	public function updateStatus()
	{
		$response = array();

		$id = $this->request->getPost('id_project');

		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		} else {

			if ($this->projectModel->set('status', 1)->where('id_project', $id)->update()) {
				$response['success'] = true;
				$response['messages'] = lang("App.update-success");
			} else {
				$response['success'] = false;
				$response['messages'] = lang("App.update-error");
			}
		}

		return $this->response->setJSON($response);
	}
}
