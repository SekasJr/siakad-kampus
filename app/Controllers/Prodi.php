<?php

namespace App\Controllers;
use App\Models\ModelProdi;
use App\Models\ModelFakultas;

class Prodi extends BaseController
{
    public function __construct()
    {
		helper('form');
        $this->ModelProdi = new ModelProdi();
        $this->ModelFakultas = new ModelFakultas();
    }

	public function index()
	{
		$data = 
		[
			'title' => 'Program Studi',
            'prodi' => $this->ModelProdi->allData(),
			'isi' => 'admin/prodi/v_index'
		];
		return view('layout/v_wrapper', $data);
	}
	
	public function add()
	{
		$data = 
		[
			'title'     => 'Tambah Program Studi',
			'fakultas'  => $this->ModelFakultas->allData(),
			'isi'       => 'admin/prodi/v_add'
		];
		return view('layout/v_wrapper', $data);
	}

	public function insert()
	{
		if ($this->validate([
            'id_fakultas' => [
                'label' => 'Fakultas',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} belum dipilih!'
				]
			],
			'kode_prodi' => [
                'label' => 'Kode Program Studi',
                'rules' => 'required|is_unique[tbl_prodi.kode_prodi]',
                'errors' => [
                    'required' => '{field} Wajib diisi!',
                    'is_unique' => '{field} sudah ada, input kode lain!'
				]
			],
			'prodi' => [
                'label' => 'Program Studi',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama {field} Wajib diisi!'
				]
			],
			'jenjang' => [
                'label' => 'Jenjang',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
				]
			],
		])) {
			//jika valid
			$data = [
				'id_fakultas' => $this->request->getPost('id_fakultas'),
				'kode_prodi' => $this->request->getPost('kode_prodi'),
				'prodi' => $this->request->getPost('prodi'),
				'jenjang' => $this->request->getPost('jenjang'),
			];
			$this->ModelProdi->add($data);
			session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
			return redirect()->to(base_url('prodi'));
		}else {
			//jika tidak valid
			session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('prodi/add'));
		}
	}

	// form edit prodi
	public function edit($id_prodi)
	{
		$data = 
		[
			'title'     => 'Ubah Data Program Studi',
			'fakultas'  => $this->ModelFakultas->allData(),
			'prodi'  => $this->ModelProdi->detail_Data($id_prodi),
			'isi'       => 'admin/prodi/v_edit'
		];
		return view('layout/v_wrapper', $data);
	}

	// edit prodi
	public function update($id_prodi)
	{
		if ($this->validate([
            'id_fakultas' => [
                'label' => 'Fakultas',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} belum dipilih!'
				]
			],
			'prodi' => [
                'label' => 'Program Studi',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama {field} Wajib diisi!'
				]
			],
			'jenjang' => [
                'label' => 'Jenjang',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Program Studi wajib diisi!'
				]
			],
		])) {
			//jika valid
			$data = [
				'id_prodi' => $id_prodi,
				'id_fakultas' => $this->request->getPost('id_fakultas'),
				'prodi' => $this->request->getPost('prodi'),
				'jenjang' => $this->request->getPost('jenjang'),
			];
			$this->ModelProdi->edit($data);
			session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
			return redirect()->to(base_url('prodi'));
		}else {
			//jika tidak valid
			session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('prodi/edit/' . $id_prodi));
		}
	}
	public function delete($id_prodi)
    {
        $data = [
            'id_prodi' => $id_prodi,
        ];
        $this->ModelProdi->delete_data($data);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to(base_url('prodi'));
    }

	//-------------------------------------------------------------------------------
}
