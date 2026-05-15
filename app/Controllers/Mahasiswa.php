<?php

namespace App\Controllers;
use App\Models\MahasiswaModel;

class Mahasiswa extends BaseController 
{
    public function index() 
    {
        return view('Mahasiswa_view');
    }

    public function getData() 
    {
        $model = new MahasiswaModel();
        $data = $model->findAll();
        return $this->response->setJSON(['data' => $data]); 
    }

    public function simpan() 
    {
        $model = new MahasiswaModel();
        $model->insert([
            'nama' => $this->request->getPost('nama'),
            'prodi' => $this->request->getPost('prodi')
        ]);
        
        return $this->response->setJSON(['status' => 'success']); 
    }
}