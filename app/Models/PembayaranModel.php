<?php namespace App\Models;

use CodeIgniter\Model;

class PembayaranModel extends Model
{
  protected $table      = 'tbl_pembayaran';
  protected $primaryKey = 'id_pembayaran';
  protected $allowedFields = ['id_pesanan', 'total_harga','tgl_pembayaran'];

  public function getPembayaran($id=false){
    if($id==false){
      return $this->findAll();
    }
    return $this->find($id)->first();
  }

  public function bayarProduk($idPesanan,$totalHarga,$tglPembayaran){
    return $this->query("CALL bayarProduk($idPesanan,$totalHarga,'$tglPembayaran')");
  }

  public function getPenjualan(){
    return $this->query("SELECT * FROM tbl_pembayaran JOIN tbl_pesanan USING(id_pesanan) JOIN tbl_produk USING(id_produk) WHERE MONTH(tgl_pembayaran) = MONTH(NOW())")->getResultArray();
  }

  public function totalPendapatan(){
    return $this->query("SELECT SUM(total_harga) AS pendapatan FROM tbl_pembayaran WHERE MONTH(tgl_pembayaran) = MONTH(NOW())")->getRowArray();
  }

  public function search($tgl1,$tgl2){
    return $this->query("SELECT * FROM tbl_pembayaran JOIN tbl_pesanan USING(id_pesanan) JOIN tbl_produk USING(id_produk) WHERE tgl_pembayaran BETWEEN '$tgl1 00:00:00' AND '$tgl2 23:59:59'")->getResultArray();
  }

  public function totalPendapatanSearch($tgl1,$tgl2){
    return $this->query("SELECT SUM(total_harga) AS pendapatan FROM tbl_pembayaran WHERE tgl_pembayaran BETWEEN '$tgl1 00:00:00' AND '$tgl2 23:59:59'")->getRowArray();
  }

}