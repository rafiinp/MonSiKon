<?php
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCompanyIdToUsers extends Migration
{
    public function up()
    {
        $this->forge->addColumn('user', [
            'id_company' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
                'after' => 'id_user'
            ]
        ]);
        
        // Add foreign key
        $this->forge->addForeignKey('id_company', 'companies', 'id_company', 'CASCADE', 'SET NULL');
    }

    public function down()
    {
        $this->forge->dropForeignKey('user', 'user_id_company_foreign');
        $this->forge->dropColumn('user', 'id_company');
    }
}