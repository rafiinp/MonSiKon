<?php

namespace App\Controllers\Auth;

use Firebase\JWT\JWT;
use App\Models\CustomersModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourcePresenter;

class Login extends ResourcePresenter
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

    public function loginCustomers ()
    {
        $email_customer = $this->request->getVar('email_customer');
        $password_customer = $this->request->getVar('password_customer');

        $customersModel = new CustomersModel;

        $customers = $customersModel->where('email_customer', $email_customer)->first();

        if(!$customers) {
            return $this->respond(['status' => false, 'message' => 'Username atau password salah'], 401);
        }

        if(!password_verify($password_customer, $customers->password_customer)) {
            return $this->respond(['status' => false, 'message' => 'Username atau password salah'], 401);
        }

        $key = getenv("JWT_SECRET");

        $iat = time();
        $exp = $iat + (10*60*60);  //10*60*60 untuk mengatur timer (jam*menit*detik)

        $payload = [
            'iss' => 'teanology_be',
            'sub' => 'logintoken',
            'iat' => $iat,
            'exp' => $exp,
            'email_customer' => $email_customer
        ];

        $token = JWT::encode($payload, $key, "HS256");

        return $this->respond(['status' => true, 'token' => $token], 200);
    }
}
