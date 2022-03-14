<?php namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
  protected $table      = 'tbl_arus_barang';
  protected $primaryKey = 'id_arus_barang';
  protected $allowedFields = ['id_produk', 'qty','keterangan','tgl_arus_barang'];

  public function getBarang(){
    return $this->query("SELECT * FROM tbl_arus_barang JOIN tbl_produk USING(id_produk) WHERE MONTH(tgl_arus_barang) = MONTH(NOW())")->getResultArray();
  }

  public function totalBarang(){
    return $this->query("SELECT SUM(qty) AS total_barang, keterangan FROM tbl_arus_barang JOIN tbl_produk USING(id_produk) WHERE MONTH(tgl_arus_barang) = MONTH(NOW()) GROUP BY keterangan")->getRowArray();
  }

  public function search($tgl1,$tgl2){
    return $this->query("SELECT * FROM tbl_arus_barang JOIN tbl_produk USING(id_produk) WHERE tgl_arus_barang BETWEEN '$tgl1 00:00:00' AND '$tgl2 23:59:59'")->getResultArray();
  }

  public function totalBarangSearch($tgl1,$tgl2){
    return $this->query("SELECT SUM(qty) AS total_barang, keterangan FROM tbl_arus_barang JOIN tbl_produk USING(id_produk) WHERE tgl_arus_barang BETWEEN '$tgl1 00:00:00' AND '$tgl2 23:59:59' GROUP BY keterangan")->getRowArray();
  }

}