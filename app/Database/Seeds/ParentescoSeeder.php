<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ParentescoSeeder extends Seeder
{
    public function run()
    {
        $data = [
            array('PERSONAPARENTESCOID' => '1', 'PERSONAPARENTESCODESCR' => 'MADRE'),
            array('PERSONAPARENTESCOID' => '2', 'PERSONAPARENTESCODESCR' => 'PADRE'),
            array('PERSONAPARENTESCOID' => '3', 'PERSONAPARENTESCODESCR' => 'HIJO(A)'),
            array('PERSONAPARENTESCOID' => '4', 'PERSONAPARENTESCODESCR' => 'HERMANO(A)'),
            array('PERSONAPARENTESCOID' => '5', 'PERSONAPARENTESCODESCR' => 'PRIMO(A)'),
            array('PERSONAPARENTESCOID' => '6', 'PERSONAPARENTESCODESCR' => 'TIO(A)'),
            array('PERSONAPARENTESCOID' => '7', 'PERSONAPARENTESCODESCR' => 'ABUELO(A)'),
            array('PERSONAPARENTESCOID' => '8', 'PERSONAPARENTESCODESCR' => 'NIETO(A)'),
            array('PERSONAPARENTESCOID' => '9', 'PERSONAPARENTESCODESCR' => 'YERNO'),
            array('PERSONAPARENTESCOID' => '10', 'PERSONAPARENTESCODESCR' => 'CONYUGE'),
            array('PERSONAPARENTESCOID' => '11', 'PERSONAPARENTESCODESCR' => 'NUERA'),
            array('PERSONAPARENTESCOID' => '12', 'PERSONAPARENTESCODESCR' => 'PARIENTE POLITICO'),
            array('PERSONAPARENTESCOID' => '13', 'PERSONAPARENTESCODESCR' => 'SOBRINO(A)'),
            array('PERSONAPARENTESCOID' => '14', 'PERSONAPARENTESCODESCR' => 'EX-PAREJA'),
            array('PERSONAPARENTESCOID' => '15', 'PERSONAPARENTESCODESCR' => 'PADRASTRO'),
            array('PERSONAPARENTESCOID' => '16', 'PERSONAPARENTESCODESCR' => 'MADRASTRA'),
            array('PERSONAPARENTESCOID' => '17', 'PERSONAPARENTESCODESCR' => 'CONCUBINA(O)'),
            array('PERSONAPARENTESCOID' => '99', 'PERSONAPARENTESCODESCR' => 'NINGUNA'),


        ];
        $this->db->table('PERSONAPARENTESCO')->insertBatch($data);
    }
}
