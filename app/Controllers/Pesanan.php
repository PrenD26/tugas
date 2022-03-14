<?php namespace App\Controllers;

use App\Models\ProdukModel;
use App\Models\PesananModel;
use App\Models\PembayaranModel;

class Pesanan extends BaseController
{
  protected $produkModel;
  protected $pesananModel;
  protected $pembayaranModel;
  public function __construct(){
    $this->produkModel = new ProdukModel();
    $this->pesananModel = new PesananModel();
    $this->pembayaranModel = new PembayaranModel();
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
		return view('pesanan/pesan',$data);
  }
  
  public function pesan($id)
	{
		$data = [
      'produk' => $this->produkModel->getProduk($id),
      'validation' => \Config\Services::validation()
    ];
    if (session('username') == null) {
      return redirect()->to('/login');
    }
		return view('pesanan/pesan',$data);
	}
	
	public function pesan_act()
	{
    $id = $this->request->getVar('id_produk');

    if(!$this->validate([
      'qty' => [
        'rules' => 'required',
        'errors' =>[
          'required' => 'jumlah harus diisi!',
        ]
      ],
      'pesan' => [
        'rules' => 'required',
        'errors' =>[
          'required' => 'pesan harus diisi!'
        ]
      ]
    ])){
      $validation = \Config\Services::validation();
      return redirect()->to('/pesanan/pesan/'.$id)->withInput()->with('validation', $validation);
    }

    $id_pembeli = $this->request->getVar('id_pembeli');
    $qty = $this->request->getVar('qty');
    date_default_timezone_set('Asia/Jakarta');
    $tgl_pesanan = date('Y-m-d H:i:s');
    $pesan = $this->request->getVar('pesan');

    $insert = $this->pesananModel->pesanProduk($id,$id_pembeli,$qty,$tgl_pesanan,$pesan);

    if($insert==false){
      session()->setFlashData('error','Pesan produk gagal!');
      return redirect()->to('/pesanan/pesan/'.$id)->withInput();
    }
    $pesanan = $this->pesananModel->getLastId();
		return redirect()->to('/pesanan/pembayaran/'.$pesanan['id_pesanan']);
  }

  public function pembayaran($id){
    $data = [
      'pesanan' => $this->pesananModel->getPesanan($id),
      'validation' => \Config\Services::validation()
    ];
    if (session('username') == null) {
      return redirect()->to('/login');
    }
		return view('pesanan/bayar',$data);
  }

  public function pembayaran_act()
	{
    $id = $this->request->getVar('id_pesanan');

    if(!$this->validate([
      'total_harga' => [
        'rules' => 'required',
        'errors' =>[
          'required' => 'total harga harus diisi!',
        ]
      ]
    ])){
      $validation = \Config\Services::validation();
      return redirect()->to('/pesanan/pembayaran/'.$id)->withInput()->with('validation', $validation);
    }

    $total_harga = $this->request->getVar('total_harga'); 
    date_default_timezone_set('Asia/Jakarta');
    $tgl_pembayaran = date('Y-m-d H:i:s');

    $insert = $this->pembayaranModel->bayarProduk($id,$total_harga,$tgl_pembayaran);

    if($insert==false){
      session()->setFlashData('error','Pembayaran gagal!');
      return redirect()->to('/pesanan/pembayaran/'.$id)->withInput();
    }
    if (session('username') == null) {
      return redirect()->to('/login');
    }
		return redirect()->to('/akun/pesanan');
  }

}
