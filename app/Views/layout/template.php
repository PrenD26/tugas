<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>TokoLaris &rsaquo; Frendy</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <!-- CSS Libraries -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= base_url('stisla/') ?>/assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url('stisla/') ?>/assets/css/components.css">
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                        <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                    </ul>
                </form>
                <div class="text-white mt-2" style="font-size: large;">
                    <?php if (session('username') == null) : ?> Belum Login <?php endif ?></p>
                    <?php if (session('username')) : ?>
                        <p>Level : <?= session('role') ?>
                        <?php endif ?></ </div>
            </nav>
            <div class="main-sidebar">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="index.html">Toko Laris</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="index.html">Tl</a>
                    </div>
                    <ul class="sidebar-menu">
                        <?php if (session('username') == null) : ?>
                            <li class=""><a class="nav-link" href="<?= base_url(); ?>"><i class="fas fa-box"></i> <span>Produk</span></a></li>
                            <li class=""><a class="nav-link" href="<?= base_url(); ?>/login"><i class="fas fa-user"></i> <span>Login</span></a></li>
                        <?php endif ?>
                        <?php if (session('username')) :; ?>
                            <li class="menu-header">Menu</li>
                            <li class=""><a class="nav-link" href="<?= base_url(); ?>"><i class="fas fa-box"></i> <span>Produk</span></a></li>
                            <li class=""><a class="nav-link" href="<?= base_url(); ?>/akun"><i class="fas fa-user"></i> <span>Akun</span></a></li>
                        <?php endif; ?>
                    </ul>

                </aside>
            </div>

            <!-- Main Content -->
            <div class="main-content">
                <?= $this->renderSection('content'); ?>
            </div>
            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; 2022 <div class="bullet"></div> Made By Stisla | My Github <a href="https://github.com/PrenD26/"> Frendy</a>
                </div>
                <div class="footer-right">
                    2.3.0
                </div>
            </footer>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="<?= base_url('stisla/') ?>/assets/js/stisla.js"></script>
    <!-- JS Libraies -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <!-- JS Libraies -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- Template JS File -->
    <script src="<?= base_url('stisla/') ?>/assets/js/scripts.js"></script>
    <script src="<?= base_url('stisla/') ?>/assets/js/custom.js"></script>
    <script>
        $("#table-1").dataTable({
            "columnDefs": [{
                "sortable": true,
            }]
        });
        $("#table-2").dataTable({
            "columnDefs": [{
                "sortable": true,
            }]
        });
    </script>
    <!-- Page Specific JS File -->
</body>

</html>