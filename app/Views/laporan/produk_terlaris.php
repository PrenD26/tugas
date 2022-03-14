<?= $this->extend('layout/template');?>
<?= $this->section('content');?>

<h2 class="my-3 text-center">Akun</h2>
<div class="row">
  <?= $this->include('layout/menu_akun');?>
  <div class="col-sm-9">
    <div class="bg-white border rounded shadow-sm p-4 h-100">
      <div class="d-flex justify-content-between">
        <h4>Laporan Produk Terlaris</h4>
        <form action="" method="post">
          <div class="form-row">
            <div class="col-md-5">
              <input type="date" class="form-control" placeholder="Dari Tanggal" name="tgl1">
            </div>
            <div class="col-md-5">
              <input type="date" class="form-control" placeholder="Sampai Tanggal" name="tgl2">
            </div>
            <div class="col-md-2">
              <button type="submit" class="btn btn-success">Saring</button>
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
      <div class="table-responsive mt-2">
        <table class="table table-striped" id="tabel">
          <thead>
            <tr>
              <th scope="col">Peringkat</th>
              <th scope="col">Nama Produk</th>
              <th scope="col">Unit Terjual</th>
              <th scope="col">Total Pendapatan</th>
            </tr>
          </thead>
          <tbody>
            <?php $i=1; foreach ($produk as $p) : ?>
              <tr>
                <th scope="row"><?= $i;?></th>
                <td><?= $p['nama_produk']; ?></td>
                <td><?= $p['terjual']; ?> unit</td>
                <td>Rp <?= number_format($p['terjual_harga'],0,',','.'); ?></td>
              </tr>
            <?php $i++; endforeach; ?>
          </tbody>
        </table>
      </div>
      <h5 class="mt-4">Total Penjualan Unit : <?= $unit['total_unit'];?> unit</h5>
    </div>
  </div>
</div>

<?= $this->endSection();?>
