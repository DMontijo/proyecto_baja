<?php

namespace App\Models;

use CodeIgniter\Model;

class VideoCallReadModel extends Model
{
	protected $DBGroup = 'videocall_read';

	public function getReporteDiarioInfoByFolio($foliosConsulta)
	{
		if (!$foliosConsulta) {
			return [];
		}
		$folioAno = "'" . implode("','", $foliosConsulta) . "'"; // Agrega comillas solo entre los valores
		
		$strQuery = "SELECT * FROM (SELECT
		RE.uri, RE.duration,
		CR.sessionStartedAt, CR.sessionFinishedAt,
		GC.folio, GC.priority,
		RE.id AS recording_id,
		CR.id AS call_record_id,
		GC.id AS guest_conection_id
		FROM recording RE
		LEFT JOIN call_record CR ON RE.callRecordId = CR.id
		LEFT JOIN guests_connection GC ON CR.guestConnectionId = GC.id
		WHERE RE.uri IS NOT NULL) data WHERE folio IN($folioAno) ORDER BY sessionStartedAt DESC";
		$result = $this->db->query($strQuery)->getResult();
		return $result;
	}
}
