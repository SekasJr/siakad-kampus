<?php

namespace App\Controllers;
use App\Models\ModelDosen;

class Dosen extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->ModelDosen = new ModelDosen();
    }

	public function index()
	{
		$data = 
		[
			'title' => 'Dosen',
            'dosen' => $this->ModelDosen->allData(),
			'isi' => 'admin/dosen/v_index'
		];
		return view('layout/v_wrapper', $data);
	}

    public function add()
	{
		$data = 
		[
			'title' => 'Tambah Dosen',
            'dosen' => $this->ModelDosen->allData(),
			'isi' => 'admin/dosen/v_add'
		];
		return view('layout/v_wrapper', $data);
	}

    public function insert()
    {
        if ($this->validate([
            'kode_dosen' => [
                'label' => 'Kode Dosen',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
				]
			],
			'nidn' => [
                'label' => 'NIDN',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi!',
				]
			],
			'nama_dosen' => [
                'label' => 'Nama Dosen',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi!',
				]
			],
			'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi!'
				]
			],
			'foto_dosen' => [
                'label' => 'Foto Dosen',
                'rules' => 'uploaded[foto_dosen]|max_size[foto_dosen,1024]|mime_in[foto_dosen,image/png,image/jpg,image/gif,image/ico,image/jpeg]',
                'errors' => [
                    'uploaded' => '{field} wajib diisi!',
                    'max_size' => '{field} Max 1024KB!',
                    'mime_in' => 'Format {field} hanya PNG, JPG, JPEG, ICO, GIF!'	
				]
			],
		])) {
			
			//mengambil file foto dari form input
			$foto = $this->request->getFile('foto_dosen');
			
			//merenane nama file foto
			$nama_file = $foto->getRandomName();

			// Jika valid
			$data = array(
				'kode_dosen' => $this->request->getPost('kode_dosen'),
				'nidn' => $this->request->getPost('nidn'),
				'nama_dosen' => $this->request->getPost('nama_dosen'),
				'password' => $this->request->getPost('password'),
				'foto_dosen' => $nama_file,
			);

			//memindahkan file foto dari form input ke directory folder foto
			$foto->move('fotodosen', $nama_file);
			$this->ModelDosen->add($data);
			session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
        	return redirect()->to(base_url('dosen'));
		}else {
			// Jika tidak valid
			session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('dosen/add'));
		}
    }

}