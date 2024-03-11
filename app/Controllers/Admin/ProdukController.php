<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KategoriModel;

use function PHPUnit\Framework\returnSelf;

class ProdukController extends BaseController
{
    // daftar produk
    public function index()
    {
        $data = [
            'title' => 'Daftar Produk',
            'daftar_produk' => $this->ProdukModel->orderBy('id_produk', 'DESC')->findAll()

        ];
        return view('admin/produk/index', $data);
    }

    public function store_produk()
    {
        $rules = [
            'nama_produk' => 'required',
            'kategori_slug' => 'required',
            'gambar_produk' => 'uploaded[gambar_produk]|is_image[gambar_produk]|max_size[gambar_produk,1024]|mine_in[gambar_produk,image/jpg,image/jpeg,image/png]',
        ];

        // if ($this->validate($rules)) {
        //     $response = [
        //         'message' => 'Ada kolom yang harus diisi'
        //     ];
        // }


        // $gambar = $this->request->getFile('gambar_produk');
        // $nama_gambar = $gambar->getRandomName($gambar);
        // $gambar->move('gambar_produk', $nama_gambar);


        $slug = url_title($this->request->getPost('nama_produk'), '-', TRUE);

        $data = [
            'nama_produk' => esc($this->request->getPost('nama_produk')),
            'kategori_slug' => esc($this->request->getPost('kategori_slug')),
            'deskripsi' => esc($this->request->getPost('deskripsi')),
            'gambar_produk' => esc($this->request->getPost('gambar_produk')),
            'slug_produk' => $slug,
        ];

        $this->ProdukModel->insert($data);

        return redirect()->back()->with('succes', 'Data Kategori Berhasil ditambahkan');
    }

    public function update_produk($id_produk)
    {
        $slug = url_title($this->request->getPost('nama_produk'), '-', TRUE);

        $data = [
            'nama_produk' => esc($this->request->getPost('nama_produk')),
            'slug_produk' => $slug,
        ];

        $this->ProdukModel->update($id_produk, $data);

        return redirect()->back()->with('succes', 'Data produk Berhasil diubah');
    }

    public function delete_produk($id_produk)
    {
        $this->ProdukModel->delete($id_produk);
        return redirect()->back()->with('success', 'Data produk Berhasil Dihapus');
    }


    // daftar kategori produk
    public function kategori()
    {
        $data = [
            'title' => 'Daftar Kategori Produk',
            'daftar_kategori' => $this->KategoriModel->orderBy('id_kategori', 'DESC')->findAll()
        ];
        return view('admin/produk/kategori', $data);
    }

    public function store()
    {
        // // get slug
        // $slug = url_title($this->request->getPost('nama_kategori'), '-', TRUE);
        // // saving data in database
        // dd($_POST);

        $slug = url_title($this->request->getPost('nama_kategori'), '-', TRUE);

        $data = [
            'nama_kategori' => esc($this->request->getPost('nama_kategori')),
            'slug_kategori' => $slug,
        ];

        $this->KategoriModel->insert($data);

        return redirect()->back()->with('succes', 'Data Kategori Berhasil ditambahkan');
    }

    public function update($id_kategori)
    {
        $slug = url_title($this->request->getPost('nama_kategori'), '-', TRUE);

        $data = [
            'nama_kategori' => esc($this->request->getPost('nama_kategori')),
            'slug_kategori' => $slug,
        ];

        $this->KategoriModel->update($id_kategori, $data);

        return redirect()->back()->with('succes', 'Data Kategori Berhasil diubah');
    }

    public function delete($id_kategori)
    {
        $this->KategoriModel->delete($id_kategori);
        return redirect()->back()->with('success', 'Data Kategori Berhasil Dihapus');
    }

    // public function edit($id)
    // {
    //     $news = new KategoriModel();
    //     $data['news'] = $news->where('id_kategori', $id)->first();

    //     $validation = \Config\Services::validation();
    //     $validation->setRules([
    //         'id_kategori' => 'required',
    //         'nama_kategori' => 'required'
    //     ]);
    //     $isDataValid = $validation->withRequest($this->request)->run();

    //     if ($isDataValid) {
    //         $news->update($id, [
    //             'nama_kategori' => $this->getPost('nama_kategori')
    //         ]);
    //         return redirect()->back();
    //     }
    // }
}
