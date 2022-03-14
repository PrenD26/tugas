<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<section class="section">
  <div class="section-header">
    <h1>Laporan Penjualan</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="/akun">Akun</a></div>
      <div class="breadcrumb-item">Laporan Penjualan</div>
    </div>
  </div>

  <div class="section-body">

    <h2 class="my-3 text-center">Akun</h2>
    <div class="row">
      <?= $this->include('layout/menu_akun'); ?>
      <div class="col-sm-9">
        <div class="bg-white border rounded shadow-sm p-4 h-100">
          <div class="d-flex justify-content-between">
            <h4>Laporan Penjualan</h4>
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
          <div class="table-responsive">
            <table class="table table-striped" id="table-1">
              <thead>
                <tr>
                  <th scope="col">No.</th>
                  <th scope="col">Nama Produk</th>
                  <th scope="col">Jumlah</th>
                  <th scope="col">Harga</th>
                  <th scope="col">Tanggal</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1;
                foreach ($penjualan as $p) : ?>
                  <tr>
                    <th scope="row"><?= $i++; ?>.</th>
                    <td><?= $p['nama_produk']; ?></td>
                    <td><?= $p['qty']; ?></td>
                    <td>Rp <?= number_format($p['total_harga'], 0, ',', '.'); ?></td>
                    <td><?= $p['tgl_pembayaran']; ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <h5 class="mt-4">Total Pendapatan : Rp <?= number_format($pendapatan['pendapatan'], 0, ',', '.'); ?></h5>
        </div>
      </div>
    </div>
  </div>
</section>

<?= $this->endSection(); ?>