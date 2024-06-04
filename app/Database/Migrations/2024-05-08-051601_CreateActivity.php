<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateActivity extends Migration
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
            'activity' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
           
            'created_at' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            
        ]);

        $this->forge->addPrimaryKey('id');
        
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('activity');
    }

    public function down()
    {
        $this->forge->dropTable('activity');
    }
}
