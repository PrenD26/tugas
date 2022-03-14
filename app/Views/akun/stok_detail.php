<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<section class="section">
  <div class="section-header">
    <h1>Detail Stok</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="<?=base_url()?>/akun">Akun</a></div>
      <div class="breadcrumb-item"><a href="<?=base_url()?>/akun/stok">Stok</a></div>
      <div class="breadcrumb-item">Detail Stok <?=$produk['id_produk']?></div>
    </div>
  </div>

  <div class="section-body">

    <h2 class="my-3 text-center">Akun</h2>
    <div class="row">
      <?= $this->include('layout/menu_akun'); ?>
      <div class="col-sm-9">
        <div class="bg-white border rounded shadow-sm p-4 h-100">
          <h4>Detail Stok Produk</h4>
          <hr class="my-3">
          <h5><?= $produk['nama_produk']; ?></h5>
          <div class="row">
            <div class="col-1 mr-2">
              <p class="card-text">Harga</p>
              <p class="card-text">Stok</p>
              <p class="card-text">Supplier</p>
              <p class="card-text">Deskirpsi</p>
            </div>
            <div class="col-3">
              <p class="card-text">: Rp <?= number_format($produk['harga_produk'], 0, ',', '.'); ?></p>
              <p class="card-text">: <?= ($produk['stok'] < 10) ? '<span class="badge badge-danger">' . $produk['stok'] . '</span>' : '<span class="badge badge-success">' . $produk['stok'] . '</span>'; ?></p>
              <p class="card-text">: <?= $produk['username']; ?></p>
              <p class="card-text">: <?= $produk['deskripsi_produk']; ?></p>
            </div>
          </div>
          <div class="mt-4">
            <div class="text-right">
              <?php if ($produk['stok'] < 10) :; ?>
                <a href="<?= base_url(); ?>/akun/stok_update/<?= $produk['id_produk']; ?>" class="btn btn-warning">Tambah Stok</a>
              <?php endif; ?>
              <a href="<?= base_url(); ?>/akun/stok" class="btn btn-primary">Kembali</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?= $this->endSection(); ?>