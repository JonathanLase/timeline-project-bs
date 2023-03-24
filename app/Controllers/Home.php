<?php

namespace App\Controllers;


use App\Models\BidangModel;

class Home extends BaseController
{
    protected $bidangModel;
    protected $validation;

    public function __construct()
	{
		$this->bidangModel = new BidangModel();
		$this->validation =  \Config\Services::validation();
	}

    public function index()
    {
        $data = [
            'title' => 'Dashboard',
        ];
        return view('layouts/master_app', $data);
    }
}
