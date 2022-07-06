<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Uf extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nombre'       => [
                'type'       => 'VARCHAR',
                'constraint' => '200',
                'null' => FALSE,
            ],
            'valor' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => FALSE,
                'default' => 0.00
            ],
            'fecha' => [
                'type' => 'datetime',
                'null' => FALSE,
            ],
            'delete_status' => [
                'type' => 'TINYINT',
                'constraint' => 3,
                'default'=>1,
            ]

        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('Uf');
    }

    public function down()
    {
        $this->forge->dropTable('Uf');
    }
}
