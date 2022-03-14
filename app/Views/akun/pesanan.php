<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<section class="section">
  <div class="section-header">
    <h1>Pesanan</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="/akun">Akun</a></div>
      <div class="breadcrumb-item">Pesanan</div>
    </div>
  </div>

  <div class="section-body">
    <h2 class="my-3 text-center">Akun</h2>
    <div class="row">
      <?= $this->include('layout/menu_akun'); ?>
      <div class="col-sm-9">
        <div class="bg-white border rounded shadow-sm p-4 h-100">
          <div class="d-flex justify-content-between">
            <h4>Pesanan</h4>
          </div>
          <div class="table-responsive">
            <table class="table table-striped" id="table-1">
              <thead>
                <tr class="text-center">
                  <th scope="col">No.</th>
                  <th scope="col">Nama Produk</th>
                  <th scope="col">Pembeli</th>
                  <th scope="col">Status</th>
                  <th scope="col">Tanggal Pemesanan</th>
                  <th scope="col">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php if (session('role') == 'admin') : ?>
                  <?php $i = 1;
                  foreach ($pesanan as $p) : ?>
                    <tr class="text-center">
                      <th scope="row"><?= $i++; ?>.</th>
                      <td><?= $p['nama_produk']; ?></td>
                      <td><?= $p['username']; ?></td>
                      <td><?= ($p['id_pembayaran']) ? '<span class="badge badge-success">Dibayar</span>' : '<span class="badge badge-danger">Belum Dibayar</span>'; ?></td>
                      <td><?= $p['tgl_pesanan']; ?></td>
                      <td><a href="<?= base_url(); ?>/akun/pesanan_detail/<?= $p['id_pesanan']; ?>" class="btn btn-primary btn-sm">Detail</a></td>
                    </tr>
                  <?php endforeach; ?>
                <?php else :; ?>
                  <?php $i = 1;
                  foreach ($pesanan as $p) : ?>
                    <?php if ($p['username'] == session('username')) :; ?>
                      <tr class="text-center">
                        <th scope="row"><?= $i++; ?>.</th>
                        <td><?= $p['nama_produk']; ?></td>
                        <td><?= $p['username']; ?></td>
                        <td><?= ($p['id_pembayaran']) ? '<span class="badge badge-success">Dibayar</span>' : '<span class="badge badge-danger">Belum Dibayar</span>'; ?></td>
                        <td><?= $p['tgl_pesanan']; ?></td>
                        <td><a href="<?= base_url(); ?>/akun/pesanan_detail/<?= $p['id_pesanan']; ?>" class="btn btn-primary btn-sm">Detail</a></td>
                      </tr>
                    <?php endif; ?>
                  <?php endforeach; ?>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?= $this->endSection(); ?>