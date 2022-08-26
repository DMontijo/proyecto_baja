<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PersonaEtniaSeeder extends Seeder
{
    public function run()
    {
        $data = [
            array('PERSONAETNIAID' => '1', 'PERSONAETNIADESCR' => 'AGUATECO'),
            array('PERSONAETNIAID' => '2', 'PERSONAETNIADESCR' => 'AMUZGO'),
            array('PERSONAETNIAID' => '3', 'PERSONAETNIADESCR' => 'CAKCHIQUEL'),
            array('PERSONAETNIAID' => '4', 'PERSONAETNIADESCR' => 'COCHIMI'),
            array('PERSONAETNIAID' => '5', 'PERSONAETNIADESCR' => 'CORA'),
            array('PERSONAETNIAID' => '6', 'PERSONAETNIADESCR' => 'CUCAPAH'),
            array('PERSONAETNIAID' => '7', 'PERSONAETNIADESCR' => 'CUICATECO'),
            array('PERSONAETNIAID' => '8', 'PERSONAETNIADESCR' => 'CHATINO'),
            array('PERSONAETNIAID' => '9', 'PERSONAETNIADESCR' => 'CHICHIMECA'),
            array('PERSONAETNIAID' => '10', 'PERSONAETNIADESCR' => 'CHINANTECO'),
            array('PERSONAETNIAID' => '11', 'PERSONAETNIADESCR' => 'CHOCHO'),
            array('PERSONAETNIAID' => '12', 'PERSONAETNIADESCR' => 'CHOL'),
            array('PERSONAETNIAID' => '13', 'PERSONAETNIADESCR' => 'CHONTAL'),
            array('PERSONAETNIAID' => '14', 'PERSONAETNIADESCR' => 'CHONTAL DE OAXACA'),
            array('PERSONAETNIAID' => '15', 'PERSONAETNIADESCR' => 'CHONTAL DE TABASCO'),
            array('PERSONAETNIAID' => '16', 'PERSONAETNIADESCR' => 'CHUJ'),
            array('PERSONAETNIAID' => '17', 'PERSONAETNIADESCR' => 'GUARIJIO'),
            array('PERSONAETNIAID' => '18', 'PERSONAETNIADESCR' => 'HUASTECO'),
            array('PERSONAETNIAID' => '19', 'PERSONAETNIADESCR' => 'HUAVE'),
            array('PERSONAETNIAID' => '20', 'PERSONAETNIADESCR' => 'HUICHOL'),
            array('PERSONAETNIAID' => '21', 'PERSONAETNIADESCR' => 'IXCATECO'),
            array('PERSONAETNIAID' => '22', 'PERSONAETNIADESCR' => 'IXIL'),
            array('PERSONAETNIAID' => '23', 'PERSONAETNIADESCR' => 'JACALTECO'),
            array('PERSONAETNIAID' => '24', 'PERSONAETNIADESCR' => 'KANJOBAL'),
            array('PERSONAETNIAID' => '25', 'PERSONAETNIADESCR' => 'KEKCHI'),
            array('PERSONAETNIAID' => '26', 'PERSONAETNIADESCR' => 'KIKAPU'),
            array('PERSONAETNIAID' => '27', 'PERSONAETNIADESCR' => 'KILIWA'),
            array('PERSONAETNIAID' => '28', 'PERSONAETNIADESCR' => 'KUMIAI'),
            array('PERSONAETNIAID' => '29', 'PERSONAETNIADESCR' => 'LACANDON'),
            array('PERSONAETNIAID' => '30', 'PERSONAETNIADESCR' => 'MAME'),
            array('PERSONAETNIAID' => '31', 'PERSONAETNIADESCR' => 'MATLATZINC'),
            array('PERSONAETNIAID' => '32', 'PERSONAETNIADESCR' => 'MAYA'),
            array('PERSONAETNIAID' => '33', 'PERSONAETNIADESCR' => 'MAYO'),
            array('PERSONAETNIAID' => '34', 'PERSONAETNIADESCR' => 'MAZAHUA'),
            array('PERSONAETNIAID' => '35', 'PERSONAETNIADESCR' => 'MAZATECO'),
            array('PERSONAETNIAID' => '36', 'PERSONAETNIADESCR' => 'MIXE'),
            array('PERSONAETNIAID' => '37', 'PERSONAETNIADESCR' => 'MIXTECO'),
            array('PERSONAETNIAID' => '38', 'PERSONAETNIADESCR' => 'MOTOCINTLE'),
            array('PERSONAETNIAID' => '39', 'PERSONAETNIADESCR' => 'NAHUATL'),
            array('PERSONAETNIAID' => '40', 'PERSONAETNIADESCR' => 'OCUILTECO'),
            array('PERSONAETNIAID' => '41', 'PERSONAETNIADESCR' => 'OPATA'),
            array('PERSONAETNIAID' => '42', 'PERSONAETNIADESCR' => 'OTOMI'),
            array('PERSONAETNIAID' => '43', 'PERSONAETNIADESCR' => 'OTRAS ETNIAS'),
            array('PERSONAETNIAID' => '44', 'PERSONAETNIADESCR' => 'PAIPAI'),
            array('PERSONAETNIAID' => '45', 'PERSONAETNIADESCR' => 'PAME'),
            array('PERSONAETNIAID' => '46', 'PERSONAETNIADESCR' => 'PAPAGO'),
            array('PERSONAETNIAID' => '47', 'PERSONAETNIADESCR' => 'PIMA'),
            array('PERSONAETNIAID' => '48', 'PERSONAETNIADESCR' => 'POPOLUCA'),
            array('PERSONAETNIAID' => '49', 'PERSONAETNIADESCR' => 'PUREPECHA'),
            array('PERSONAETNIAID' => '50', 'PERSONAETNIADESCR' => 'QUICHE'),
            array('PERSONAETNIAID' => '51', 'PERSONAETNIADESCR' => 'RARAMURI'),
            array('PERSONAETNIAID' => '52', 'PERSONAETNIADESCR' => 'SERI'),
            array('PERSONAETNIAID' => '53', 'PERSONAETNIADESCR' => 'SOLTECO'),
            array('PERSONAETNIAID' => '54', 'PERSONAETNIADESCR' => 'TACUATE'),
            array('PERSONAETNIAID' => '55', 'PERSONAETNIADESCR' => 'TARAHUMARA'),
            array('PERSONAETNIAID' => '56', 'PERSONAETNIADESCR' => 'TEPEHUA'),
            array('PERSONAETNIAID' => '57', 'PERSONAETNIADESCR' => 'TEPEHUAN'),
            array('PERSONAETNIAID' => '58', 'PERSONAETNIADESCR' => 'TLAPANECO'),
            array('PERSONAETNIAID' => '59', 'PERSONAETNIADESCR' => 'TOJOLABAL'),
            array('PERSONAETNIAID' => '60', 'PERSONAETNIADESCR' => 'TOTONACA'),
            array('PERSONAETNIAID' => '61', 'PERSONAETNIADESCR' => 'TRIQUI'),
            array('PERSONAETNIAID' => '62', 'PERSONAETNIADESCR' => 'TZELTAL'),
            array('PERSONAETNIAID' => '63', 'PERSONAETNIADESCR' => 'TZOTZIL'),
            array('PERSONAETNIAID' => '64', 'PERSONAETNIADESCR' => 'YAQUI'),
            array('PERSONAETNIAID' => '65', 'PERSONAETNIADESCR' => 'ZAPOTECO'),
            array('PERSONAETNIAID' => '66', 'PERSONAETNIADESCR' => 'ZOQUE'),
            array('PERSONAETNIAID' => '999', 'PERSONAETNIADESCR' => 'NINGUNA'),



        ];
        $this->db->table('PERSONAETNIA')->insertBatch($data);
    }
}
