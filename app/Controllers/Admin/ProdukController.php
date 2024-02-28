<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KategoriModel;

class ProdukController extends BaseController
{
    // daftar produk
    public function index()
    {
        $data = [
            'title' => 'Daftar Produk',

        ];
        return view('admin/produk/index.php', $data);
    }

    // daftar kategori produk
    public function kategori()
    {
        $data = [
            'title' => 'Daftar Kategori',
            'daftar_kategori' => $this->KategoriModel->findAll()
        ];
        return view('admin/produk/kategori.php', $data);
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
}
