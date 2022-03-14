<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<section class="section">
  <div class="section-header">
    <h1>Create Produk</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="/akun">Akun</a></div>
      <div class="breadcrumb-item"><a href="/akun/produk">Produk</a></div>
      <div class="breadcrumb-item">Create Produk</div>
    </div>
  </div>

  <div class="section-body">

    <h2 class="my-3 text-center">Akun</h2>
    <div class="row">
      <?= $this->include('layout/menu_akun'); ?>
      <div class="col-sm-9">
        <div class="bg-white border rounded shadow-sm p-4 h-100">
          <h4>Tambah Produk</h4>
          <hr class="my-3">
          <?php if (session()->getFLashdata('error')) : ?>
            <div class="alert alert-danger" role="alert">
              <?= session()->getFLashdata('error'); ?>
            </div>
          <?php endif; ?>
          <form action="<?= base_url(); ?>/akun/produk_tambah_act" method="post">
            <?= csrf_field(); ?>
            <div class="form-group row">
              <label for="nama_produk" class="col">Nama Produk</label>
              <div class="col-sm-10">
                <input type="text" class="form-control <?= ($validation->hasError('nama_produk')) ? 'is-invalid' : ''; ?>" id="nama_produk" name="nama_produk" value="<?= old('nama_produk'); ?>" autofocus placeholder="Nama Produk">
                <div class="invalid-feedback">
                  <?= $validation->getError('nama_produk'); ?>
                </div>
              </div>
            </div>
            <div class="form-group row">
              <label for="harga_produk" class="col">Harga Produk</label>
              <div class="col-sm-10">
                <input type="number" class="form-control <?= ($validation->hasError('harga_produk')) ? 'is-invalid' : ''; ?>" id="harga_produk" name="harga_produk" value="<?= old('harga_produk'); ?>" placeholder="Harga Produk">
                <div class="invalid-feedback">
                  <?= $validation->getError('harga_produk'); ?>
                </div>
              </div>
            </div>
            <div class="form-group row">
              <label for="stok" class="col">Stok Produk</label>
              <div class="col-sm-10">
                <input type="number" class="form-control <?= ($validation->hasError('stok')) ? 'is-invalid' : ''; ?>" id="stok" name="stok" value="<?= old('stok'); ?>" placeholder="Stok Produk">
                <div class="invalid-feedback">
                  <?= $validation->getError('stok'); ?>
                </div>
              </div>
            </div>
            <div class="form-group row">
              <label for="supplier" class="col">Supplier</label>
              <div class="col-sm-10">
                <select class="form-control <?= ($validation->hasError('supplier')) ? 'is-invalid' : ''; ?> select2" name="supplier">
                  <option selected disabled value="">Pilih Supllier</option>
                  <?php foreach ($supplier as $spl) :; ?>
                    <option value="<?= $spl['id_user']; ?>" <?= ($spl['id_user'] == old('supplier')) ? 'selected' : ''; ?>><?= $spl['username']; ?></option>
                  <?php endforeach; ?>
                </select>
                <div class="invalid-feedback">
                  <?= $validation->getError('supplier'); ?>
                </div>
              </div>
            </div>
            <div class="form-group row">
              <label for="deskripsi_produk" class="col">Deskripsi Produk</label>
              <div class="col-sm-10">
                <textarea style="height: 150px;" class="form-control  <?= ($validation->hasError('deskripsi_produk')) ? 'is-invalid' : ''; ?>" id="deskripsi_produk" rows="3" name="deskripsi_produk" placeholder="Deskripsi Produk"><?= old('deskripsi_produk'); ?></textarea>
                <div class="invalid-feedback">
                  <?= $validation->getError('deskripsi_produk'); ?>
                </div>
              </div>
            </div>
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