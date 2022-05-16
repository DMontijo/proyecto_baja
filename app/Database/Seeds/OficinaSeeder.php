<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class OficinaSeeder extends Seeder
{
    public function run()
    {
        $data = [

        ];
        $this->db->table("OFICINA")->insertBatch($data);
    }
}
