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
        return view('admin/produk/index', $data);
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
