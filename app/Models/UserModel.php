<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'user';
    protected $primaryKey       = 'id_user';
    protected $returnType       = 'object';
    protected $allowedFields = ['photo_user', 'name_user', 'email_user', 'password_user', 'role', 'id_company'];
    protected $useAutoIncrement = true;
    protected $protectFields    = true;
    protected $useTimestamps = true;
    protected $useSoftDeletes   = false;
    

    public function getPaginatedUser($num, $keyword = null)
{
    $builder = $this->builder();
    $builder->select('user.*, companies.name_company');
    $builder->join('companies', 'companies.id_company = user.id_company', 'left');

    // Filter berdasarkan id_company jika role adalah admin
    $currentRole = session()->get('role');
    $currentCompanyId = session()->get('id_company'); // Pastikan ini disimpan saat login

    if ($currentRole == 'admin') {
        $builder->where('user.id_company', $currentCompanyId);
    }

    if ($keyword != '') {
        $builder->groupStart()
            ->orLike('name_user', $keyword)
            ->orLike('email_user', $keyword)
            ->orLike('role', $keyword)
            ->orLike('name_company', $keyword)
        ->groupEnd();
    }

    return [
        'user' => $this->paginate($num),
        'pager' => $this->pager,
    ];
}


public function getPaginatedUserByCompany($num, $keyword = null, $companyId)
{
    $builder = $this->builder();
    $builder->select('user.*, companies.name_company');
    $builder->join('companies', 'companies.id_company = user.id_company', 'left');
    $builder->where('user.id_company', $companyId); // Filter berdasarkan perusahaan

    if ($keyword != '') {
        $builder->groupStart()
            ->orLike('name_user', $keyword)
            ->orLike('email_user', $keyword)
            ->orLike('role', $keyword)
            ->orLike('name_company', $keyword)
        ->groupEnd();
    }

    return [
        'user' => $this->paginate($num),
        'pager' => $this->pager,
    ];
}

}
