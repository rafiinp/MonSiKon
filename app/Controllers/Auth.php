<?php


namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;

class Auth extends BaseController
{

    public function index()
    {
        return redirect()->to(site_url('login'));
    }

    public function login()
    {
        if (session('id_user')) {
            return redirect()->to(site_url('home'));
        }
        return view('auth/login');
    
    }

    public function loginProcess()
{
    $post = $this->request->getPost();
    $query = $this->db->table('user')->getWhere(['email_user' => $post['email_user']]);
    $user = $query->getRow();

    if ($user) {
        // Verifikasi password
        if (password_verify($post['password_user'], $user->password_user)) {
            // Set session berdasarkan data user
            $params = [
                'id_user' => $user->id_user,
                'role' => $user->role, // Misalnya 'admin', 'super_admin', atau 'surveyor'
                'id_company' => $user->id_company // Tambahkan id_company ke session
            ];
            session()->set($params);

            // Cek role dan arahkan sesuai
            switch ($user->role) {
                case 'admin':
                case 'super_admin':
                    return redirect()->to(site_url('home')); // Untuk admin dan super_admin
                case 'surveyor':
                    return redirect()->to(site_url('surveyor/dashboard')); // Untuk surveyor
                default:
                    // Jika role tidak dikenali, logout dan beri pesan kesalahan
                    session()->remove('id_user');
                    return redirect()->to(site_url('login'))->with('error', 'Role tidak dikenali.');
            }
        } else {
            return redirect()->back()->with('error', 'Incorrect Password');
        }
    } else {
        return redirect()->back()->with('error', 'Email not Found');
    }
}

    

    public function home()
{
    // Cek apakah user sudah login
    if (!session('id_user')) {
        return redirect()->to(site_url('login'));
    }

    // Cek role user
    $role = session('role');
    if ($role == 'admin' || $role == 'super_admin') {
        return view('home');  // Halaman untuk admin dan super_admin
    } elseif ($role == 'surveyor') {
        return redirect()->to(site_url('surveyor/dashboard')); // Arahkan surveyor ke dashboard-nya
    } else {
        return redirect()->to(site_url('login')); // Jika tidak ada role yang cocok, logout dan arahkan ke login
    }
}

    

    public function logout()
    {
        session()->remove('id_user');
        return redirect()->to(site_url('login'));
    }
    
}
