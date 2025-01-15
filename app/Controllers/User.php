<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourcePresenter;
use App\Models\CompanyModel;

class User extends ResourcePresenter
{  
    protected $format = 'json';

    use ResponseTrait;

    protected $modelName = 'App\Models\UserModel';

    protected $UserModel;

    public function __construct()
    {
        $this->UserModel = new UserModel;
    }

    /**
     * Present a view of resource objects.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $keyword = $this->request->getGet('keyword');
        $role = session()->get('role');
        $companyId = session()->get('id_company');

        if ($role == 'super_admin') {
            $data = $this->UserModel->getPaginatedUser(50, $keyword);
        } elseif ($role == 'admin') {
            $data = $this->UserModel->getPaginatedUserByCompany(50, $keyword, $companyId);
        } else {
            return redirect()->to(site_url('dashboard'))->with('error', 'Unauthorized access');
        }

        return view('user/index', $data);
    }

    /**
     * Present a view to present a new single resource object.
     *
     * @return ResponseInterface
     */
    public function new()
    {
        $role = session()->get('role');
        $companyId = session()->get('id_company');

        if ($role == 'super_admin') {
            $companyModel = new CompanyModel();
            $data['companies'] = $companyModel->findAll();
        } elseif ($role == 'admin') {
            $companyModel = new CompanyModel();
            $data['companies'] = $companyModel->where('id_company', $companyId)->findAll();
        } else {
            return redirect()->to(site_url('dashboard'))->with('error', 'Unauthorized access');
        }

        return view('user/new', $data);
    }

    /**
     * Process the creation/insertion of a new resource object.
     * This should be a POST.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        $photo = $this->request->getFile('photo_user');

        if ($photo !== null && $photo->isValid() && !$photo->hasMoved()) {
            $uploadPath = FCPATH . 'upload_user';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            $photoName = time() . '_' . $photo->getClientName();
            $photo->move($uploadPath, $photoName);

            $userData = [
                'photo_user' => $photoName,
                'name_user' => $this->request->getVar('name_user'),
                'email_user' => $this->request->getVar('email_user'),
                'password_user' => password_hash($this->request->getVar('password_user'), PASSWORD_BCRYPT),
                'role' => $this->request->getVar('role'),
                'id_company' => $this->request->getVar('company_id'),
            ];

            $this->UserModel->insert($userData);

            return redirect()->to(base_url('user'))->with('success', 'Data Berhasil Disimpan');
        } else {
            return redirect()->back()->withInput()->with('error', 'Failed to upload photo.');
        }
    }

    /**
     * Present a view to edit the properties of a specific resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($id = null)
    {
        $user = $this->UserModel->where('id_user', $id)->first();
        if (is_object($user)) {
            $companyModel = new \App\Models\CompanyModel();
            $companies = $companyModel->findAll();
    
            $data['user'] = $user;  // Changed from 'admin' to 'user'
            $data['companies'] = $companies;
    
            return view('user/edit', $data);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    /**
     * Process the updating, full or partial, of a specific resource object.
     * This should be a POST.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        $photo = $this->request->getFile('photo_user');
        $user = $this->UserModel->find($id);

        if ($photo !== null && $photo->isValid() && !$photo->hasMoved()) {
            $uploadPath = FCPATH . 'upload_user';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            $photoName = time() . '_' . $photo->getClientName();
            $photo->move($uploadPath, $photoName);

            $data = [
                'name_user' => $this->request->getVar('name_user'),
                'email_user' => $this->request->getVar('email_user'),
                'password_user' => password_hash($this->request->getVar('password_user'), PASSWORD_BCRYPT),
                'role' => $this->request->getVar('role'),
                'photo_user' => $photoName,
            ];

            $this->UserModel->update($id, $data);

            return redirect()->to(site_url('user'))->with('success', 'Data Berhasil Diupdate');
        } else {
            $data = [
                'name_user' => $this->request->getVar('name_user'),
                'email_user' => $this->request->getVar('email_user'),
                'password_user' => password_hash($this->request->getVar('password_user'), PASSWORD_BCRYPT),
                'role' => $this->request->getVar('role'),
            ];

            $this->UserModel->update($id, $data);

            return redirect()->to(site_url('user'))->with('success', 'Data Berhasil Diupdate');
        }
    }

    /**
     * Process the deletion of a specific resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
        $user = $this->UserModel->find($id);

        if (!$user) {
            return redirect()->to(site_url('user'))->with('error', 'Admin not found');
        }

        $photoName = $user->photo_user;
        $this->UserModel->delete($id);

        $uploadPath = FCPATH . 'upload_user/' . $photoName;
        if (file_exists($uploadPath)) {
            unlink($uploadPath);
        }

        return redirect()->to(site_url('user'))->with('success', 'Data berhasil dihapus');
    }
}
