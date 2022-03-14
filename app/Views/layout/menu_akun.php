<div class="col-sm-3">
  <div class="bg-white border rounded shadow-sm py-4 pr-4 pl-3">
    <h5 class="ml-2">Hai, <?= (session('username')) ? session('username') : ''; ?></h5>
    <div class="list-group">
      <a href="<?= base_url(); ?>/akun" class="list-group-item list-group-item-action border-0 px-0 py-2"><span class="ml-2 h6 mb-0">Profile</span></a>
      <?php if (session('role') == 'admin') :; ?>
        <a href="<?= base_url(); ?>/akun/produk" class="list-group-item list-group-item-action border-0 px-0 py-2"><span class="ml-2 h6 mb-0">Produk</span></a>
        <a href="<?= base_url(); ?>/akun/pesanan" class="list-group-item list-group-item-action border-0 px-0 py-2"><span class="ml-2 h6 mb-0">Pesanan</span></a>
        <ul class="navbar-nav mr-auto list-group-item-action border-0 px-0">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle list-group-item list-group-item-action border-0 px-0 py-2" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="ml-2 h6 mb-0">Laporan</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="<?= base_url(); ?>/laporan/barang">Arus Barang</a>
              <a class="dropdown-item" href="<?= base_url(); ?>/laporan/penjualan">Penjualan</a>
              <!-- <a class="dropdown-item" href="<?= base_url(); ?>/laporan/produk_terlaris">Produk Terlaris</a> -->
            </div>
          </li>
        </ul>
      <?php elseif (session('role') == 'pembeli') :; ?>
        <a href="<?= base_url(); ?>/akun/pesanan" class="list-group-item list-group-item-action border-0 px-0 py-2"><span class="ml-2 h6 mb-0">Pesanan</span></a>
      <?php else :; ?>
        <a href="<?= base_url(); ?>/akun/stok" class="list-group-item list-group-item-action border-0 px-0 py-2"><span class="ml-2 h6 mb-0">Stok</span></a>
      <?php endif; ?>
      <a href="<?= base_url(); ?>/login/logout" class="list-group-item list-group-item-action border-0 px-0 py-2" onclick="return confirm('Apakah Anda Ingin Logout?')"><span class="ml-2 h6 mb-0">Logout</span></a>
    </div>
  </div>
</div>