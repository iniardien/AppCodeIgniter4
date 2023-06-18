<?php

namespace App\Controllers;

use App\Models\OrangModel;
use CodeIgniter\HTTP\Files\UploadedFile;
use Exception;

class Orang extends BaseController
{
    protected $OrangModel;
    public function __construct()
    {
        $this->OrangModel = new OrangModel();
    }
    public function index()
    {

        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $orang = $this->OrangModel->search($keyword);
        } else {
            $orang = $this->OrangModel;
        }
        $currentPage = $this->request->getVar('page_orang') ? $this->request->getVar('page_orang') : 1;
        $data = [
            'title' => 'Daftar orang',
            // 'orang' => $this->OrangModel->findAll()
            'orang' => $orang->paginate(5, 'orang'),
            'pager' => $this->OrangModel->pager,
            'currentPage' => $currentPage
        ];

        return view('orang/index', $data);
    }
}
