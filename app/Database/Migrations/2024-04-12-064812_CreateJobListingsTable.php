<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateJobListingsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'hotelier_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'job_title' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'job_description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'job_type' => [
                'type' => 'ENUM',
                'constraint' => ['Full-time', 'Part-time'],
                'default' => 'Full-time',
            ],
            'skill_requirements' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'location' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'department' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'experience_requirements' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['Active', 'Inactive'],
                'default' => 'Active',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('hotelier_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('job_listings');
    }

    public function down()
    {
        $this->forge->dropTable('job_listings');
    }
}
