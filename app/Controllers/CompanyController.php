<?php

namespace App\Controllers;

use App\Models\CompanyModel;
use CodeIgniter\Controller;

class CompanyController extends Controller
{
    protected $companyModel;

    public function __construct()
    {
        $this->companyModel = new CompanyModel();
    }

    // Display all companies
    public function index()
    {
        $data['companies'] = $this->companyModel->findAll();
        return view('companies/index', $data);
    }

    // Show create form
    public function create()
    {
        return view('companies/create');
    }

    // Store a new company
    public function store()
    {
        $validation = \Config\Services::validation();

        // Validate input
        if (!$this->validate([
            'name_company' => 'required|min_length[3]|max_length[255]',
        ])) {
            return redirect()->to('/company/create')->withInput()->with('errors', $validation->getErrors());
        }

        $this->companyModel->save([
            'name_company' => $this->request->getPost('name_company'),
        ]);

        return redirect()->to('/company')->with('success', 'Company added successfully!');
    }

    // Show edit form
    public function edit($id)
    {
        $data['company'] = $this->companyModel->find($id);
        return view('companies/edit', $data);
    }

    // Update company
    public function update($id)
    {
        $validation = \Config\Services::validation();

        // Validate input
        if (!$this->validate([
            'name_company' => 'required|min_length[3]|max_length[255]',
        ])) {
            return redirect()->to('/company/edit/' . $id)->withInput()->with('errors', $validation->getErrors());
        }

        $this->companyModel->update($id, [
            'name_company' => $this->request->getPost('name_company'),
        ]);

        return redirect()->to('/company')->with('success', 'Company updated successfully!');
    }

    // Delete company (soft delete)
    public function delete($id)
    {
        $this->companyModel->delete($id);
        return redirect()->to('/company')->with('success', 'Company deleted successfully!');
    }
}
