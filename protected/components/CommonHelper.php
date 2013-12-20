<?php
class CommonHelper
{

	public static function lessString($string =NULL, $minLength = 20){
		$string		=	strip_tags($string);
		mb_internal_encoding("UTF-8");
		$intReviewLength = mb_strlen($string);
		if ($intReviewLength < $minLength) return $string;
		else {
			while ($minLength > 0 && mb_substr($string, $minLength, 1) != ' ') $minLength--;
			return mb_substr($string, 0, $minLength) . ' ...';
		}
		
	}
	public static function init() {
		//enter code here	
	}	
}
?>