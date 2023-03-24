<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\BidangModel;
// use App\Models\CabangModel;
use App\Models\DivisiModel;

class Bidang extends BaseController
{

	protected $cabangModel;
	protected $bidangModel;
	protected $divisiModel;
	protected $validation;

	public function __construct()
	{
		$this->bidangModel = new BidangModel();
		// $this->cabangModel = new CabangModel();
		$this->divisiModel = new DivisiModel();
		$this->validation =  \Config\Services::validation();
	}

	public function index()
	{

		$data = [
			'controller'    	=> ucwords('bidang'),
			'title'     		=> 'Data ' . ucwords('bidang'),
			'divisi'				=> $this->divisiModel->findAll()
		];

		return view('bidang_all', $data);
		// return view('bidang', $data);
	}

	public function getAll()
	{
		$response = $data['data'] = array();

		// $result = $this->bidangModel->select('id_bidang,divisi.divisi,cabang.nama_cabang,nama_bidang')
		$result = $this->bidangModel->select('id_bidang,divisi.divisi,nama_bidang')
			->join('divisi', 'bidang.divisi_id = divisi.id_divisi')
			// ->join('cabang', 'bidang.cabang_id = cabang.id_cabang')
			->findAll();
		$no = 1;
		foreach ($result as $key => $value) {
			$ops = '<div class="btn-group text-white">';
			$ops .= '<a class="btn btn-label-primary text-primary" onClick="save(' . $value->id_bidang . ')"><i class="fa-solid fa-pen-to-square"></i></a>';
			$ops .= '<a class="btn btn-label-danger text-danger" onClick="remove(' . $value->id_bidang . ')"><i class="fa-solid fa-trash-alt"></i></a>';
			$ops .= '</div>';
			$data['data'][$key] = array(
				$no,
				// 'Bank SUMUT - ' . $value->nama_cabang,
				$value->divisi,
				'<a class="text-primary nav-link" href="' . base_url() . '/projek/' . url_title($value->divisi) . '/' . url_title($value->nama_bidang) . '">' . $value->nama_bidang . '</a>',
				$ops
			);
			$no++;
		}

		return $this->response->setJSON($data);
	}

	public function getAllBidang()
	{
		$response = $data['data'] = array();

		// $result = $this->bidangModel->select('id_bidang,divisi.divisi,cabang.nama_cabang,nama_bidang')
		$result = $this->bidangModel->select('id_bidang,divisi.divisi,nama_bidang')
			->join('divisi', 'bidang.divisi_id = divisi.id_divisi')
			// ->join('cabang', 'bidang.cabang_id = cabang.id_cabang')
			->findAll();
		$no = 1;
		foreach ($result as $key => $value) {
			$ops = '<div class="btn-group text-white">';
			$ops .= '<a class="btn btn-label-primary text-primary" onClick="save(' . $value->id_bidang . ')"><i class="fa-solid fa-pen-to-square"></i></a>';
			$ops .= '<a class="btn btn-label-danger text-danger" onClick="remove(' . $value->id_bidang . ')"><i class="fa-solid fa-trash-alt"></i></a>';
			$ops .= '</div>';
			$data['data'][$key] = array(
				$no,
				// 'Bank SUMUT - ' . $value->nama_cabang,
				$value->divisi,
				$value->nama_bidang,
				$ops
			);
			$no++;
		}

		return $this->response->setJSON($data);
	}

	public function getOne()
	{
		$response = array();

		$id = $this->request->getPost('id_bidang');

		if ($this->validation->check($id, 'required|numeric')) {

			$data = $this->bidangModel->where('id_bidang', $id)->first();

			return $this->response->setJSON($data);
		} else {
			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		}
	}

	public function add()
	{
		$response = array();
		$fields['id_bidang'] = $this->request->getPost('id_bidang');
		$fields['divisi_id'] = $this->request->getPost('divisi_id');
		// $fields['cabang_id'] = user()->cabang_id;
		$fields['nama_bidang'] = strtoupper((string) $this->request->getPost('nama_bidang'));


		$this->validation->setRules([
			'nama_bidang' => ['label' => 'Nama bidang', 'rules' => 'required|min_length[2]|max_length[200]'],

		]);

		if ($this->validation->run($fields) == FALSE) {
			$response['success'] = false;
			$response['messages'] = $this->validation->getErrors(); //Show Error in Input Form

		} else {

			if ($this->bidangModel->insert($fields)) {
				$response['tambah'] = true;
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

		$fields['id_bidang'] = $this->request->getPost('id_bidang');
		$fields['divisi_id'] = $this->request->getPost('divisi_id');
		// $fields['cabang_id'] = user()->cabang_id;
		$fields['nama_bidang'] = strtoupper((string) $this->request->getPost('nama_bidang'));


		$this->validation->setRules([
			'nama_bidang' => ['label' => 'Nama bidang', 'rules' => 'required|min_length[2]|max_length[200]'],

		]);

		if ($this->validation->run($fields) == FALSE) {

			$response['success'] = false;
			$response['messages'] = $this->validation->getErrors(); //Show Error in Input Form

		} else {

			if ($this->bidangModel->update($fields['id_bidang'], $fields)) {
				$response['ubah'] = true;
				$response['success'] = true;
				$response['messages'] = lang("App.update-success");
			} else {

				$response['success'] = false;
				$response['messages'] = lang("App.update-error");
			}
		}

		return $this->response->setJSON($response);
	}

	public function remove()
	{
		$response = array();

		$id = $this->request->getPost('id_bidang');

		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		} else {

			if ($this->bidangModel->where('id_bidang', $id)->delete()) {
				$response['success'] = true;
				$response['hapus'] = true;
				$response['id_hapus'] = $this->request->getPost('id_bidang');
				$response['messages'] = lang("App.delete-success");
			} else {

				$response['success'] = false;
				$response['messages'] = lang("App.delete-error");
			}
		}

		return $this->response->setJSON($response);
	}
}
