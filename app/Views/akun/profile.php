<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<section class="section">
  <div class="section-header">
    <h1>Profile</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="/akun">Akun</a></div>
      <div class="breadcrumb-item">Profile</div>
    </div>
  </div>

  <div class="section-body">
    <h2 class="my-3 text-center">Akun</h2>
    <div class="row">
      <?= $this->include('layout/menu_akun'); ?>
      <div class="col-sm-9">
        <div class="bg-white border rounded shadow-sm p-4 h-100">
          <h4>Profile</h4>
          <hr class="my-3">
          <div class="row">
            <div class="col-2">
              <p class="font-weight-normal mb-1">Username</p>
              <p class="font-weight-normal mb-1">Email</p>
              <p class="font-weight-normal mb-1">Role</p>
            </div>
            <div class="col-6">
              <p class="font-weight-bold mb-1">: <?= $user['username']; ?></p>
              <p class="font-weight-bold mb-1">: <?= $user['email']; ?></p>
              <p class="font-weight-bold mb-1">: <?= $user['role']; ?></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<?= $this->endSection(); ?>