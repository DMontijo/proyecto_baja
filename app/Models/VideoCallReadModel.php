<?php

namespace App\Models;

use CodeIgniter\Model;

class VideoCallReadModel extends Model
{
	protected $DBGroup = 'videocall_read';

	public function getReporteDiarioInfoByFolio($folio, $year)
	{
		if (!$folio || !$year) {
			return [];
		}
		
		$strQuery = "SELECT * FROM (SELECT
		RE.uri, RE.duration,
		CR.sessionStartedAt, CR.sessionFinishedAt,
		GC.folio, GC.priority,
		CAST(SUBSTRING_INDEX(GC.folio, '/', 1) AS UNSIGNED) AS folio_id,
		CAST(SUBSTRING_INDEX(GC.folio, '/', -1) AS UNSIGNED) AS year,
		RE.id AS recording_id,
		CR.id AS call_record_id,
		GC.id AS guest_conection_id
		FROM recording RE
		LEFT JOIN call_record CR ON RE.callRecordId = CR.id
		LEFT JOIN guests_connection GC ON CR.guestConnectionId = GC.id
		WHERE RE.uri IS NOT NULL) data WHERE folio_id = $folio AND year = $year ORDER BY sessionStartedAt DESC LIMIT 1";
		$result = $this->db->query($strQuery)->getResult();
		return $result;
	}
}
