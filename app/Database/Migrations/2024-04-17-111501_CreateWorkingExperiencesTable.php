<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateWorkingExperiencesTable extends Migration
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
            'organisation' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'designation' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'ref_mobile' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'ref_email' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'profile' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'location' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'start_date' => [
                'type' => 'DATE',
            ],
            'end_date' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('working_experiences');
    }

    public function down()
    {
        $this->forge->dropTable('working_experiences');
    }
}