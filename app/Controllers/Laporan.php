<?php

namespace App\Controllers;

use App\Models\ProdukModel;
use App\Models\PembayaranModel;
use App\Models\BarangModel;

class Laporan extends BaseController
{
  protected $produkModel;
  protected $pesananModel;
  protected $pembayaranModel;
  protected $barangModel;
  public function __construct()
  {
    $this->produkModel = new ProdukModel();
    $this->pembayaranModel = new PembayaranModel();
    $this->barangModel = new BarangModel();
  }

  public function index($id)
  {
    $data = [
      'produk' => $this->produkModel->getProduk($id),
      'validation' => \Config\Services::validation()
    ];
    if (session('username') == null) {
      return redirect()->to('/login');
    }
    return view('pesanan/pesan', $data);
  }

  public function barang()
  {
    $tgl1 = $this->request->getVar('tgl1');
    $tgl2 = $this->request->getVar('tgl2');

    if ($tgl1 && $tgl2) {
      session()->setFlashData('pesan', 'Laporan dari tanggal ' . $tgl1 . ' sampai ' . $tgl2);
      $barang = $this->barangModel->search($tgl1, $tgl2);
      $total = $this->barangModel->totalBarangSearch($tgl1, $tgl2);
    } else {
      $barang = $this->barangModel->getBarang();
      $total = $this->barangModel->totalBarang();
    }

    $data = [
      'barang' => $barang,
      'total' => $total
    ];
    if (session('username') == null) {
      return redirect()->to('/login');
    }
    return view('laporan/arus_barang', $data);
  }

  public function penjualan()
  {
    $tgl1 = $this->request->getVar('tgl1');
    $tgl2 = $this->request->getVar('tgl2');

    if ($tgl1 && $tgl2) {
      session()->setFlashData('pesan', 'Laporan dari tanggal ' . $tgl1 . ' sampai ' . $tgl2);
      $penjualan = $this->pembayaranModel->search($tgl1, $tgl2);
      $pendapatan = $this->pembayaranModel->totalPendapatanSearch($tgl1, $tgl2);
    } else {
      $penjualan = $this->pembayaranModel->getPenjualan();
      $pendapatan = $this->pembayaranModel->totalPendapatan();
    }

    $data = [
      'penjualan' => $penjualan,
      'pendapatan' => $pendapatan
    ];
    if (session('username') == null) {
      return redirect()->to('/login');
    }
    return view('laporan/penjualan', $data);
  }

  public function produk_terlaris()
  {
    $tgl1 = $this->request->getVar('tgl1');
    $tgl2 = $this->request->getVar('tgl2');

    if ($tgl1 && $tgl2) {
      session()->setFlashData('pesan', 'Laporan dari tanggal ' . $tgl1 . ' sampai ' . $tgl2);
      $produk = $this->produkModel->searchPeringkat($tgl1, $tgl2);
      $unit = $this->produkModel->totalUnitSearch($tgl1, $tgl2);
    } else {
      $produk = $this->produkModel->getPeringkat();
      $unit = $this->produkModel->totalUnit();
    }

    $data = [
      'produk' => $produk,
      'unit' => $unit
    ];
    if (session('username') == null) {
      return redirect()->to('/login');
    }
    return view('laporan/produk_terlaris', $data);
  }
}
