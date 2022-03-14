<?php namespace App\Models;

use CodeIgniter\Model;

class PesananModel extends Model
{
  protected $table      = 'tbl_pesanan';
  protected $primaryKey = 'id_pesanan';
  protected $allowedFields = ['id_produk', 'id_pembeli', 'qty','tgl_pesanan','pesan'];

  public function getPesanan($id=false){
    if($id==false){
      return $this->query("CALL getPesanan()")->getResultArray();
    }
    return $this->query("CALL getDetailPesanan($id)")->getRowArray();
  }

  public function getLastId(){
    return $this->query("SELECT max(id_pesanan) AS id_pesanan FROM tbl_pesanan")->getRowArray();
  }

  public function pesanProduk($idProduk,$idPembeli,$qty,$tglPesanan,$pesan){
    return $this->query("CALL pesanProduk($idProduk,$idPembeli,$qty,'$tglPesanan','$pesan')");
  }

}