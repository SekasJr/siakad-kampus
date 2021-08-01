<?php

namespace App\Controllers;
use App\Models\ModelUser;


class User extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->ModelUser = new ModelUser;
    }

	public function index()
	{
		$data = 
		[
			'title'     => 'User',
            'user'  => $this->ModelUser->allData(),
			'isi'       => 'admin/v_user'
		];
		return view('layout/v_wrapper', $data);
	}

	public function add()
	{
		if ($this->validate([
            'nama_user' => [
                'label' => 'Nama User',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
				]
			],
			'username' => [
                'label' => 'User Name',
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
			'foto' => [
                'label' => 'Foto',
                'rules' => 'uploaded[foto]|max_size[foto,1024]|mime_in[foto,image/png,image/jpg,image/gif,image/ico,image/jpeg]',
                'errors' => [
                    'uploaded' => '{field} wajib diisi!',
                    'max_size' => '{field} Max 1024KB!',
                    'mime_in' => 'Format {field} hanya PNG, JPG, JPEG, ICO, GIF!'
					
				]
			],
		])) {
			
			//mengambil file foto dari form input
			$foto = $this->request->getFile('foto');
			
			//merenane nama file foto
			$nama_file = $foto->getRandomName();

			// Jika valid
			$data = array(
				'nama_user' => $this->request->getPost('nama_user'),
				'username' => $this->request->getPost('username'),
				'password' => $this->request->getPost('password'),
				'foto' => $nama_file,
			);

			//memindahkan file foto dari form input ke directory folder foto
			$foto->move('foto', $nama_file);
			$this->ModelUser->add($data);
			session()->setFlashdata('pesan', 'Data berhasil tambahkan.');
        	return redirect()->to(base_url('user'));
		}else {
			// Jika tidak valid
			session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('user'));
		}
	}
}