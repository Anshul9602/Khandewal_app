<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateJobSavesTable extends Migration
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
        'job_id' => [
            'type' => 'INT',
            'unsigned' => true,
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
    $this->forge->addForeignKey('job_id', 'job_listings', 'id', 'CASCADE', 'CASCADE');
    $this->forge->createTable('job_saves');
}

public function down()
{
    $this->forge->dropTable('job_saves');
}
}
