<?php

namespace App\Controllers;

use App\Models\ProdukModel;

class Beranda extends BaseController
{
  protected $produkModel;
  public function __construct()
  {
    $this->produkModel = new ProdukModel();
  }

  public function index()
  {

    $keyword = $this->request->getVar('keyword');

    if ($keyword) {
      $produk = $this->produkModel->search($keyword)->findAll();
    } else {
      $produk = $this->produkModel->getProduk();
    }

    $data = [
      'produk' => $produk,
      'keyword' => $keyword
    ];

    return view('beranda/list_produk', $data);
  }

  public function produk($id)
  {
    $data = [
      'produk' => $this->produkModel->getProduk($id)
    ];

    return view('beranda/list_produk_detail', $data);
  }
}
