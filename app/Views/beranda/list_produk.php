<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<section class="section">
  <div class="section-header">
    <h1>Produk</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item">Produk</div>
    </div>
  </div>

  <div class="section-body">
    <h2 class="my-3 text-center">Produk Kami</h2>
    <form action="<?= base_url(); ?>/beranda/index" method="post">
      <div class="form-row">
        <div class="col-md-6 offset-md-3">
          <div class="input-group shadow-sm">
            <input type="search" class="form-control" placeholder="Cari produk..." aria-label="Cari produk..." aria-describedby="button-addon2" name="keyword" value="<?= $keyword; ?>">
            <div class="input-group-append">
              <button class="btn btn-primary" type="submit" id="button-addon2">Cari</button>
            </div>
          </div>
        </div>
      </div>
    </form>
    <hr>
    <div class="row">
      <?php foreach ($produk as $p) :; ?>
        <div class="col-12 col-md-6 col-lg-3">
          <a href="<?= base_url(); ?>/beranda/produk/<?= $p['id_produk']; ?>" class="text-decoration-none text-dark">
            <div class="card card-primary">
              <div class="card-header">
                <h4><?= $p['nama_produk']; ?></h4>
              </div>
              <div class="card-body">
                <p>Rp <?= number_format($p['harga_produk'], 0, ',', '.'); ?></p>
              </div>
            </div>
        </div>
      <?php endforeach; ?>
    </div>
</section>

<?= $this->endSection(); ?>