<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\ProdukModel;
use App\Models\PesananModel;
use App\Models\PembayaranModel;

class Akun extends BaseController
{
  protected $userModel;
  protected $produkModel;
  protected $pesananModel;
  protected $pembayaranModel;
  public function __construct()
  {
    $this->userModel = new UserModel();
    $this->produkModel = new ProdukModel();
    $this->pesananModel = new PesananModel();
    $this->pembayaranModel = new PembayaranModel();
  }

  public function index()
  {
    $data = [
      'user' => $this->userModel->getUser(session()->get('id_user'))
    ];
    if (session('username') == null) {
      return redirect()->to('Login');
    }
    return view('akun/profile', $data);
  }

  public function produk()
  {
    $data = [
      'produk' => $this->produkModel->getProduk()
    ];
    if (session('username') == null) {
      return redirect()->to('/login');
    }
    if (session('role') == 'pembeli') {
      return redirect()->to('/');
    }
    return view('akun/produk', $data);
  }

  public function produk_detail($id)
  {
    $data = [
      'produk' => $this->produkModel->getProduk($id)
    ];
    if (session('username') == null) {
      return redirect()->to('/login');
    }
    if (session('role') == 'pembeli') {
      return redirect()->to('/');
    }
    return view('akun/produk_detail', $data);
  }

  public function produk_tambah()
  {
    $data = [
      'supplier' => $this->userModel->getSupplier(),
      'validation' => \Config\Services::validation()
    ];
    if (session('username') == null) {
      return redirect()->to('/login');
    }
    return view('akun/produk_tambah', $data);
  }

  public function produk_tambah_act()
  {
    if (!$this->validate([
      'nama_produk' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'nama produk harus diisi!',
        ]
      ],
      'harga_produk' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'harga produk harus diisi!'
        ]
      ],
      'stok' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'stok harus diisi!'
        ]
      ],
      'supplier' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'supplier harus diisi!'
        ]
      ],
      'deskripsi_produk' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'deskripsi_produk harus diisi!'
        ]
      ],
    ])) {
      $validation = \Config\Services::validation();
      return redirect()->to('/akun/produk_tambah')->withInput()->with('validation', $validation);
    }

    $insert = $this->produkModel->save([
      'nama_produk' => $this->request->getVar('nama_produk'),
      'harga_produk' => $this->request->getVar('harga_produk'),
      'stok' => $this->request->getVar('stok'),
      'deskripsi_produk' => $this->request->getVar('deskripsi_produk'),
      'id_supplier' => $this->request->getVar('supplier')
    ]);

    if ($insert == false) {
      session()->setFlashData('error', 'Tambah produk gagal!');
      return redirect()->to('/akun/produk_tambah')->withInput();
    }

    session()->setFlashData('pesan', 'Produk Berhasil di Tambah!');
    return redirect()->to('/akun/produk');
  }

  public function produk_edit($id)
  {
    $data = [
      'produk' => $this->produkModel->getProduk($id),
      'supplier' => $this->userModel->getSupplier(),
      'validation' => \Config\Services::validation()
    ];
    return view('akun/produk_edit', $data);
  }

  public function produk_edit_act()
  {
    $id = $this->request->getVar('id_produk');

    if (!$this->validate([
      'nama_produk' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'nama produk harus diisi!',
        ]
      ],
      'harga_produk' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'harga produk harus diisi!'
        ]
      ],
      'stok' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'stok harus diisi!'
        ]
      ],
      'supplier' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'supplier harus diisi!'
        ]
      ],
      'deskripsi_produk' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'deskripsi_produk harus diisi!'
        ]
      ],
    ])) {
      $validation = \Config\Services::validation();
      return redirect()->to('/akun/produk_edit/' . $id)->withInput()->with('validation', $validation);
    }

    $update = $this->produkModel->save([
      'id_produk' => $id,
      'nama_produk' => $this->request->getVar('nama_produk'),
      'harga_produk' => $this->request->getVar('harga_produk'),
      'stok' => $this->request->getVar('stok'),
      'deskripsi_produk' => $this->request->getVar('deskripsi_produk'),
      'id_supplier' => $this->request->getVar('supplier')
    ]);

    if ($update == false) {
      session()->setFlashData('error', 'Edit gagal!');
      return redirect()->to('/akun/produk_edit/' . $id)->withInput();
    }

    session()->setFlashData('pesan', 'Produk Berhasil di Edit!');
    return redirect()->to('/akun/produk');
  }

  public function produk_hapus($id)
  {
    $this->produkModel->delete($id);

    session()->setFlashData('pesan', 'Produk Berhasil di Hapus!');
    return redirect()->to('/akun/produk');
  }

  public function pesanan()
  {
    $data = [
      'pesanan' => $this->pesananModel->getPesanan()
    ];
    if (session('username') == null) {
      return redirect()->to('/login');
    }
    return view('akun/pesanan', $data);
  }

  public function pesanan_detail($id)
  {
    $data = [
      'pesanan' => $this->pesananModel->getPesanan($id)
    ];
    if (session('username') == null) {
      return redirect()->to('/login');
    }
    return view('akun/pesanan_detail', $data);
  }

  public function stok()
  {
    $data = [
      'produk' => $this->produkModel->getProduk()
    ];
    if (session('username') == null) {
      return redirect()->to('/login');
    }
    if (session('role') == 'pembeli') {
      return redirect()->to('/');
    }
    return view('akun/stok', $data);
  }

  public function stok_detail($id)
  {
    $data = [
      'produk' => $this->produkModel->getProduk($id)
    ];
    if (session('username') == null) {
      return redirect()->to('/login');
    }
    if (session('role') == 'pembeli') {
      return redirect()->to('/');
    }
    return view('akun/stok_detail', $data);
  }

  public function stok_update($id)
  {
    $data = [
      'produk' => $this->produkModel->getProduk($id),
      'validation' => \Config\Services::validation()
    ];
    return view('akun/stok_update', $data);
  }

  public function stok_update_act()
  {
    $id = $this->request->getVar('id_produk');

    if (!$this->validate([
      'stok' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'stok harus diisi!'
        ]
      ]
    ])) {
      $validation = \Config\Services::validation();
      return redirect()->to('/akun/stok_update/' . $id)->withInput()->with('validation', $validation);
    }

    $stok = $this->request->getVar('stok');

    $update = $this->produkModel->tambahStok($id, $stok);

    if ($update == false) {
      session()->setFlashData('error', 'Tambah stok gagal!');
      return redirect()->to('/akun/stok_update/' . $id)->withInput();
    }

    session()->setFlashData('pesan', 'Tambah Stok Berhasil!');
    return redirect()->to('/akun/stok');
  }
}
