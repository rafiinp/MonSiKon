<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCompaniesTable extends Migration
{
    public function up()
    {
        // Creating the companies table
        $this->forge->addField([
            'id_company' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name_company' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
            'deleted_at datetime default null',
        ]);
        $this->forge->addPrimaryKey('id_company');
        $this->forge->createTable('companies');
    }

    public function down()
    {
        // Drop the companies table if rollback
        $this->forge->dropTable('companies');
    }
}
