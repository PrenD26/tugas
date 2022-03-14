<?php

namespace App\Controllers;

use App\Models\UserModel;

class Login extends BaseController
{
  protected $userModel;
  public function __construct()
  {
    $this->userModel = new UserModel();
  }

  public function index()
  {
    $data = [
      'validation' => \Config\Services::validation()
    ];
    if (session('username')) {

      return redirect()->to('/');
    }
    return view('login/login', $data);
  }

  public function cek()
  {
    if (!$this->validate([
      'username' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'username atau email harus diisi!'
        ]
      ],
      'password' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'password harus diisi!'
        ]
      ]
    ])) {
      $validation = \Config\Services::validation();
      return redirect()->to('/login')->withInput()->with('validation', $validation);
    }

    $username = $this->request->getVar('username');
    $password = $this->request->getVar('password');
    $cek = $this->userModel->cekLogin($username, $password);

    if ($cek == null) {
      session()->setFlashData('error', 'username atau email atau password salah!');
      return redirect()->to('/login')->withInput();
    }

    session()->set('id_user', $cek['id_user']);
    session()->set('username', $cek['username']);
    session()->set('role', $cek['role']);

    return redirect()->to('/');
  }

  public function logout()
  {
    session()->destroy();
    return redirect()->to('/login');
  }

  public function register_pembeli()
  {
    $data = [
      'validation' => \Config\Services::validation()
    ];
    return view('login/register_pembeli', $data);
  }

  public function register_supplier()
  {
    $data = [
      'validation' => \Config\Services::validation()
    ];
    return view('login/register_supplier', $data);
  }

  public function register_cek_pembeli()
  {
    if (!$this->validate([
      'username' => [
        'rules' => 'required|is_unique[tbl_user.username]',
        'errors' => [
          'required' => 'username harus diisi!',
          'is_unique' => 'username sudah terpakai!'
        ]
      ],
      'email' => [
        'rules' => 'required|is_unique[tbl_user.email]|valid_email',
        'errors' => [
          'required' => 'email harus diisi!',
          'valid_email' => 'email tidak valid!',
          'is_unique' => 'email sudah terpakai!'
        ]
      ],
      'password1' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'password harus diisi!'
        ]
      ],
      'password2' => [
        'rules' => 'required|matches[password1]',
        'errors' => [
          'required' => 'password harus diisi!',
          'matches' => 'password tidak sesuai!'
        ]
      ]
    ])) {
      $validation = \Config\Services::validation();
      return redirect()->to('/login/register_pembeli')->withInput()->with('validation', $validation);
    }

    $username = $this->request->getVar('username');
    $email = $this->request->getVar('email');
    $password = $this->request->getVar('password1');
    $role = 'pembeli';

    $insert = $this->userModel->save([
      'username' => $username,
      'email' => $email,
      'password' => $password,
      'role' => $role
    ]);

    $cek = $this->userModel->cekLogin($username, $password);

    if ($insert == false) {
      session()->setFlashData('error', 'Register gagal!');
      return redirect()->to('/login/register_pembeli')->withInput();
    }

    session()->set('id_user', $cek['id_user']);
    session()->set('username', $cek['username']);
    session()->set('role', $cek['role']);

    return redirect()->to('/');
  }

  public function register_cek_supplier()
  {
    if (!$this->validate([
      'username' => [
        'rules' => 'required|is_unique[tbl_user.username]',
        'errors' => [
          'required' => 'username harus diisi!',
          'is_unique' => 'username sudah terpakai!'
        ]
      ],
      'email' => [
        'rules' => 'required|is_unique[tbl_user.email]|valid_email',
        'errors' => [
          'required' => 'email harus diisi!',
          'valid_email' => 'email tidak valid!',
          'is_unique' => 'email sudah terpakai!'
        ]
      ],
      'password1' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'password harus diisi!'
        ]
      ],
      'password2' => [
        'rules' => 'required|matches[password1]',
        'errors' => [
          'required' => 'password harus diisi!',
          'matches' => 'password tidak sesuai!'
        ]
      ]
    ])) {
      $validation = \Config\Services::validation();
      return redirect()->to('/login/register_supplier')->withInput()->with('validation', $validation);
    }

    $username = $this->request->getVar('username');
    $email = $this->request->getVar('email');
    $password = $this->request->getVar('password1');
    $role = 'supplier';

    $insert = $this->userModel->save([
      'username' => $username,
      'email' => $email,
      'password' => $password,
      'role' => $role
    ]);

    $cek = $this->userModel->cekLogin($username, $password);

    if ($insert == false) {
      session()->setFlashData('error', 'Register gagal!');
      return redirect()->to('/login/register_supplier')->withInput();
    }

    session()->set('id_user', $cek['id_user']);
    session()->set('username', $cek['username']);
    session()->set('role', $cek['role']);

    return redirect()->to('/');
  }
}
