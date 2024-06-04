<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateJobPref extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'department' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'sub_department' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('Job_pref');
    }

    public function down()
    {
        $this->forge->dropTable('Job_pref');
    }
}
