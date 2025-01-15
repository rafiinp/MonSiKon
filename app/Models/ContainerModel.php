<?php

namespace App\Models;

use CodeIgniter\Model;

class ContainerModel extends Model
{
    protected $table = 'containers';
    protected $primaryKey = 'id_container';
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
    protected $allowedFields = [
        'container_number',
        'type',
        'capacity',
        'status'
    ];

    public function getPaginatedContainers($limit, $keyword = null)
    {
        $builder = $this->builder();
        if ($keyword != '') {
            $builder->like('container_number', $keyword);
            $builder->orLike('type', $keyword);
        }
        return [
            'containers' => $this->paginate($limit),
            'pager' => $this->pager,
        ];
    }
}