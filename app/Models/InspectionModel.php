<?php

namespace App\Models;

use CodeIgniter\Model;

class InspectionModel extends Model
{
    protected $table = 'inspections';
    protected $primaryKey = 'id_inspection';
    protected $returnType = 'object';
    protected $allowedFields = [
        'container_id', 
        'scheduled_date', 
        'surveyor_id', 
        'status', 
        'result', 
        'inspection_photo', 
        'container_code',
        'inspection_date',
        'arrival_time',
        'departure_time',
        'inspection_time',
        'seal_no',
        'buyer',
        'po_number',
        'inspector_name',
        'witness_name',
        'inner_cleaned',
        'outer_cleaned',
        // Make sure all criteria fields are included
        'undercarriage_result', 'undercarriage_image',
        'inside_wall_result', 'inside_wall_image',
        'right_door_result', 'right_door_image',
        'left_door_result', 'left_door_image',
        'front_wall_result', 'front_wall_image',
        'ceiling_result', 'ceiling_image',
        'roof_result', 'roof_image',
        'floor_inside_result', 'floor_inside_image',
        'fifth_wheel_result', 'fifth_wheel_image',
        'exterior_front_result', 'exterior_front_image',
        'rear_bumper_result', 'rear_bumper_image',
        'inspector_signature_data',    // Change from inspector_signature
        'witness_signature_data', 
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    protected $validationRules = [
        'container_id'      => 'required|numeric|exists[containers.id_container]',
        'scheduled_date'    => 'required|valid_date',
        'surveyor_id'       => 'required|numeric|exists[user.id_user]',
        'status'            => 'permit_empty|in_list[pending,completed]',
        'inspection_date'   => 'permit_empty|valid_date',
        // Remove valid_time as it's not a built-in rule
        'arrival_time'      => 'permit_empty',
        'departure_time'    => 'permit_empty',
        'inspection_time'   => 'permit_empty',
        'seal_no'           => 'permit_empty|string',
        'buyer'             => 'permit_empty|string',
        'po_number'         => 'permit_empty|string',
        'inspector_name'    => 'permit_empty|string',
        'witness_name'      => 'permit_empty|string',
        'inner_cleaned'     => 'permit_empty|in_list[0,1]',  // Changed to accept 0,1
        'outer_cleaned'     => 'permit_empty|in_list[0,1]',  // Changed to accept 0,1
        'undercarriage_result' => 'permit_empty',
        'inside_wall_result' => 'permit_empty',
        'right_door_result' => 'permit_empty',
        'left_door_result' => 'permit_empty',
        'front_wall_result' => 'permit_empty',
        'ceiling_result' => 'permit_empty',
        'roof_result' => 'permit_empty',
        'floor_inside_result' => 'permit_empty',
        'fifth_wheel_result' => 'permit_empty',
        'exterior_front_result' => 'permit_empty',
        'rear_bumper_result' => 'permit_empty',
        'inspector_signature_data' => 'permit_empty',
        'witness_signature_data' => 'permit_empty'
    ];

    protected $validationMessages = [
        'container_id' => [
            'exists' => 'The selected container does not exist.'
        ],
        'surveyor_id' => [
            'exists' => 'The selected surveyor does not exist.'
        ]
    ];

    // Get all inspections with related container and surveyor details
    public function getAllInspections()
    {
        return $this->select('inspections.*, containers.container_number, user.name_user as surveyor_name')
                    ->join('containers', 'containers.id_container = inspections.container_id')
                    ->join('user', 'user.id_user = inspections.surveyor_id')
                    ->findAll();
    }

    // Get scheduled inspections for a specific surveyor
    public function getScheduledInspections($surveyor_id)
    {
        return $this->select('inspections.*, containers.container_number')
                    ->join('containers', 'containers.id_container = inspections.container_id')
                    ->where('inspections.surveyor_id', $surveyor_id)
                    ->where('inspections.status', 'pending')
                    ->findAll();
    }
}
