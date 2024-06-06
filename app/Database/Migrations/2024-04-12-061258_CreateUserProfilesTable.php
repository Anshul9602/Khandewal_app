<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserProfilesTable extends Migration
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
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'gender' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'role' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'profile_picture' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'address' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'city' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'country' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'interested_fields' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'other_personal_details' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'resume' => [
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
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('user_profiles');
    }

    public function down()
    {
        $this->forge->dropTable('user_profiles');
    }
}
