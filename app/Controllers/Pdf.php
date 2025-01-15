<?php

namespace App\Controllers;

use App\Models\InspectionModel;
use App\Models\ContainerModel;

use TCPDF;
use CodeIgniter\Controller;

class Pdf extends Controller
{
    protected $inspectionModel;
    protected $containerModel;

    public function __construct()
    {
        $this->inspectionModel = new InspectionModel();
        $this->containerModel = new ContainerModel();
    }

    public function index()
    {
        $data['inspections'] = $this->inspectionModel->getAllInspections();
        $data['inspections'] = array_filter($data['inspections'], function($inspection) {
            return $inspection->status == 'completed';
        });
        return view('pdf/inspection_list', $data);
    }

    public function downloadPdf($id = null)
    {
        $pdf = new \TCPDF('P', 'mm', 'A4', true, 'UTF-8');
        
        $pdf->SetCreator('MonSiKon');
        $pdf->SetAuthor('MonSiKon System');
        $pdf->SetTitle('Container Security Inspection Report');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->AddPage();
        
        $inspection = $this->inspectionModel->select('inspections.*, containers.container_number, containers.capacity')
            ->join('containers', 'containers.id_container = inspections.container_id')
            ->find($id);
            
        if (empty($inspection)) {
            return redirect()->to('/pdf')->with('error', 'Inspection not found');
        }
    
        $html = '
        <h1 style="text-align: center; font-size: 16px;">CONTAINER 10 POINTS SECURITY INSPECTION</h1>
        <p style="text-align: center; font-size: 10px;">(Laporan Pemeriksaan Keamanan Kontainer)</p>
        
        <table cellpadding="3" style="border-collapse: collapse; line-height: 1.0; font-size: 10px;">
            <tr>
                <td width="30%">Container/Truck No<br>(No. Container/truk)</td>
                <td width="2%">:</td>
                <td width="28%">'.$inspection->container_number.'</td>
                <td width="20%">Arrival Time<br>(Jam Kedatangan)</td>
                <td width="2%">:</td>
                <td width="18%">'.$inspection->arrival_time.'</td>
            </tr>
            <tr>
                <td>Container/Truck Size<br>(Ukuran Kontainer/Truk)</td>
                <td>:</td>
                <td>'.$inspection->capacity.'</td>
                <td>Departure<br>(Jam Keberangkatan)</td>
                <td>:</td>
                <td>'.$inspection->departure_time.'</td>
            </tr>
            <tr>
                <td>Date</td>
                <td>:</td>
                <td>'.$inspection->inspection_date.'</td>
                <td>Inspection Time<br>(Jam Pengecekan)</td>
                <td>:</td>
                <td>'.$inspection->inspection_time.'</td>
            </tr>
            <tr>
                <td>Seal No</td>
                <td>:</td>
                <td>'.$inspection->seal_no.'</td>
                <td>PO Number/Nomor PO</td>
                <td>:</td>
                <td>'.$inspection->po_number.'</td>
            </tr>
            <tr>
                <td>Buyer</td>
                <td>:</td>
                <td colspan="4">'.$inspection->buyer.'</td>
            </tr>
        </table>
        <br>
        <br>
        <table border="1" cellpadding="" style="font-size: 7.5px; border-collapse: collapse;">
            <tr>
                <th style="text-align: center;" rowspan="2" width="10%">INSPECTION CRITERIA:</th>
                <th style="text-align: center;" rowspan="2" width="10%">GOOD<br>(Baik)</th>
                <th style="text-align: center;" colspan="7">Mark Clearly if any damage (beri tanda jika ada kerusakan)</th>
            </tr>
            <tr>
                <th style="text-align: center;">Rust<br>(karat)</th>
                <th style="text-align: center;">Bruise<br>(lecet)</th>
                <th style="text-align: center;">Hole<br>(lubang)</th>
                <th style="text-align: center;">Dent<br>(peyok)</th>
                <th style="text-align: center;">Broken<br>(rusak)</th>
                <th style="text-align: center;">Scratch<br>(tergores)</th>
                <th style="text-align: center;">Patched<br>(tambal)</th>
            </tr>';

        $criteria = [
            'undercarriage' => '1. Outside undercarriage (Bagian Luar)',
            'inside_wall' => '2. Inside/Outside Door (Pintu bagian dalam-luar)',
            'right_door' => '3. Right Side (Sisi Kanan)',
            'left_door' => '4. Left Side (Sisi Kiri)',
            'front_wall' => '5. Front Wall (Dinding depan)',
            'ceiling' => '6. Ceiling/Roof (Plafon/Atap Bagian atas)',
            'floor_inside' => '7. Floor-Inside (Lantai bagian dalam)',
            'fifth_wheel' => '8. Fifth wheel area (Bagian roda)',
            'exterior_front' => '9. Exterior front (Bagian Depan)',
            'rear_bumper' => '10. Rear bumper/door (Belakang Bumper/Pintu)'
        ];

        foreach ($criteria as $key => $label) {
            $result = isset($inspection->{$key.'_result'}) ? $inspection->{$key.'_result'} : '';
            $html .= '<tr>
                <td style="text-align: center;">'.$label.'</td>
                <td style="text-align: center;">'.($result == 'Good' ? 'v' : '').'</td>
                <td style="text-align: center;">'.($result == 'Rust' ? 'v' : '').'</td>
                <td style="text-align: center;">'.($result == 'Bruise' ? 'v' : '').'</td>
                <td style="text-align: center;">'.($result == 'Hole' ? 'v' : '').'</td>
                <td style="text-align: center;">'.($result == 'Dent' ? 'v' : '').'</td>
                <td style="text-align: center;">'.($result == 'Broken' ? 'v' : '').'</td>
                <td style="text-align: center;">'.($result == 'Scratch' ? 'v' : '').'</td>
                <td style="text-align: center;">'.($result == 'Patched' ? 'v' : '').'</td>
            </tr>';
        }

        $html .= '
            <tr>
                <td colspan="5">
                    * The inner container/truck is cleaned with a broom<br>
                    &nbsp;&nbsp;Kontainer/Truk bagian dalam dibersihkan dengan sapu
                </td>
                <td style="text-align: center;"> Yes/Ya</td>
                <td style="text-align: center;">'.($inspection->inner_cleaned == '1' ? 'v' : '').' </td>
                <td style="text-align: center;"> No/Tidak</td>
                <td style="text-align: center;">'.($inspection->inner_cleaned == '0' ? 'v' : '').'</td>
            </tr>
            <tr>
                <td colspan="5">
                    * The outer container/truck is cleaned by washing/spraying water<br>
                    &nbsp;&nbsp;Kontainer/truk bagian luar dibersihkan dengan dicuci/disemprotkan air
                </td>
                <td style="text-align: center;"> Yes/Ya</td>
                <td style="text-align: center;">'.($inspection->outer_cleaned == '1' ? 'v' : '').' </td>
                <td style="text-align: center;"> No/Tidak</td>
                <td style="text-align: center;">'.($inspection->outer_cleaned == '0' ? 'v' : '').'</td>
            </tr>
        </table>
        <br><br>
        <table style="width: 100%; font-size: 10px;">
        <tr>
            <td style="width: 50%; text-align: left;">
                Inspected by:<br>';
    
    // Add inspector signature if exists
    if (!empty($inspection->inspector_signature_data)) {
        $inspector_sig_path = $this->saveSignature(
            $inspection->inspector_signature_data,
            'inspector',
            $id
        );
        $html .= '<img src="' . FCPATH . $inspector_sig_path . '" width="150" height="75"><br>';
    } else {
        $html .= '<br>_________________<br>';
    }

    $html .= $inspection->inspector_name.'
        </td>
        <td style="width: 50%; text-align: right;">
            Witness by:<br>';

    if (!empty($inspection->witness_signature_data)) {
        $witness_sig_path = $this->saveSignature(
            $inspection->witness_signature_data,
            'witness',
            $id
        );
        $html .= '<img src="' . FCPATH . $witness_sig_path . '" width="150" height="75"><br>';
    } else {
        $html .= '<br>_________________<br>';
    }
    
    $html .= $inspection->witness_name.'
            </td>
        </tr>
    </table>';

    if (isset($inspector_sig_file) && file_exists($inspector_sig_file)) {
        unlink($inspector_sig_file);
    }
    if (isset($witness_sig_file) && file_exists($witness_sig_file)) {
        unlink($witness_sig_file);
    }


        $pdf->writeHTML($html, true, false, true, false, '');
        
        foreach ($criteria as $key => $label) {
            if (!empty($inspection->{$key.'_image'})) {
                $pdf->AddPage();
                $pdf->writeHTML('<h2>'.$label.'</h2>', true, false, true, false, '');
                $imagePath = FCPATH.'upload_criteria/'.$inspection->{$key.'_image'};
                if (file_exists($imagePath)) {
                    $pdf->Image($imagePath, 30, 60, 150);
                }
            }
        }
        
        $pdf->Output('inspection_report_'.$id.'.pdf', 'D');
    }
}