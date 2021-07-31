<?php

namespace App\Controllers;
use App\Models\ModelTa;

class Ta extends BaseController
{
	public function __construct()
	{
		helper ('form');
		$this->ModelTa = new ModelTa();
	}

	public function index()
	{
		$data = 
		[
			'title' => 'Tahun Akademik',
			'ta' => $this->ModelTa->allData(),
			'isi' => 'admin/v_ta'
		];
		return view('layout/v_wrapper', $data);
	}

	public function add()
    {
        $data = [
            'ta' => $this->request->getPost('ta'),
            'semester' => $this->request->getPost('semester'),
        ];
        $this->ModelTa->add($data);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
        return redirect()->to(base_url('ta'));
    }
	//------------------------------------------------------------------------------
}
