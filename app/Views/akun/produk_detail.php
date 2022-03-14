<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<section class="section">
  <div class="section-header">
    <h1>Detail Produk</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="/akun">Akun</a></div>
      <div class="breadcrumb-item"><a href="/akun/produk">Produk</a></div>
      <div class="breadcrumb-item">Detail Produk <?= $produk['id_produk'] ?></div>
    </div>
  </div>

  <div class="section-body">

    <h2 class="my-3 text-center">Akun</h2>
    <div class="row">
      <?= $this->include('layout/menu_akun'); ?>
      <div class="col-sm-9">
        <div class="bg-white border rounded shadow-sm p-4 h-100">
          <h4>Detail Produk</h4>
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
              <p class="card-text">: <?= $produk['stok']; ?></p>
              <p class="card-text">: <?= $produk['username']; ?></p>
              <p class="card-text">: <?= $produk['deskripsi_produk']; ?></p>
            </div>
          </div>
          <div class="mt-4">
            <a href="<?= base_url(); ?>/akun/produk" class="btn btn-primary">Kembali</a>
            <a href="<?= base_url(); ?>/akun/produk_edit/<?= $produk['id_produk']; ?>" class="btn btn-warning">Edit</a>
            <a href="<?= base_url(); ?>/akun/produk_hapus/<?= $produk['id_produk']; ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin?')">Hapus</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?= $this->endSection(); ?>