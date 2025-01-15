<?php

namespace App\Models;

use CodeIgniter\Model;

class CompanyModel extends Model
{
    protected $table = 'companies';
    protected $primaryKey = 'id_company';
    
    protected $allowedFields = ['name_company', 'created_at', 'updated_at', 'deleted_at'];
    
    // To automatically handle timestamps
    protected $useTimestamps = true;
    
    // Soft delete
    protected $deleteField = 'deleted_at';

    // Validation rules (optional)
    protected $validationRules = [
        'name_company' => 'required|min_length[3]|max_length[255]',
    ];
}
