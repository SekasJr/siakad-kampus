<?php

namespace App\Controllers;
use App\Models\ModelMatkul;
use App\Models\ModelProdi;
class Matkul extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->ModelMatkul = new ModelMatkul;
        $this->ModelProdi = new ModelProdi();
    }

	public function index()
	{
		$data = 
		[
			'title'     => 'Mata Kuliah',
            'prodi'  => $this->ModelProdi->allData(),
			'isi'       => 'admin/v_matkul'
		];
		return view('layout/v_wrapper', $data);
	}
}