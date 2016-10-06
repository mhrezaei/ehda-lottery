<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Strings {

	//========================================================================================
    public function __construct($params=NULL)
    {
        
    }

	//========================================================================================
	public static function charLimit($string , $length , $fromEnd=false)
	{
		mb_internal_encoding("UTF-8");
		
		$string	= strip_tags($string) ; //safety
		
		if($fromEnd) {
			$newString = mb_substr($string , -$length , $length) ; 
			if($newString!=$string)	$newString = "...".$newString ; 
		}
		else {
			$newString = mb_substr($string , 0 , $length) ; 
			if($newString!=$string)	$newString .= "..." ; 
		}
			
		return $newString ;
	}


	//========================================================================================
	public static function randomString($length=20 , $chars="1234567890abcdefghijklmnopqrstuvwxyz") 
	{
	
		$result = NULL ; 
		while(strlen($result) < $length) {
			$result .= $chars[mt_rand(0, strlen($chars)-1)];
		}
		return $result; 
	
	}

	//========================================================================================
	public static function removeLastChar($string , $lastChar)
	{
		$string = trim($string) ; 
		if(substr($string , -2)==$lastChar) 
			$string = substr_replace($string ,"",-2);
		if(substr($string , -1)==$lastChar) 
			$string = substr_replace($string ,"",-1);
	
		return $string ; 
	}
	
	//========================================================================================
	public static function parse($items , $parser="|" , $NT=false)
	{
		//Preparetions...
		$items = trim($items) ; 
		
		if(substr($items,-1)!=$parser)
			$items.=$parser ;
			
		if($items[0]==$parser)
			$items = substr($items,1) ;  
		
		$i      = 0 ; 
		$Stack  = 'START' ; 
		$result = NULL ; 
		
		while($Stack != '') {
			$i++ ; 
			$Pos   = strpos($items , $parser) ; 
			$Stack = substr($items , 0 , $Pos) ; 
			if(trim($Stack))
				$result[$i] = trim($Stack) ; 
			$items = substr($items , $Pos+1 , strlen($items)) ; 
		}
		if(!$NT) $result['total'] = $i-1 ; 
		
		for($i=1 ; $i<=$result['total'] ; $i++) {
			$result[$i] = str_replace("+" , "&nbsp;" , $result[$i]) ; 
			$result[$i] = str_replace("+" , "&nbsp;" , $result[$i]) ; 
		}
		
		return $result ; 
	}

	
	//========================================================================================
	public static function parseCount($items , $parser="|")
	{
		$listArray = self::parse($items,$parser) ; 
		return $listArray['total'] ; 
	}

	//========================================================================================
	public static function pd($text)
	{
		$text=str_replace("1","۱",$text);
		$text=str_replace("2","۲",$text);
		$text=str_replace("3","۳",$text);
		$text=str_replace("4","۴",$text);
		$text=str_replace("5","۵",$text);
		$text=str_replace("6","۶",$text);
		$text=str_replace("7","۷",$text);
		$text=str_replace("8","۸",$text);
		$text=str_replace("9","۹",$text);
		$text=str_replace("0","۰",$text);	
		
		$text=str_replace("ي","ی",$text);	
		$text=str_replace("ك","ک",$text);	
		$text=str_replace("ك","ک",$text);	
		$text=str_replace("٤","۴",$text);	
		$text=str_replace("٦","۶",$text);	
		$text=str_replace("٥","۵",$text);	
		
		return $text ; 
	}

		//========================================================================================
	public static function ed($text)
	{
		$text=str_replace("۱","1",$text);
		$text=str_replace("۲","2",$text);
		$text=str_replace("۳","3",$text);
		$text=str_replace("۴","4",$text);
		$text=str_replace("۵","5",$text);
		$text=str_replace("۶","6",$text);
		$text=str_replace("۷","7",$text);
		$text=str_replace("۸","8",$text);
		$text=str_replace("۹","9",$text);
		$text=str_replace("۰","0",$text);	
		
		$text=str_replace("٤","4",$text);	
		$text=str_replace("٦","6",$text);	
		$text=str_replace("٥","5",$text);	
		
		return $text ; 
	}

	//========================================================================================
	public static function simpleText($text , $charLimit=0)
	{
		$text = strip_tags($text) ; 
		if($charLimit) 
			$text = self::charLimit($text , $charLimit) ;
			
		return $text ; 
	}
	
	//========================================================================================
	public static function showText($value , $class=NULL)
	{
		$class = "normalTahoma" ; 
		
//		$value = nl2br($value) ; 
		$value = html_entity_decode($value) ; 
		$value = str_replace("[AND]" , "&" , $value) ; 
		
		$value = str_replace("</p>" , "</div>"	, $value) ; 
		$value = str_replace("<p>"	, "<div>"	, $value) ; 

		return $value ; 
	}

	//========================================================================================
	public static function g($data)
	{
		?><pre class="errors" dir="ltr"><?php 
		print_r($data) ; 
		?></pre><?php
	}

	public function gd($data)
	{
		self::g($data) ; die() ; 
	}
	
	//========================================================================================
	public static function alert($text , $class=NULL)
	{
		//Preparetions...
		$die		= false				;
		$text		= self::feed($text)	;

		if(strstr($class,"DIE")) {
			$class	= str_replace("DIE",NULL,$class); 
			$die	= true	;
		}
		
		if(strstr($class,"pd")) {
			$class	= str_replace("pd",NULL,$class); 
			$text	= self::pd($text);
		}
		
		
		//Showing...
		?>
		<div class="alert alert-taha alert-<?php echo $class ?>"><?php echo $text ?></div>
		<?php 
		
		//DIE if neccessary...
		if($die) die();
	}	
	
	
	//========================================================================================
	public static function feed($code)
	{
		switch($code) 
		{
			case 'fill-all'		:	return "خطا در تکمیل فرم "					;
			case 'fill-stared'	:	return "خطا در تکمیل فرم "					;
			case 'error-loading':	return "بروز خطا در دریافت اطلاعا ت"		;
			case 'error-saving'	:	return "بروز خطا در ذخیره‌سازی اطلاعات "	;
			case 'restricted'	:	return "دسترسی غیرمجاز! "					;
			case 'unknown'		:	return "بروز خطای غیرمنتظره "				;
			case 'done'			:	return "انجام شد "							;
			
			default: 			return $code." "								; 
		}
	}

	//=================================================================
	public static function safe($value , $style=NULL)
	{
		
		//TRIM
		$value	= trim($value) ; 
		
		//ESCAPE
//		$value	= mysql_real_escape_string($value);
		
		//DATA TYPE...
		if(strstr($style  , "u"))
			$value = urldecode($value);

		if(strstr($style  , "F"))
			$value = self::pd($value);
			
		if(strstr($style , "E" ) || strstr($style , "9" ))
			$value = self::ed($value);
			
		if(strstr($style  , "9"))	
			$value += 0 ; 
		
		if(strstr($style  , "a"))
			$value = strtolower($value) ; 
		if(strstr($style  , "A"))
			$value = strtoupper($value) ; 
		 
		if(strstr($style , "L") || strstr($style , "Y")) 
			if($value) 
				$value = 1 ;
			else
				$value = 0 ; 
				
		//Return...
		return $value;
		
		
	}
	
	//=================================================================
	public static function uniord($u) {
		// i just copied this function fron the php.net comments, but it should work fine!
		$k = mb_convert_encoding($u, 'UCS-2LE', 'UTF-8');
		$k1 = ord(substr($k, 0, 1));
		$k2 = ord(substr($k, 1, 1));
		return $k2 * 256 + $k1;
	}
	
	//=================================================================
	public static function isPersian($str)
	{   
	    if(mb_detect_encoding($str) !== 'UTF-8') {
        	$str = mb_convert_encoding($str,mb_detect_encoding($str),'UTF-8');
		}
	    preg_match_all('/.|\n/u', $str, $matches);
	    $chars = $matches[0];
	    $arabic_count = 0;
	    $latin_count = 0;
	    $total_count = 0;
	    foreach($chars as $char) {
	        //$pos = ord($char); we cant use that, its not binary safe 
	        $pos = self::uniord($char);
	        //echo $char ." --> ".$pos.PHP_EOL;

	        if($pos >= 1536 && $pos <= 1791) {
	            $arabic_count++;
	        } else if($pos > 123 && $pos < 123) {
	            $latin_count++;
	        }
	        $total_count++;
	    }
	    if(($arabic_count/$total_count) > 0.6) {
	        // 60% arabic chars, its probably arabic
	        return true;
	    }
	    return false;

	}


}

?>