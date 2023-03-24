<?php

namespace App\Controllers;

use App\Models\ProjectModel;
use App\Models\BidangModel;

class Dashboard extends BaseController
{
    protected $projectModel;
    protected $bidangModel;
    protected $db;

    public function __construct()
    {
        $this->projectModel = new ProjectModel();
        $this->bidangModel = new BidangModel();
        $this->db = db_connect();
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'bidang' => $this->bidangModel->findAll(),
            'projectDone' => $this->projectModel->get_project_done(),
            'projectProgress' => $this->projectModel->get_project_progress(),
            // 'project' => $this->projectModel->getTotalProject(),
            // 'projectosa' => $this->projectModel->getTotalProjectOSA(),
            'projectpasi' => $this->projectModel->getTotalProjectPASI(),
            // 'projectpati' => $this->projectModel->getTotalProjectPATI(),
            // 'projectids' => $this->projectModel->getTotalProjectIDS()
        ];
        return view('dashboard', $data);
    }
}
