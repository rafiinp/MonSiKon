<?php

namespace App\Controllers;

use App\Models\InspectionModel;

class SurveyorController extends BaseController
{
    // Menampilkan daftar inspeksi yang dijadwalkan untuk surveyor
    public function inspectionsView()
    {
        $inspectionModel = new InspectionModel();
        $inspections = $inspectionModel->where('surveyor_id', session('id_user'))->findAll();

        return view('surveyor/inspections', ['inspections' => $inspections]);
    }

    // Memasukkan hasil inspeksi
    public function inspect()
    {
        $inspectionModel = new InspectionModel();
        $inspectionId = $this->request->getPost('inspection_id');
        
        $data = [
            'result' => $this->request->getPost('result'),
            'status' => 'completed',
        ];

        $inspectionModel->update($inspectionId, $data);

        return redirect()->to('/surveyor/inspections')->with('success', 'Inspection completed successfully.');
    }

    public function inspections()
{
    $id_user = session()->get('id_user');
    $role = session()->get('role');

    if ($role !== 'surveyor') {
        return redirect()->to('/')->with('error', 'Unauthorized access.');
    }

    $inspections = $this->inspectionModel->where('id_surveyor', $id_user)->findAll();
    return view('surveyor/inspections', ['inspections' => $inspections]);
}

}
