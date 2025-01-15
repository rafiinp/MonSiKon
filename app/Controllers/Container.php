<?php

namespace App\Controllers;

use App\Models\ContainerModel;
use CodeIgniter\RESTful\ResourceController;

class Container extends ResourceController
{
    protected $modelName = 'App\Models\ContainerModel';
    protected $format = 'json';

    public function index()
    {
        $keyword = $this->request->getGet('keyword');
        $data = $this->model->getPaginatedContainers(10, $keyword);
        return view('container/index', $data);
    }

    public function new()
    {
        return view('container/new');
    }

    public function create()
{
    $data = [
        'container_number' => $this->request->getPost('container_number'),
        'type' => $this->request->getPost('type'),
        'capacity' => $this->request->getPost('capacity'),
        'status' => $this->request->getPost('status')
    ];

    if ($this->model->insert($data)) {
        return redirect()->to(site_url('container'))->with('success', 'Container added successfully');
    }
    return redirect()->back()->withInput()->with('errors', $this->model->errors());
}


public function edit($id = null)
{
    $container = $this->model->find($id);
    if (!$container) {
        return redirect()->to(site_url('container'))->with('errors', 'Container not found.');
    }
    return view('container/edit', ['container' => $container]);
}


    public function update($id = null)
    {
        $data = [
            'container_number' => $this->request->getPost('container_number'),
            'type' => $this->request->getPost('type'),
            'capacity' => $this->request->getPost('capacity'),
            'status' => $this->request->getPost('status')
        ];

        if ($this->model->update($id, $data)) {
            return redirect()->to('container')->with('success', 'Container updated successfully');
        }
        return redirect()->back()->withInput()->with('errors', $this->model->errors());
    }

    public function delete($id = null)
{
    // Cek jika ID tidak ada
    if (!$id || !$this->model->find($id)) {
        return redirect()->to(site_url('container'))->with('errors', 'Container not found.');
    }

    // Cek apakah penghapusan berhasil
    if ($this->model->delete($id)) {
        return redirect()->to(site_url('container'))->with('success', 'Container deleted successfully');
    } else {
        return redirect()->to(site_url('container'))->with('errors', 'Failed to delete container');
    }
}

}