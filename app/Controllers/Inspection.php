<?php

namespace App\Controllers;

use App\Models\InspectionModel;
use App\Models\ContainerModel;
use App\Models\UserModel;
use CodeIgniter\RESTful\ResourcePresenter;
use CodeIgniter\HTTP\CURLRequest;
use TCPDF;

class Inspection extends ResourcePresenter
{
    protected $modelName = 'App\Models\InspectionModel';
    protected $helpers = ['form'];

    public function __construct()
    {
        $this->containerModel = new ContainerModel();
        $this->userModel = new UserModel();
        $this->inspectionModel = new InspectionModel();
         $this->curl = \Config\Services::curlrequest();
    }

    // List all inspections
    public function index()
    {
        $data['inspections'] = $this->model->getAllInspections();
        return view('inspection/admin/index', $data);
    }

    // Show the scheduling form
    public function show($id = null)
    {
        // Redirect to the schedule method for creating new inspection
        return $this->schedule();
    }

    // Render the scheduling form
    public function schedule()
{
    $data['containers'] = $this->containerModel->findAll();
    $data['user'] = $this->userModel->where('role', 'surveyor')->findAll(); // Change this line
    return view('inspection/admin/schedule', $data);
}

    

    // Process the creation of a new inspection schedule
    public function create()
    {
        $data = [
            'container_id' => $this->request->getPost('container_id'),
            'surveyor_id' => $this->request->getPost('surveyor_id'),
            'scheduled_date' => $this->request->getPost('scheduled_date'),
            'status' => 'pending'
        ];

        // Validate the data
        if ($this->model->insert($data)) {
            return redirect()->to('inspection')->with('success', 'Inspection scheduled successfully');
        }

        // If validation fails
        return redirect()->back()->withInput()->with('errors', $this->model->errors());
    }

    // Surveyor Dashboard
    public function surveyorDashboard()
    {
        $surveyor_id = session()->get('id_user');
        $data['inspections'] = $this->model->getScheduledInspections($surveyor_id);
        return view('inspection/surveyor/dashboard', $data);
    }

    // Perform Inspection
    public function perform($id = null)
{
    // Ensure $id is not null and is numeric
    if ($id === null || !is_numeric($id)) {
        return redirect()->back()->with('error', 'Invalid inspection ID');
    }

    // Find the inspection using find() method
    $inspection = $this->model->find($id);
    
    if (!$inspection) {
        return redirect()->back()->with('error', 'Inspection not found');
    }
    
    // Get container details safely using a query builder approach
    $container = (object) $this->containerModel->where('id_container', $inspection->container_id)->first();
    
    // Ensure container is found
    if (!$container) {
        return redirect()->back()->with('error', 'Container not found');
    }
    
    // Pass both inspection and container to the view
    return view('inspection/surveyor/perform', [
        'inspection' => $inspection,
        'container' => $container
    ]);
}

    // Submit Inspection
    public function update($id = null)
{
    // Initialize the main data array first
    $data = [
        'result' => $this->request->getPost('result'),
        'status' => 'completed',
        'inspection_date' => $this->request->getPost('inspection_date'),
        'arrival_time' => $this->request->getPost('arrival_time'),
        'departure_time' => $this->request->getPost('departure_time'),
        'inspection_time' => $this->request->getPost('inspection_time'),
        'seal_no' => $this->request->getPost('seal_no'),
        'buyer' => $this->request->getPost('buyer'),
        'po_number' => $this->request->getPost('po_number'),
        'inspector_name' => $this->request->getPost('inspector_name'),
        'witness_name' => $this->request->getPost('witness_name'),
        'inner_cleaned' => $this->request->getPost('inner_cleaned'),
        'outer_cleaned' => $this->request->getPost('outer_cleaned'),
        'inspector_signature_data' => $this->request->getPost('inspector_signature_data'),
        'witness_signature_data' => $this->request->getPost('witness_signature_data'),
    ];

    // Handle inspection photo
    $photo = $this->request->getFile('inspection_photo');
    if ($photo && $photo->isValid() && !$photo->hasMoved()) {
        $photoName = $photo->getRandomName();
        $photo->move(FCPATH . 'upload_result', $photoName);
        $data['inspection_photo'] = $photoName;
    }

    // Handle container code
    $containerCodeText = $this->request->getPost('container_code');
    if (!empty($containerCodeText)) {
        $data['container_code'] = $containerCodeText;
    }

    // Handle criteria fields
    $criteriaFields = [
        'undercarriage', 'inside_wall', 'right_door', 'left_door',
        'front_wall', 'ceiling', 'roof', 'floor_inside',
        'fifth_wheel', 'exterior_front', 'rear_bumper'
    ];

    foreach ($criteriaFields as $field) {
        // Handle result
        $result = $this->request->getPost($field . '_result');
        if (!empty($result)) {
            $data[$field . '_result'] = $result;
        }

        // Handle image
        $photo = $this->request->getFile($field . '_image');
        if ($photo && $photo->isValid() && !$photo->hasMoved()) {
            $newName = $photo->getRandomName();
            $photo->move(FCPATH . 'upload_criteria', $newName);
            $data[$field . '_image'] = $newName;
        }
    }

    // Remove validation check that might prevent update
    if ($this->model->update($id, $data)) {
        return redirect()->to('inspection')->with('success', 'Inspection completed successfully');
    }

    return redirect()->back()->withInput()->with('error', 'Failed to update inspection');
}

public function scan()
{
    $image = $this->request->getFile('image');
    if ($image && $image->isValid() && !$image->hasMoved()) {
        $filePath = $image->getTempName();

        try {
            // Menjalankan OCR menggunakan Tesseract
            $ocrOutput = shell_exec("tesseract $filePath stdout --psm 6 -c preserve_interword_spaces=1 2>&1");

            // Memfilter hasil OCR hanya untuk huruf, angka, titik, spasi baris, dan paragraf
            $containerCodeText = preg_replace('/[^\w.\s\n]/u', '', $ocrOutput);

            return $this->response->setJSON([
                'success' => true,
                'code' => trim($containerCodeText),
            ]);
        } catch (Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'OCR failed: ' . $e->getMessage(),
            ]);
        }
    }

    return $this->response->setJSON([
        'success' => false,
        'message' => 'Invalid image file.',
    ]);
}


