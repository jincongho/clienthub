<?php
class ProfilesTable {
	
	private static $mysql = null;
	
	public static function setMysql(&$mysql){
		self::$mysql =& $mysql;
	}
	
	public static function delete(&$mysql, array $value) {
		if (isset ( $value ['id'] )) {
			return $mysql->update ( 'profiles', array ('status' => 'trash' ), 'id = ?', $value ['id'] );
		} else {
			return false;
		}
	}
	
	public static function update(&$mysql, array $value) {
		$id = $value ['id'];
		unset ( $value ['id'] );
		
		return $mysql->update ( 'profiles', $value, 'id = ?', $id );
	}
	
	public static function searchLimit(&$mysql, array $value) {
		$query = 'SELECT `id`, `photo`, `attachment`, `file`, `case`, `name`, `ic` FROM `profiles` WHERE `status` !=  \'trash\' ';
		foreach ( $value as $key => $value ) {
			if ($value != NULL) {
				$query .= 'AND ';
				$query .= '`' . $key . '` LIKE \'%';
				$query .= ( string ) $value;
				$query .= '%\' ';
			}
		}
		return $mysql->getRecords($query);
	}
	
	public static function search(&$mysql, array $value) {
		$sql = "SELECT * 
FROM `profiles` 
WHERE (
`file` LIKE  '%'
OR  `case` LIKE  '%'
OR  `name` LIKE  '%'
OR  `ic` LIKE  '%'
OR  `gender` LIKE  '%'
OR  `placeofbirth` LIKE  '%'
OR  `education` LIKE  '%'
OR  `language` LIKE  '%'
OR  `race` LIKE  '%'
OR  `faith` LIKE  '%'
OR  `maritalstatus` LIKE  '%'
OR  `nationality` LIKE  '%'
OR  `profession` LIKE  '%'
OR  `address` LIKE  '%'
OR  `epf` LIKE  '%'
OR  `banker` LIKE  '%'
OR  `contactno` LIKE  '%'
OR  `email` LIKE  '%'
OR  `platesno` LIKE  '%'
OR  `assets` LIKE  '%'
OR  `height` LIKE  '%'
OR  `weight` LIKE  '%'
OR  `blood` LIKE  '%'
OR  `eye` LIKE  '%'
OR  `hair` LIKE  '%'
OR  `skin` LIKE  '%'
OR  `dna` LIKE  '%'
OR  `casereport` LIKE  '%'
OR  `family` LIKE  '%'
OR  `company` LIKE  '%'
OR  `remarks` LIKE  '%'
OR  `status` LIKE  '%'
OR  `lastupdate` LIKE  '%' 
AND `status` != 'trash'
)";
		return $mysql->getRecords ( str_replace ( '%', '%'.$value ['q'].'%', $sql ) );
	}
	
	public static function getTotal(&$mysql) {
		return $mysql->getRecords ( 'SELECT `id` FROM `profiles` WHERE `status` != \'trash\'' );
	}
	
	public static function getName(&$mysql, array $value) {
		return $mysql->getRecords ( 'SELECT `id` FROM `profiles` WHERE `name` = \'' . $value ['name'] . '\' AND `status` !=  \'trash\'' );
	}
	
	public static function getProf(&$mysql, array $value) {
		return $mysql->getRecord ( 'SELECT * FROM `profiles` WHERE `id` = \'' . $value ['id'] . '\' AND `status` !=  \'trash\'' );
	}
	
	public static function getPhoto(&$mysql, array $value) {
		return $mysql->getRecord ( 'SELECT `photo`, `photoext` FROM `profiles` WHERE `id` = \'' . ( int ) $value ['id'] . '\' AND `status` !=  \'trash\'' );
	}
	
	public static function getAttachment(&$mysql, array $value) {
		return $mysql->getRecord ( 'SELECT `attachment`, `attachext` FROM `profiles` WHERE `id` = \'' . ( int ) $value ['id'] . '\' AND `status` !=  \'trash\'' );
	}
	
	public static function getList(&$mysql) {
		return $mysql->getRecords ( "SELECT `id`, `photo`, `attachment`, `file`, `case`, `name`, `ic`, `company` FROM `profiles` WHERE `status` !=  'trash'" );
	}
}