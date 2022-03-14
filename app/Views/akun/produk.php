<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<section class="section">
  <div class="section-header">
    <h1>Menu Akun</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="/akun">Akun</a></div>
      <div class="breadcrumb-item">Produk</div>
    </div>
  </div>

  <div class="section-body">

    <h2 class="my-3 text-center">Akun</h2>
    <div class="row">
      <?= $this->include('layout/menu_akun'); ?>
      <div class="col-sm-9">
        <div class="bg-white border rounded shadow-sm p-4 h-100">
          <div class="d-flex justify-content-between">
            <h4>Produk</h4>
            <a href="<?= base_url(); ?>/akun/produk_tambah" class="btn btn-primary">Tambah Produk</a>
          </div>
          <hr>
          <?php if (session()->getFLashdata('pesan')) : ?>
            <div class="alert alert-success mt-2" role="alert">
              <?= session()->getFLashdata('pesan'); ?>
            </div>
          <?php endif; ?>
          <div class="table-responsive">
            <table class="table table-striped" id="table-1">
              <thead>
                <tr class="text-center">
                  <th>No.</th>
                  <th>Nama</th>
                  <th>Harga</th>
                  <th>Stok</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1;
                foreach ($produk as $p) : ?>
                  <tr class="text-center">
                    <th><?= $i++; ?>.</th>
                    <td><?= $p['nama_produk']; ?></td>
                    <td>Rp <?= number_format($p['harga_produk'], 0, ',', '.'); ?></td>
                    <td><?= $p['stok']; ?></td>
                    <td><a href="<?= base_url(); ?>/akun/produk_detail/<?= $p['id_produk']; ?>" class="btn btn-primary btn-sm">Detail</a></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>
<?= $this->endSection(); ?>