public function inspectionsurveyorlist()
    {
        $data['inspections'] = $this->model->getAllInspections();
        return view('inspection/surveyor/inspection', $data);
    }

    public function exportPDF($id = null)
    {
        $inspection = $this->model->find($id);

        if (!$inspection) {
            return redirect()->back()->with('error', 'Inspection not found');
        }

        // Initialize TCPDF
        $pdf = new TCPDF();
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('MonSiKon');
        $pdf->SetTitle('Inspection Report');
        $pdf->SetSubject('Inspection Details');

        // Add a page
        $pdf->AddPage();

        // Set font
        $pdf->SetFont('helvetica', '', 10);

        // Add content
        $html = '<h1>Container 10 Points Security Inspection</h1>';
        $html .= '<table border="1" cellpadding="5">
                    <tr>
                        <td><b>Container/Truck No:</b></td>
                        <td>' . ($inspection->container_number ?? 'N/A') . '</td>
                        <td><b>Arrival Time:</b></td>
                        <td>' . ($inspection->arrival_time ?? 'N/A') . '</td>
                    </tr>
                    <tr>
                        <td><b>Container/Truck Size:</b></td>
                        <td>' . ($inspection->container_size ?? 'N/A') . '</td>
                        <td><b>Departure Time:</b></td>
                        <td>' . ($inspection->departure_time ?? 'N/A') . '</td>
                    </tr>
                    <tr>
                        <td><b>Date:</b></td>
                        <td>' . ($inspection->inspection_date ?? 'N/A') . '</td>
                        <td><b>Inspection Time:</b></td>
                        <td>' . ($inspection->inspection_time ?? 'N/A') . '</td>
                    </tr>
                    <tr>
                        <td><b>Seal No:</b></td>
                        <td>' . ($inspection->seal_no ?? 'N/A') . '</td>
                        <td><b>Buyer:</b></td>
                        <td>' . ($inspection->buyer ?? 'N/A') . '</td>
                    </tr>
                    <tr>
                        <td><b>PO Number:</b></td>
                        <td colspan="3">' . ($inspection->po_number ?? 'N/A') . '</td>
                    </tr>
                </table>';

        // Add inspection criteria
        $html .= '<h2>Inspection Criteria</h2>';
        $html .= '<table border="1" cellpadding="5">
                    <thead>
                        <tr>
                            <th>Criteria</th>
                            <th>Good</th>
                            <th>Damages</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                    <tbody>';

        foreach ([
            'undercarriage' => 'Outside Undercarriage',
            'inside_wall' => 'Inside Wall',
            'right_door' => 'Right Side Door',
            'left_door' => 'Left Side Door',
            'front_wall' => 'Front Wall',
            'ceiling' => 'Ceiling Roof',
            'roof' => 'Roof Inside',
            'floor_inside' => 'Floor Inside',
            'fifth_wheel' => 'Fifth Wheel Area',
            'exterior_front' => 'Exterior Front',
            'rear_bumper' => 'Rear Bumper'
        ] as $key => $label) {
            $html .= '<tr>
                        <td>' . $label . '</td>
                        <td>' . ($inspection->{$key . '_result'} === 'good' ? '✔' : '') . '</td>
                        <td>' . ($inspection->{$key . '_result'} === 'damaged' ? '✔' : '') . '</td>
                        <td>' . ($inspection->{$key . '_remarks'} ?? 'N/A') . '</td>
                    </tr>';
        }

        $html .= '</tbody></table>';

        // Add seal inspection criteria
        $html .= '<h2>Seal 4 Points Security Inspection</h2>';
        $html .= '<table border="1" cellpadding="5">
                    <thead>
                        <tr>
                            <th>Criteria</th>
                            <th>Good</th>
                            <th>Broken</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                    <tbody>';

        foreach ([
            'seal_mechanism' => 'Seal Mechanism Check',
            'seal_number' => 'Seal Number Check',
            'seal_attachment' => 'Seal Attachment',
            'seal_tightness' => 'Seal Tightness'
        ] as $key => $label) {
            $html .= '<tr>
                        <td>' . $label . '</td>
                        <td>' . ($inspection->{$key . '_result'} === 'good' ? '✔' : '') . '</td>
                        <td>' . ($inspection->{$key . '_result'} === 'broken' ? '✔' : '') . '</td>
                        <td>' . ($inspection->{$key . '_remarks'} ?? 'N/A') . '</td>
                    </tr>';
        }

        $html .= '</tbody></table>';

        // Write HTML to PDF
        $pdf->writeHTML($html, true, false, true, false, '');

        // Output PDF as download
        $pdf->Output('inspection_report_' . $id . '.pdf', 'D');
        exit;
    }

}
