<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<section class="section">
  <div class="section-header">
    <h1>Detail Produk</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="<?=base_url()?>/">Produk</a></div>
      <div class="breadcrumb-item">Detail Produk</div>
    </div>
  </div>

  <div class="section-body">
    <h2 class="my-3 text-center">Detail Produk</h2>
    <div class="d-block">
      <div class="card mb-3 mx-auto shadow" style="max-width: 400px;">
        <div class="row no-gutters">
          <div class="col-md-12">
            <div class="card-body text-center">
              <div  class="mb-3">
                <img alt="image" src="https://source.unsplash.com/random/500x400/?shoes" class="img-fluid">
              </div>
              <h5 class="card-title"><?= $produk['nama_produk']; ?></h5>
              <p class="card-text">Stok : <?= $produk['stok']; ?></p>
              <p class="card-text">Harga : Rp <?= number_format($produk['harga_produk'], 0, ',', '.'); ?></p>
              <p class="card-text">Deskripsi : <?= $produk['deskripsi_produk']; ?></p>
              <?php if (session('role') == 'pembeli') :; ?>
                <a href="<?= base_url(); ?>/pesanan/pesan/<?= $produk['id_produk']; ?>" class="btn btn-primary btn-block">BELI</a>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?= $this->endSection(); ?>