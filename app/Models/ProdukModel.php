<?php namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
  protected $table      = 'tbl_produk';
  protected $primaryKey = 'id_produk';
  protected $allowedFields = ['nama_produk', 'harga_produk', 'stok','deskripsi_produk','id_supplier'];

  public function getProduk($id=false){
    if($id==false){
      return $this->findAll();
    }
    return $this->query("CALL getDetailProduk('$id')")->getRowArray();
  }

  public function search($keyword){
    return $this->table('tbl_produk')->like('nama_produk', $keyword);
  }

  public function tambahStok($idProduk,$stok){
    return $this->query("CALL tambahStok($idProduk,$stok)");
  }

  public function getPeringkat(){
    return $this->query("SELECT *, SUM(qty) AS terjual , SUM(total_harga) AS terjual_harga FROM tbl_pembayaran JOIN tbl_pesanan USING(id_pesanan) JOIN tbl_produk USING(id_produk) WHERE MONTH(tgl_pembayaran) = MONTH(NOW()) GROUP BY id_produk ORDER BY terjual DESC")->getResultArray();
  }

  public function totalUnit(){
    return $this->query("SELECT SUM(qty) AS total_unit FROM tbl_pembayaran JOIN tbl_pesanan USING(id_pesanan) WHERE MONTH(tgl_pembayaran) = MONTH(NOW())")->getRowArray();
  }

  public function searchPeringkat($tgl1,$tgl2){
    return $this->query("SELECT *, SUM(qty) AS terjual , SUM(total_harga) AS terjual_harga FROM tbl_pembayaran JOIN tbl_pesanan USING(id_pesanan) JOIN tbl_produk USING(id_produk) WHERE tgl_pembayaran BETWEEN '$tgl1 00:00:00' AND '$tgl2 23:59:59' GROUP BY id_produk ORDER BY terjual DESC")->getResultArray();
  }

  public function totalUnitSearch($tgl1,$tgl2){
    return $this->query("SELECT SUM(total_harga) AS total_unit FROM tbl_pembayaran JOIN tbl_pesanan USING(id_pesanan) WHERE tgl_pembayaran BETWEEN '$tgl1 00:00:00' AND '$tgl2 23:59:59'")->getRowArray();
  }

}