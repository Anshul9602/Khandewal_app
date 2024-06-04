<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateJobPrefUser extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'job_type' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'department' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'pref_state' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'pref_city' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'salery' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true, // Adjust precision and scale as needed
            ],
            'start_time' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true, // Adjust precision and scale as needed
            ],
            'end_time' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true, // Adjust precision and scale as needed
            ],
            'created_at' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'updated_at' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('job_pref_user');
    }

    public function down()
    {
        $this->forge->dropTable('job_pref_user');
    }
}
