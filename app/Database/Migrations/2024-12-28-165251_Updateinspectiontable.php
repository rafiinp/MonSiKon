<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateInspectionsTable extends Migration
{
    public function up()
    {
        // Add columns if they do not exist
        $this->forge->addColumn('inspections', [
            // 'result' => [
            //     'type' => 'JSON',
            //     'null' => true,
            // ],
            'inspection_date' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'arrival_time' => [
                'type' => 'TIME',
                'null' => true,
            ],
            'departure_time' => [
                'type' => 'TIME',
                'null' => true,
            ],
            'inspection_time' => [
                'type' => 'TIME',
                'null' => true,
            ],
            'seal_no' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'buyer' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'po_number' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'inspector_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'witness_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'inner_cleaned' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
                'null' => true,
            ],
            'outer_cleaned' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
                'null' => true,
            ]
        ]);
    }

    public function down()
    {
        // Revert changes if needed
        $fields = [
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
            'outer_cleaned'
        ];

        foreach ($fields as $field) {
            $this->forge->dropColumn('inspections', $field);
        }
    }
}
