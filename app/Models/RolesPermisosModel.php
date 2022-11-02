<?php

namespace App\Models;

use CodeIgniter\Model;

class RolesPermisosModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'ROLESPERMISOS';   
    protected $allowedFields    = ['ROLID','PERMISOID'];

    public function get_rol_permiso(){
        $builder = $this->db->table($this->table);
		$builder->select(['ROLESPERMISOS.ROLID','ROLESPERMISOS.PERMISOID', 'NOMBRE_ROL','PERMISODESCR']);
		$builder->join('ROLES', 'ROLES.ID = ROLESPERMISOS.ROLID');
        $builder->join('PERMISOS', 'PERMISOS.PERMISOID= ROLESPERMISOS.PERMISOID');
		$query = $builder->get();
		return $query->getResult('array');
    }

}
