<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<section class="section">
  <div class="section-header">
    <h1>Update Produk <?= $produk['id_produk'] ?></h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="/akun">Akun</a></div>
      <div class="breadcrumb-item"><a href="/akun/produk">Produk</a></div>
      <div class="breadcrumb-item">Update Produk <?= $produk['id_produk'] ?></div>
    </div>
  </div>

  <div class="section-body">

    <h2 class="my-3 text-center">Akun</h2>
    <div class="row">
      <?= $this->include('layout/menu_akun'); ?>
      <div class="col-sm-9">
        <div class="bg-white border rounded shadow-sm p-4 h-100">
          <h4>Update Produk</h4>
          <?php if (session()->getFLashdata('error')) : ?>
            <div class="alert alert-danger" role="alert">
              <?= session()->getFLashdata('error'); ?>
            </div>
          <?php endif; ?>
          <form action="<?= base_url(); ?>/akun/produk_edit_act" method="post">
            <?= csrf_field(); ?>
            <div class="form-group row mt-3">
              <label for="nama_produk" class="col-sm-2 col-form-label">Nama Produk</label>
              <div class="col-sm-10">
                <input type="text" class="form-control <?= ($validation->hasError('nama_produk')) ? 'is-invalid' : ''; ?>" id="nama_produk" name="nama_produk" value="<?= (old('nama_produk')) ? old('nama_produk') : $produk['nama_produk']; ?>" autofocus>
                <div class="invalid-feedback">
                  <?= $validation->getError('nama_produk'); ?>
                </div>
              </div>
            </div>
            <div class="form-group row">
              <label for="harga_produk" class="col-sm-2 col-form-label">Harga Produk</label>
              <div class="col-sm-10">
                <input type="number" class="form-control <?= ($validation->hasError('harga_produk')) ? 'is-invalid' : ''; ?>" id="harga_produk" name="harga_produk" value="<?= (old('harga_produk')) ? old('harga_produk') : $produk['harga_produk']; ?>">
                <div class="invalid-feedback">
                  <?= $validation->getError('harga_produk'); ?>
                </div>
              </div>
            </div>
            <div class="form-group row">
              <label for="stok" class="col-sm-2 col-form-label">Stok Produk</label>
              <div class="col-sm-10">
                <input type="number" class="form-control <?= ($validation->hasError('stok')) ? 'is-invalid' : ''; ?>" id="stok" name="stok" value="<?= (old('stok')) ? old('stok') : $produk['stok']; ?>">
                <div class="invalid-feedback">
                  <?= $validation->getError('stok'); ?>
                </div>
              </div>
            </div>
            <div class="form-group row">
              <label for="supplier" class="col-sm-2 col-form-label">Supplier</label>
              <div class="col-sm-10">
                <select class="select2 form-control <?= ($validation->hasError('supplier')) ? 'is-invalid' : ''; ?>" name="supplier">
                  <?php foreach ($supplier as $spl) :; ?>
                    <option value="<?= (old('supplier')) ? old('supplier') : $spl['id_user']; ?>" <?= ($spl['id_user'] == $produk['id_supplier']) ? 'selected' : ''; ?>><?= $spl['username']; ?></option>
                  <?php endforeach; ?>
                </select>
                <div class="invalid-feedback">
                  <?= $validation->getError('supplier'); ?>
                </div>
              </div>
            </div>
            <div class="form-group row">
              <label for="deskripsi_produk" class="col-sm-2 col-form-label">Deskripsi Produk</label>
              <div class="col-sm-10">
                <textarea style="height: 150px;" class="form-control <?= ($validation->hasError('deskripsi_produk')) ? 'is-invalid' : ''; ?>" id="deskripsi_produk" rows="3" name="deskripsi_produk"><?= (old('deskripsi_produk')) ? old('deskripsi_produk') : $produk['deskripsi_produk']; ?></textarea>
                <div class="invalid-feedback">
                  <?= $validation->getError('deskripsi_produk'); ?>
                </div>
              </div>
            </div>
            <input type="hidden" id="id_produk" name="id_produk" value="<?= $produk['id_produk']; ?>">
            <div class="form-group row">
              <div class="col">
                <div class="text-right">
                  <button type="submit" class="btn btn-primary">Simpan</button>
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