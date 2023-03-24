<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\KeteranganprojectModel;

class Keteranganproject extends BaseController
{

	protected $keteranganprojectModel;
	protected $validation;

	public function __construct()
	{
		$this->keteranganprojectModel = new KeteranganprojectModel();
		$this->validation =  \Config\Services::validation();
	}

	public function index()
	{
		$data = [
			'controller'    	=> ucwords('keteranganproject'),
			'title'     		=> 'Data ' . ucwords('keterangan_project')
		];
		return view('keteranganproject', $data);
	}

	public function getAll()
	{
		$response = $data['data'] = array();

		$result = $this->keteranganprojectModel->select()->findAll();
		$no = 1;
		foreach ($result as $key => $value) {
			$ops = '<div class="btn-group text-white">';
			$ops .= '<a class="btn btn-dark" onClick="save(' . $value->id_keterangan . ')"><i class="fa-solid fa-pen-to-square"></i></a>';
			$ops .= '<a class="btn btn-secondary" onClick="remove(' . $value->id_keterangan . ')"><i class="fa-solid fa-trash-alt"></i></a>';
			$ops .= '</div>';
			$data['data'][$key] = array(
				$no,
				$value->id_keterangan,
				$value->keterangan,
				$value->project_id,
				$ops
			);
			$no++;
		}

		return $this->response->setJSON($data);
	}

	public function getOne()
	{
		$response = array();

		$id = $this->request->getPost('id_keterangan');

		if ($this->validation->check($id, 'required|numeric')) {

			$data = $this->keteranganprojectModel->where('id_keterangan', $id)->first();

			return $this->response->setJSON($data);
		} else {
			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		}
	}

	public function add()
	{
		$response = array();

		$fields['id_keterangan'] = $this->request->getPost('id_keterangan');
		$fields['keterangan'] = $this->request->getPost('keterangan');
		$fields['project_id'] = $this->request->getPost('project_id');


		$this->validation->setRules([
			'keterangan' => ['label' => 'Keterangan', 'rules' => 'required|min_length[0]'],
			'project_id' => ['label' => 'Project id', 'rules' => 'required|numeric|min_length[0]'],

		]);

		if ($this->validation->run($fields) == FALSE) {
			$response['success'] = false;
			$response['messages'] = $this->validation->getErrors(); //Show Error in Input Form

		} else {

			if ($this->keteranganprojectModel->insert($fields)) {
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

		$fields['id_keterangan'] = $this->request->getPost('id_keterangan');
		$fields['keterangan'] = $this->request->getPost('keterangan');
		$fields['project_id'] = $this->request->getPost('project_id');


		$this->validation->setRules([
			'keterangan' => ['label' => 'Keterangan', 'rules' => 'required|min_length[0]'],
			'project_id' => ['label' => 'Project id', 'rules' => 'required|numeric|min_length[0]'],

		]);

		if ($this->validation->run($fields) == FALSE) {

			$response['success'] = false;
			$response['messages'] = $this->validation->getErrors(); //Show Error in Input Form

		} else {

			if ($this->keteranganprojectModel->update($fields['id_keterangan'], $fields)) {

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

		$id = $this->request->getPost('id_keterangan');

		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		} else {

			if ($this->keteranganprojectModel->where('id_keterangan', $id)->delete()) {

				$response['success'] = true;
				$response['messages'] = lang("App.delete-success");
			} else {

				$response['success'] = false;
				$response['messages'] = lang("App.delete-error");
			}
		}

		return $this->response->setJSON($response);
	}
}
