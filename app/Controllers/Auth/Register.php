<?php

namespace App\Controllers\Auth;

use App\Models\CustomersModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourcePresenter;

class Register extends ResourcePresenter
{

    use ResponseTrait;

    /**
     * Present a view of resource objects.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        //
    }

    /**
     * Present a view to present a specific resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Present a view to present a new single resource object.
     *
     * @return ResponseInterface
     */
    public function new()
    {
        //
    }

    /**
     * Process the creation/insertion of a new resource object.
     * This should be a POST.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        //
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
        //
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
        //
    }

    /**
     * Present a view to confirm the deletion of a specific resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function remove($id = null)
    {
        //
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
        //
    }

    public function registerCustomer()
    {
        $rules = [
            'first_name_customer' => [
                'rules' => 'required'
            ],
            'last_name_customer' => [
                'rules' => 'required'
            ],
            'email_customer' => [
                'rules' => 'required|valid_email|is_unique[customers.email_customer]'
            ],
            'password_customer' => [
                'rules' => 'required|min_length[8]'
            ],
            'confirm_password_customer' => [
                'rules' => 'required|matches[password_customer]'
            ],
            'phone_customer' => [
                'rules' => 'required'
            ],
            'birthdate_customer' => [
                'rules' => 'required|valid_date'
            ]
        ];

        // Periksa apakah file diunggah sebelum menerapkan aturan validasi ukuran
        if ($this->request->getFile('photo_customer')) {
            $rules['photo_customer'] = [
                'rules' => 'max_size[photo_customer,2048]|is_image[photo_customer]'
            ];
        }

        if ($this->validate($rules)) {
            $customersModel = new CustomersModel;

            $customersData = [
                'first_name_customer' => $this->request->getVar('first_name_customer'),
                'last_name_customer' => $this->request->getVar('last_name_customer'),
                'email_customer' => $this->request->getVar('email_customer'),
                'password_customer' => password_hash($this->request->getVar('password_customer'), PASSWORD_BCRYPT),
                'phone_customer' => $this->request->getVar('phone_customer'),
                'birthdate_customer' => $this->request->getVar('birthdate_customer'),
                'role' => 'customer' // Tetapkan peran sebagai "customer"
            ];

            if ($photo = $this->request->getFile('photo_customer')) {
                $photo->move(ROOTPATH . 'public/upload_customer');
                $customersData['photo_customer'] = 'upload_customer/' . $photo->getName();
            } else {
                $customersData['photo_customer'] = null;
            }

            $customersModel->save($customersData);

            return $this->respond(['status' => true, 'message' => 'Register berhasil'], 200);
        } else {
            $response = [
                'status' => false,
                'errors' => $this->validator->getErrors(),
            ];

            return $this->respond($response, 422);
        }
    }
}
