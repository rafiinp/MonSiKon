<?php

namespace App\Controllers;

use App\Models\InspectionModel;

class AdminController extends BaseController
{
    // Menampilkan halaman jadwal inspeksi
    public function scheduleView()
    {
        $inspectionModel = new InspectionModel();
        $data['inspections'] = $inspectionModel->findAll();

        return view('admin/schedule', $data);
    }

    // Membuat jadwal inspeksi baru
    public function createSchedule()
    {
        $inspectionModel = new InspectionModel();

        $data = [
            'container_id'   => $this->request->getPost('container_id'),
            'surveyor_id'    => $this->request->getPost('surveyor_id'),
            'scheduled_date' => $this->request->getPost('scheduled_date'),
            'status'         => 'pending',
        ];

        $inspectionModel->insert($data);

        return redirect()->to('/admin/schedule')->with('success', 'Inspection scheduled successfully.');
    }
}
