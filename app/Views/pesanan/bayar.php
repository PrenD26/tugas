<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<section class="section">
  <div class="section-header">
    <h1>Default Layout</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
      <div class="breadcrumb-item"><a href="#">Layout</a></div>
      <div class="breadcrumb-item">Default Layout</div>
    </div>
  </div>

  <div class="section-body">

    <h2 class="my-3 text-center">Pembayaran</h2>
    <?php if (session()->getFLashdata('error')) : ?>
      <div class="alert alert-danger" role="alert">
        <?= session()->getFLashdata('error'); ?>
      </div>
    <?php endif; ?>
    <div class="row">
      <div class="col-sm-6 offset-md-3">
        <div class="bg-white border rounded shadow p-4 h-100">
          <div class="card border-0 mb-5 mx-auto" style="max-width: 400px;">
            <div class="row no-gutters">
              <div class="col-md-12">
                <div class="card-body p-0 text-center">
                  <h5 class="card-title"><?= $pesanan['nama_produk']; ?></h5>
                  <p class="card-text">Jumlah Pesanan : <?= $pesanan['qty']; ?></p>
                  <p class="card-text">Harga : Rp <?= number_format($pesanan['harga_produk'], 0, ',', '.'); ?></p>
                  <p class="card-text">Total Harga : Rp <?= number_format(($pesanan['harga_produk'] * $pesanan['qty']), 0, ',', '.'); ?></p>
                </div>
              </div>
            </div>
          </div>
          <form action="<?= base_url(); ?>/pesanan/pembayaran_act" method="post">
            <?= csrf_field(); ?>
            <div class="form-group row">
              <label for="total_harga" class="col-sm-2 col-form-label">Total Bayar</label>
              <div class="col-sm-10">
                <input type="number" class="form-control <?= ($validation->hasError('total_harga')) ? 'is-invalid' : ''; ?>" id="total_harga" name="total_harga" value="<?= old('total_harga'); ?>" placeholder="Masukkan Total Bayar">
                <div class="invalid-feedback">
                  <?= $validation->getError('total_harga'); ?>
                </div>
              </div>
            </div>
            <input type="hidden" name="id_pesanan" value="<?= $pesanan['id_pesanan']; ?>">
            <div class="form-group row">
              <div class="col">
                <button type="submit" class="btn btn-primary btn-block">Bayar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<?= $this->endSection(); ?>