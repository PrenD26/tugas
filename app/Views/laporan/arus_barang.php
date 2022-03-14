<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<section class="section">
  <div class="section-header">
    <h1>Laporan Arus Barang</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="/akun">Akun</a></div>
      <div class="breadcrumb-item">Laporan Arus Barang</div>
    </div>
  </div>

  <div class="section-body">

    <h2 class="my-3 text-center">Akun</h2>
    <div class="row">
      <?= $this->include('layout/menu_akun'); ?>
      <div class="col-sm-9">
        <div class="bg-white border rounded shadow-sm p-4 h-100">
          <div class="d-flex justify-content-between">
            <h4>Laporan Arus Barang</h4>
            <form action="" method="post">
              <div class="form-row">
                <div class="col-md-5">
                  <input type="date" class="form-control" placeholder="Dari Tanggal" name="tgl1">
                </div>
                <div class="col-md-5">
                  <input type="date" class="form-control" placeholder="Sampai Tanggal" name="tgl2">
                </div>
                <div class="col-md-2">
                  <button type="submit" class="btn btn-primary">Saring</button>
                </div>
              </div>
            </form>
          </div>
          <?php if (session()->getFLashdata('pesan')) : ?>
            <div class="alert alert-success mt-3" role="alert">
              <?= session()->getFLashdata('pesan'); ?>
            </div>
          <?php endif; ?>

          <hr class="my-4">
          <h5 class="mt-0">Barang Masuk</h5>
          <div class="table-responsive">
            <table class="table table-striped" id="table-1">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Nama Produk</th>
                  <th>Jumlah</th>
                  <th>Keterangan</th>
                  <th>Tanggal</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1;
                foreach ($barang as $b) : ?>
                  <?php if ($b['keterangan'] == 'masuk') :; ?>
                    <tr>
                      <th scope="row"><?= $i++; ?>.</th>
                      <td><?= $b['nama_produk']; ?></td>
                      <td><?= $b['qty']; ?></td>
                      <td><span class="badge badge-success"><?= $b['keterangan']; ?></span></td>
                      <td><?= $b['tgl_arus_barang']; ?></td>
                    </tr>
                  <?php endif; ?>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <h5 class="mt-4">Total Barang Masuk : <?= ($total['keterangan'] == 'masuk') ? $total['total_barang'] : '0'; ?> unit</h5>
          <hr class="my-4">
          <h5 class="mt-0">Barang Keluar</h5>
          <div class="table-responsive">
            <table class="table table-striped" id="table-2">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Nama Produk</th>
                  <th>Jumlah</th>
                  <th>Keterangan</th>
                  <th>Tanggal</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1;
                foreach ($barang as $b) : ?>
                  <?php if ($b['keterangan'] == 'keluar') :; ?>
                    <tr>
                      <th scope="row"><?= $i++; ?>.</th>
                      <td><?= $b['nama_produk']; ?></td>
                      <td><?= $b['qty']; ?></td>
                      <td><span class="badge badge-danger"><?= $b['keterangan']; ?></span></td>
                      <td><?= $b['tgl_arus_barang']; ?></td>
                    </tr>
                  <?php endif; ?>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <h5 class="mt-4">Total Barang Keluar : <?= ($total['keterangan'] == 'keluar') ? $total['total_barang'] : '0'; ?> unit</h5>
        </div>
      </div>
    </div>
  </div>
</section>

<?= $this->endSection(); ?>