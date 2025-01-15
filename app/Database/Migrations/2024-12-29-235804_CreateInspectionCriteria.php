<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddInspectionCriteria extends Migration
{
    public function up()
    {
        // Add inspection criteria fields
        $fields = [
            // Outside Undercarriage
            'undercarriage_result' => [
                'type' => 'ENUM',
                'constraint' => ['Good', 'Rust', 'Bruise', 'Hole', 'Dent', 'Broken', 'Scratch', 'Patched'],
                'null' => true,
            ],
            'undercarriage_image' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            
            // Inside Inspection
            'inside_wall_result' => [
                'type' => 'ENUM',
                'constraint' => ['Good', 'Rust', 'Bruise', 'Hole', 'Dent', 'Broken', 'Scratch', 'Patched'],
                'null' => true,
            ],
            'inside_wall_image' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            
            // Outside Door (Right Side)
            'right_door_result' => [
                'type' => 'ENUM',
                'constraint' => ['Good', 'Rust', 'Bruise', 'Hole', 'Dent', 'Broken', 'Scratch', 'Patched'],
                'null' => true,
            ],
            'right_door_image' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            
            // Outside Door (Left Side)
            'left_door_result' => [
                'type' => 'ENUM',
                'constraint' => ['Good', 'Rust', 'Bruise', 'Hole', 'Dent', 'Broken', 'Scratch', 'Patched'],
                'null' => true,
            ],
            'left_door_image' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            
            // Front Wall
            'front_wall_result' => [
                'type' => 'ENUM',
                'constraint' => ['Good', 'Rust', 'Bruise', 'Hole', 'Dent', 'Broken', 'Scratch', 'Patched'],
                'null' => true,
            ],
            'front_wall_image' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            
            // Ceiling
            'ceiling_result' => [
                'type' => 'ENUM',
                'constraint' => ['Good', 'Rust', 'Bruise', 'Hole', 'Dent', 'Broken', 'Scratch', 'Patched'],
                'null' => true,
            ],
            'ceiling_image' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            
            // Roof
            'roof_result' => [
                'type' => 'ENUM',
                'constraint' => ['Good', 'Rust', 'Bruise', 'Hole', 'Dent', 'Broken', 'Scratch', 'Patched'],
                'null' => true,
            ],
            'roof_image' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            
            // Floor Inside
            'floor_inside_result' => [
                'type' => 'ENUM',
                'constraint' => ['Good', 'Rust', 'Bruise', 'Hole', 'Dent', 'Broken', 'Scratch', 'Patched'],
                'null' => true,
            ],
            'floor_inside_image' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            
            // Fifth Wheel Area
            'fifth_wheel_result' => [
                'type' => 'ENUM',
                'constraint' => ['Good', 'Rust', 'Bruise', 'Hole', 'Dent', 'Broken', 'Scratch', 'Patched'],
                'null' => true,
            ],
            'fifth_wheel_image' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            
            // Exterior Front
            'exterior_front_result' => [
                'type' => 'ENUM',
                'constraint' => ['Good', 'Rust', 'Bruise', 'Hole', 'Dent', 'Broken', 'Scratch', 'Patched'],
                'null' => true,
            ],
            'exterior_front_image' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            
            // Rear Bumper/Door
            'rear_bumper_result' => [
                'type' => 'ENUM',
                'constraint' => ['Good', 'Rust', 'Bruise', 'Hole', 'Dent', 'Broken', 'Scratch', 'Patched'],
                'null' => true,
            ],
            'rear_bumper_image' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
        ];

        $this->forge->addColumn('inspections', $fields);
    }

    public function down()
    {
        // Remove the columns if rolling back
        $columns = [
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
            'rear_bumper_result', 'rear_bumper_image'
        ];
        
        $this->forge->dropColumn('inspections', $columns);
    }
}
