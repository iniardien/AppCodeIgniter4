<?php

namespace App\Controllers;

use App\Models\KomikModel;
use CodeIgniter\HTTP\Files\UploadedFile;
use Exception;

class Komik extends BaseController
{
    protected $komikModel;
    public function __construct()
    {
        $this->komikModel = new KomikModel();
    }
    public function index()
    {
        // $komik = $this->komikModel->findAll();
        $data = [
            'title' => 'Daftar Komik',
            'komik' => $this->komikModel->getKomik()
        ];

        return view('komik/index', $data);
    }

    public function detail($slug)
    {
        $data = [
            'title' => 'Detail Komik',
            'komik' => $this->komikModel->getKomik($slug)
        ];

        //jika tidak ditemukan
        if (empty($data['komik'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul komik ' . $slug . ' tidak ditemukan');
        }

        return view('komik/detail', $data);
    }

    public function create()
    {
        session();
        $data = [
            'title' => 'Form Tambah Data komik',
            'validation' => \Config\Services::validation()
        ];

        return view('komik/create', $data);
    }

    public function save()
    {

        //validation
        if (!$this->validate([
            'penulis' => 'required',
            'judul' => [
                'rules' => 'required|is_unique[komik.judul]',
                'errors' => [
                    'required' => '{field} komik harus diisi',
                    'is_unique' => '{field} komik sudah terdaftar'
                ]
            ]


        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/komik/create')->withInput()->with('validation', $validation);
        }
        //buat upload gambar
        $fileSampul = $this->request->getFile('sampul');
        //apakah tidak ada gambar yang di upload
        if ($fileSampul->getError() == 4) {
            $namaSampul = 'default.jpg';
        } else {
            //ambil nama file 
            $namaSampul = $fileSampul->getRandomName();
            //pindahkan file ke folder img
            $fileSampul->move('img', $namaSampul);
        }

        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->komikModel->save([
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $namaSampul
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan');

        return redirect()->to('/komik');
    }

    public function delete($id)
    {
        //cari gambar
        $komik = $this->komikModel->find($id);

        //cek gambar nya default 
        if ($komik['sampul'] != 'default.jpg') {
            //hapus gambar
            unlink('img/' . $komik['sampul']);
        }
        $this->komikModel->delete($id);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus');

        return redirect()->to('/komik');
    }

    public function edit($slug)
    {
        session();
        $data = [
            'title' => 'Form Ubah Data komik',
            'validation' => \Config\Services::validation(),
            'komik' => $this->komikModel->getKomik($slug)
        ];

        return view('komik/edit', $data);
    }

    public function update($id)
    {
        $komikLama = $this->komikModel->getKomik($this->request->getVar('slug'));
        if ($komikLama['judul'] == $this->request->getVar('judul')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[komik.judul]';
        }

        $ruless = $rule_judul;
        if (!$this->validate([
            'penulis' => 'required',

            'judul' => [
                'rules' => $ruless,
                'errors' => [
                    'required' => '{field} komik harus diisi',
                    'is_unique' => '{field} komik sudah terdaftar'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/komik/edit/' . $this->request->getVar('slug'))->withInput()->with('validation', $validation);
        }

        $fileSampul = $this->request->getFile('sampul');

        //cek gambar 
        if ($fileSampul->getError() == 4) {
            $namaSampul = $this->request->getVar('sampulLama');
        } else {
            $namaSampul = $fileSampul->getRandomName();
            $fileSampul->move('img', $namaSampul);
            unlink('img/' . $this->request->getVar('sampulLama'));
        }
        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->komikModel->save([
            'id' => $id,
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $namaSampul
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil Diubah');

        return redirect()->to('/komik');
    }
}
