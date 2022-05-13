<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class HechoLugarSeeder extends Seeder
{
    public function run()
    {
        $data = [
            array('HECHODESCR' => 'CASA HABITACION (SIN ARMA)'),
            array('HECHODESCR' => 'VIA PUBLICA (SIN ARMA)'),
            array('HECHODESCR' => 'INSTITUCION PUBLICA (SIN ARMA)'),
            array('HECHODESCR' => 'CENTRO ESCOLAR (SIN ARMA)'),
            array('HECHODESCR' => 'CENTRO RELIGIOSO (SIN ARMA)'),
            array('HECHODESCR' => 'CARRETERAS ESTATALES (SIN ARMA)'),
            array('HECHODESCR' => 'DESPOBLADO (SIN ARMA)'),
            array('HECHODESCR' => 'LOCAL COMERCIAL (SIN ARMA)'),
            array('HECHODESCR' => 'INSTITUCION BANCARIA (SIN ARMA)'),
            array('HECHODESCR' => 'CAMINOS VECINALES (SIN ARMA)'),
            array('HECHODESCR' => 'CENTRO RECREATIVO (SIN ARMA)'),
            array('HECHODESCR' => 'INSTITUCIONES PRIVADAS (SIN ARMA)'),
            array('HECHODESCR' => 'PUERTOS FEDERALES (SIN ARMA)'),
            array('HECHODESCR' => 'ESTACIONAMIENTOS (SIN ARMA)'),
            array('HECHODESCR' => 'HOTEL (SIN ARMA)'),
            array('HECHODESCR' => 'TRANSEUNTE EN ESPACIO ABIERTO (SIN ARMA)'),
            array('HECHODESCR' => 'TRANSPORTISTA (SIN ARMA)'),
            array('HECHODESCR' => 'EN TRANSPORTE INDIVIDUAL (SIN ARMA)'),
            array('HECHODESCR' => 'EN TRANSPORTE PUBLICO COLECTIVO (SIN ARMA)'),
            array('HECHODESCR' => 'EN TRANSPORTE PUBLICO INDIVIDUAL (SIN ARMA)'),
            array('HECHODESCR' => 'CASA HABITACION (CON ARMA DE FUEGO)'),
            array('HECHODESCR' => 'VIA PUBLICA (CON ARMA DE FUEGO)'),
            array('HECHODESCR' => 'INSTITUCION PUBLICA (CON ARMA DE FUEGO)'),
            array('HECHODESCR' => 'CENTRO ESCOLAR (CON ARMA DE FUEGO)'),
            array('HECHODESCR' => 'CENTRO RELIGIOSO (CON ARMA DE FUEGO)'),
            array('HECHODESCR' => 'CARRETERAS ESTATALES (CON ARMA DE FUEGO)'),
            array('HECHODESCR' => 'DESPOBLADO (CON ARMA DE FUEGO)'),
            array('HECHODESCR' => 'LOCAL COMERCIAL (CON ARMA DE FUEGO)'),
            array('HECHODESCR' => 'INSTITUCION BANCARIA (CON ARMA DE FUEGO)'),
            array('HECHODESCR' => 'CAMINOS VECINALES (CON ARMA DE FUEGO)'),
            array('HECHODESCR' => 'CENTRO RECREATIVO (CON ARMA DE FUEGO)'),
            array('HECHODESCR' => 'INSTITUCIONES PRIVADAS (CON ARMA DE FUEGO)'),
            array('HECHODESCR' => 'PUERTOS FEDERALES (CON ARMA DE FUEGO)'),
            array('HECHODESCR' => 'ESTACIONAMIENTOS (CON ARMA DE FUEGO)'),
            array('HECHODESCR' => 'HOTEL (CON ARMA DE FUEGO)'),
            array('HECHODESCR' => 'TRANSEUNTE EN ESPACIO ABIERTO (CON ARMA DE FUEGO)'),
            array('HECHODESCR' => 'TRANSPORTISTA (CON ARMA DE FUEGO)'),
            array('HECHODESCR' => 'EN TRANSPORTE INDIVIDUAL (CON ARMA DE FUEGO)'),
            array('HECHODESCR' => 'EN TRANSPORTE PUB. COLECTIVO (CON ARMA DE FUEGO)'),
            array('HECHODESCR' => 'EN TRANSPORTE PUB. INDIVIDUAL (CON ARMA DE FUEGO)'),
            array('HECHODESCR' => 'CUENTA HABIENTE (CON ARMA DE FUEGO)'),
            array('HECHODESCR' => 'CASA HABITACION (CON ARMA BLANCA)'),
            array('HECHODESCR' => 'VIA PUBLICA (CON ARMA BLANCA)'),
            array('HECHODESCR' => 'INSTITUCION PUBLICA  (CON ARMA BLANCA)'),
            array('HECHODESCR' => 'CENTRO ESCOLAR  (CON ARMA BLANCA)'),
            array('HECHODESCR' => 'CENTRO RELIGIOSO (CON ARMA BLANCA)'),
            array('HECHODESCR' => 'CARRETERAS ESTATALES (CON ARMA BLANCA)'),
            array('HECHODESCR' => 'DESPOBLADO (CON ARMA BLANCA)'),
            array('HECHODESCR' => 'LOCAL COMERCIAL (CON ARMA BLANCA)'),
            array('HECHODESCR' => 'INSTITUCION BANCARIA (CON ARMA BLANCA)'),
            array('HECHODESCR' => 'CAMINOS VECINALES (CON ARMA BLANCA)'),
            array('HECHODESCR' => 'CENTRO RECREATIVO (CON ARMA BLANCA)'),
            array('HECHODESCR' => 'INSTITUCIONES PRIVADAS (CON ARMA BLANCA)'),
            array('HECHODESCR' => 'PUERTOS FEDERALES (CON ARMA BLANCA)'),
            array('HECHODESCR' => 'ESTACIONAMIENTOS (CON ARMA BLANCA)'),
            array('HECHODESCR' => 'HOTEL (CON ARMA BLANCA)'),
            array('HECHODESCR' => 'TRANSEUNTE EN ESPACIO ABIERTO (CON ARMA BLANCA)'),
            array('HECHODESCR' => 'TRANSPORTISTA (CON ARMA BLANCA)'),
            array('HECHODESCR' => 'EN TRANSPORTE INDIVIDUAL (CON ARMA BLANCA)'),
            array('HECHODESCR' => 'EN TRANSPORTE PUBLICO COLECTIVO (CON ARMA BLANCA)'),
            array('HECHODESCR' => 'EN TRANSPORTE PUBLICO INDIVIDUAL (CON ARMA BLANCA)'),
            array('HECHODESCR' => 'CUENTA HABIENTE (CON ARMA BLANCA)'),
            array('HECHODESCR' => 'CARRETERAS FEDERALES (CON ARMA DE FUEGO)'),
            array('HECHODESCR' => 'CARRETERAS FEDERALES (CON ARMA BLANCA)'),
            array('HECHODESCR' => 'CUENTA HABIENTE (SIN ARMA)'),
            array('HECHODESCR' => 'CARRETERAS FEDERALES (SIN ARMA)'),
            array('HECHODESCR' => 'OTROS'),
           
        ];
        
      $this->db->table('CATEGORIA_HECHOLUGAR')->insertBatch($data);
    }
}