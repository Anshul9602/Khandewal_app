<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersEducationTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'degree' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'university' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'year' => [
                'type' => 'INT',
                'constraint' => 4,
            ],
            'created_at' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('user_education');
    }

    public function down()
    {
        $this->forge->dropTable('user_education');
    }
}