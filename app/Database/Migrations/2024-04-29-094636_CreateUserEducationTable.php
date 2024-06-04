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
                
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type' => 'INT',
                
                'unsigned' => true,
            ],
            '10th' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            '10th_school' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            '10th_year' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            '12th' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            '12th_school' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            '12th_year' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'gra_dip' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],

            'degree' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'university' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'year' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'post_gra' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],

            'pg_degree' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'pg_university' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'pg_year' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'doc' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],

            'doc_degree' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'doc_university' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'doc_year' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
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