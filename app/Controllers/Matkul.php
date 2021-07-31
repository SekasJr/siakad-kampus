<?php

namespace App\Controllers;
use App\Models\ModelMatkul;
class Matkul extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->ModelMatkul = new ModelMatkul;
    }

	public function index()
	{
		$data = 
		[
			'title'     => 'Mata Kuliah',
            'matkul'  => $this->ModelMatkul->allData(),
			'isi'       => 'admin/v_matkul'
		];
		return view('layout/v_wrapper', $data);
	}
}