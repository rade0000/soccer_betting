<?php
class Config{
	public static function get($patch){
		$result = $GLOBALS['config'];
		$patch = explode("/", $patch);
		foreach($patch as $part){
			if(isset($result[$part]))
				$result = $result[$part];
		}
		return $result;
	}

}