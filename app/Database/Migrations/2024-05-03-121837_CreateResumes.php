<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateResumes extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'Resume' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'created_at' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('resumes', true);
    }

    public function down()
    {
        $this->forge->dropTable('resumes', true);
    }
}
