<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
  protected $table      = 'tbl_user';
  protected $primaryKey = 'id_user';
  protected $allowedFields = ['username', 'password', 'email', 'role'];

  public function getUser($id = false)
  {
    if ($id == false) {
      return $this->findAll();
    }
    return $this->find($id);
  }

  public function getSupplier()
  {
    return $this->query("SELECT * FROM v_supplier")->getResultArray();
  }

  public function cekLogin($username, $password)
  {
    return $this->where("(username = '$username' OR email = '$username') AND password = '$password'")->first();
  }
}
