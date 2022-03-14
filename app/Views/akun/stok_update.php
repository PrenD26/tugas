<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<section class="section">
  <div class="section-header">
    <h1>Tambah Stok</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="<?=base_url()?>/akun">Akun</a></div>
      <div class="breadcrumb-item"><a href="<?=base_url()?>/akun/stok">Stok</a></div>
      <div class="breadcrumb-item">Tambah Stok</div>
    </div>
  </div>

  <div class="section-body">

    <h2 class="my-3 text-center">Akun</h2>
    <div class="row">
      <?= $this->include('layout/menu_akun'); ?>
      <div class="col-sm-9">
        <div class="bg-white border rounded shadow-sm p-4 h-100">
          <h4>Tambah Stok Produk</h4>
          <hr class="my-3">
          <?php if (session()->getFLashdata('error')) : ?>
            <div class="alert alert-danger" role="alert">
              <?= session()->getFLashdata('error'); ?>
            </div>
          <?php endif; ?>
          <h5><?= $produk['nama_produk']; ?></h5>
          <form action="<?= base_url(); ?>/akun/stok_update_act" method="post">
            <?= csrf_field(); ?>
            <div class="form-group row mt-3">
              <label for="stok" class="col-sm-2 col-form-label">Tambah Stok</label>
              <div class="col-sm-10">
                <input type="number" class="form-control <?= ($validation->hasError('stok')) ? 'is-invalid' : ''; ?>" id="stok" name="stok" value="<?= old('stok'); ?>" placeholder="Tambah Stok Produk">
                <div class="invalid-feedback">
                  <?= $validation->getError('stok'); ?>
                </div>
              </div>
            </div>
            <input type="hidden" id="id_produk" name="id_produk" value="<?= $produk['id_produk']; ?>">
            <div class="form-group row">
              <div class="col">
                <div class="text-right">
                  <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<?= $this->endSection(); ?>