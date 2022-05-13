<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class VehiculoTipoSeeder extends Seeder
{
    public function run()
    {
        $data = [
            array('VEHICULOTIPODESCR' => 'CONVERTIBLE'),
            array('VEHICULOTIPODESCR' => 'COUPE'),
            array('VEHICULOTIPODESCR' => 'LIMOUSINE'),
            array('VEHICULOTIPODESCR' => 'SEDAN'),
            array('VEHICULOTIPODESCR' => 'SPORT'),
            array('VEHICULOTIPODESCR' => 'VAGONETA'),
            array('VEHICULOTIPODESCR' => 'COMBI'),
            array('VEHICULOTIPODESCR' => 'AUTO TANQUE'),
            array('VEHICULOTIPODESCR' => 'CABINA'),
            array('VEHICULOTIPODESCR' => 'CAJA'),
            array('VEHICULOTIPODESCR' => 'CASETA'),
            array('VEHICULOTIPODESCR' => 'JEEP'),
            array('VEHICULOTIPODESCR' => 'CELDILLAS'),
            array('VEHICULOTIPODESCR' => 'CHASIS'),
            array('VEHICULOTIPODESCR' => 'ESTACAS'),
            array('VEHICULOTIPODESCR' => 'MICROBUS'),
            array('VEHICULOTIPODESCR' => 'OMNIBUS'),
            array('VEHICULOTIPODESCR' => 'PANEL'),
            array('VEHICULOTIPODESCR' => 'PICK-UP'),
            array('VEHICULOTIPODESCR' => 'PIPA'),
            array('VEHICULOTIPODESCR' => 'PLATAFORMA'),
            array('VEHICULOTIPODESCR' => 'REDILAS CONVERTIBLES'),
            array('VEHICULOTIPODESCR' => 'REFRIGERADOR'),
            array('VEHICULOTIPODESCR' => 'TANQUE'),
            array('VEHICULOTIPODESCR' => 'TRACTOR'),
            array('VEHICULOTIPODESCR' => 'VANNETTE'),
            array('VEHICULOTIPODESCR' => 'VOLTEO'),
            array('VEHICULOTIPODESCR' => 'DOLLY'),
            array('VEHICULOTIPODESCR' => 'HABITACION'),
            array('VEHICULOTIPODESCR' => 'INDUSTRIAL'),
            array('VEHICULOTIPODESCR' => 'JAULA'),
            array('VEHICULOTIPODESCR' => 'TANQUES (S) O (R)'),
            array('VEHICULOTIPODESCR' => 'AMBULANCIA'),
            array('VEHICULOTIPODESCR' => 'CARROZA'),
            array('VEHICULOTIPODESCR' => 'EQUIPO ESPECIAL'),
            array('VEHICULOTIPODESCR' => 'GRUA'),
            array('VEHICULOTIPODESCR' => 'REVOLVEDORA'),
            array('VEHICULOTIPODESCR' => 'DEMOSTRADORA'),
            array('VEHICULOTIPODESCR' => 'MOTOS'),
            array('VEHICULOTIPODESCR' => 'AUTOBUS'),
            array('VEHICULOTIPODESCR' => 'VAN'),
            array('VEHICULOTIPODESCR' => 'MOTONETA'),
            array('VEHICULOTIPODESCR' => 'SEMI REMOLQUE'),
            array('VEHICULOTIPODESCR' => 'REMOLQUE'),
            array('VEHICULOTIPODESCR' => 'CAMION'),
            array('VEHICULOTIPODESCR' => 'CAMIONETA'),
            array('VEHICULOTIPODESCR' => 'CASA RODANTE'),
            array('VEHICULOTIPODESCR' => 'CISTERNAS'),
            array('VEHICULOTIPODESCR' => 'CONTENEDOR'),

        ];
        $this->db->table('CATEGORIA_VEHICULOTIPO')->insertBatch($data);
    }
}