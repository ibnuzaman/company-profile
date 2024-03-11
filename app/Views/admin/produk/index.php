<?= $this->extend('admin/layout/template'); ?>

<?= $this->section('content'); ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Daftar Produk</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
                <li class="breadcrumb-item active">Daftar produk</li>
            </ol>
            <div class="card mb-4">
                <div class="card-body">
                    <!-- <p class="mb-0"> -->
                    <div class="card-body">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">
                            <i class="fas fa-plus"></i>Add
                        </button>

                        <!-- Notif succes tambah produk -->
                        <?php if (session()->getFlashdata('success')) : ?>
                            <div class="alert alert-success" role="alert">
                                <?= session()->getFlashdata('success'); ?>
                            </div>
                        <?php endif; ?>
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Produk</th>
                                    <th>Nama Kategori</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Fungsi </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($daftar_produk as $produk) : ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $produk->nama_produk ?></td>
                                        <td><?= $produk->kategori_slug ?></td>
                                        <td><?= date('d/m/Y H:i:s', strtotime($produk->tanggal_masuk)); ?></td>
                                        <td>
                                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#ubahModal<?= $produk->id_produk; ?>"><i class="fas fa-edit"></i> Edit</button>
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusModal<?= $produk->id_produk; ?>"><i class="fas fa-edit"></i> Delete</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div style="height: 100vh"></div>
            <div class="card mb-4">
                <div class="card-body">When scrolling, the navigation stays at the top of the page. This is the end of the static navigation demo.</div>
            </div>
        </div>
    </main>

    <!-- Modal -->
    <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fas fa-plus"></i>Tambah produk</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('daftar-produk/tambah'); ?>" method="post">
                        <?= csrf_field(); ?>
                        <div class="mb-3">
                            <label for="nama_produk">Nama produk</label>
                            <input type="nama_produk" name="nama_produk" id="nama_produk" class="form-control" required>
                            <label for="kategori_slug">Nama Kategori</label>
                            <input type="kategori_slug" name="kategori_slug" id="kategori_slug" class="form-control" required>
                            <label for="deskripsi">Deskripsi</label>
                            <input type="deskripsi" name="deskripsi" id="deskripsi" class="form-control" required>
                            <label for="gambar_produk">Gambar Produk</label>
                            <input type="file" name="gambar_produk" id="gambar_produk" class="form-control" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Ubah Modal -->
    <?php foreach ($daftar_produk as $produk) : ?>
        <div class="modal fade" id="ubahModal<?= $produk->id_produk; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fas fa-edit"></i>Ubah produk</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('daftar-produk/ubah' . $produk->id_produk); ?>" method="post">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="_method" value="PUT">
                            <div class="mb-3">
                                <label for="nama_produk">Nama produk</label>
                                <input type="text" name="nama_produk" id="nama_produk" class="form-control" value="<?= $produk->nama_produk; ?>">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Ubah</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

    <?php endforeach; ?>


    <!-- Hapus Modal -->
    <?php foreach ($daftar_produk as $produk) : ?>
        <div class="modal fade" id="hapusModal<?= $produk->id_produk; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fas fa-edit"></i>Hapus produk</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="<?= base_url('daftar-produk/hapus' . $produk->id_produk); ?>" method="post">
                        <div class="modal-body">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="_method" value="DELETE">

                            <p>Yakin Data produk <?= $produk->nama_produk; ?> dihapus ?</p>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    <?php endforeach; ?>




    <?= $this->endSection(); ?>