<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SecCode {

	/*	HOW TO USE:

	make an instance, supplying language code ('fa' and 'en' supported only).
	public properties $question and $ansKey are generated immediately:
		$question is what you should show to the user.
		$ansKey is what you should send to server via a hidden field.
	
	on the server side, call the function: SecCode::serverSideCheck($userAnswer , $key) 
		(no need to make an instance)
	
	Version 1: 1391/03/01 : TAHA M KAMKAR 
	*/

	public		$question	; 
	public		$ansKey		;
	private		$mask		;
	private		$lang		;
	private		$answer		;
	private		$n1			;
	private		$n2			;
	private		$c1			;
	private		$c2			;
	private		$session	;
	
	//========================================================================================
    public function __construct($params=NULL)
    {
    	
		$CI				=& get_instance()				;
		$this->session	= $CI->session					;
    }

   	//=================================================================
   	public function generate($lang="fa")
   	{
		
		$this->lang		= strtolower($lang)				;
		
		$this->n1		= rand(1,10)					;
		$this->n2		= rand(1,10)					;
		$this->c1		= $this->n2c($this->n1)			;
		$this->c2		= $this->n2c($this->n2)			;
		
		if(!$this->lang)	$this->lang	= "fa"			;
			
		$this->makeUniqueKey()							;
		$this->makeQuestion()							;
		$this->loadToSession()							;
        
		
   	}

 	//=================================================================
	private function loadToSession()
	{
		$key			= "secKey".$this->ansKey 	;
//		$key			= $this->ansKey			;
		
//		$value[]		= $this->session->userdata("secCode");
//		$value[$key]	= $this->mask			;
		 
		$this->session->set_userdata($key , $this->mask);
//		$this->session->set_userdata($value)	;
		
	}
	
	//=================================================================
	private function makeUniqueKey()
	{
		while(true) {
			$key = rand(1,32000) ; 
			if(!$this->session->userdata($key)) break;
		}
		
		$this->ansKey = $key ; 
	}	
	
	//=================================================================
	private function makeQuestion()
	{
		$choice = rand(1,2) ;
		
		switch($choice) {
			case 1 :
				$answer	= $this->n1 + $this->n2 ;
				break ; 
			case 2 :
				$answer	= $this->n1 * $this->n2 ;
				break ; 
				
		}
		
		switch($this->lang) {
			case "fa" :
				$choice = str_replace(1  , " به‌علاوه‌ی "	, $choice) ; 
				$choice = str_replace(2  , " ضرب‌در "		, $choice) ;
				$sign   = " چند می‌شود؟ " ;  
				break ; 

			case "en" :
				$choice = str_replace(1 , "plus"			, $choice) ; 
				$choice = str_replace(2  , "multiplied by"	, $choice) ; 
				$sign   = "?" ;  
				break ; 
		}
		
		$this->question	= $this->c1 ." $choice ". $this->c2 . $sign ;
		$this->answer	= $answer			;
		$this->mask		= md5($answer)		;
	}

	
	//=================================================================
	private function n2c($number) 
	{
	
		switch($this->lang) {
			case "fa" :
				$number = str_replace(10 , "ده"		, $number) ; 
				$number = str_replace(0  , "صفر"	, $number) ; 
				$number = str_replace(1  , "یک"		, $number) ; 
				$number = str_replace(2  , "دو"		, $number) ; 
				$number = str_replace(3  , "سه"		, $number) ; 
				$number = str_replace(4  , "چهار"	, $number) ; 
				$number = str_replace(5  , "پنج"	, $number) ; 
				$number = str_replace(6  , "شش"		, $number) ; 
				$number = str_replace(7  , "هفت" 	, $number) ; 
				$number = str_replace(8  , "هشت" 	, $number) ; 
				$number = str_replace(9  , "نه" 	, $number) ; 
				break ;
				
			case "en" :
				$number = str_replace(10 , "ten"	, $number) ; 
				$number = str_replace(0  , "zero"	, $number) ; 
				$number = str_replace(1  , "one"	, $number) ; 
				$number = str_replace(2  , "two"	, $number) ; 
				$number = str_replace(3  , "three"	, $number) ; 
				$number = str_replace(4  , "four"	, $number) ; 
				$number = str_replace(5  , "five"	, $number) ; 
				$number = str_replace(6  , "six"	, $number) ; 
				$number = str_replace(7  , "seven" 	, $number) ; 
				$number = str_replace(8  , "eight" 	, $number) ; 
				$number = str_replace(9  , "nine" 	, $number) ; 
				break ;
		}
			
		
		return $number ; 
		
	}

	//---------------------------------------------------
	//--------	NON-OOP ACCESS...
	//---------------------------------------------------
	
	
	//=================================================================
	public static function check($userAnswer , $key)
	{
		//Receiving....
		$userAnswer	+= 0 ; 
		$key		+= 0 ;
		$Session	= getSession(); 
		
		//Interlock...
		if(!$userAnswer || !$key) return false ; 
	
		//Checking...
		$key		 = "secKey".$key ; 
		
		if($Session->userdata($key)==md5($userAnswer)) {
			return true ; 
		}
		else
			return false ;
		
	}
	
	//=================================================================
	public static function destroy($key)
	{
		$Session = getSession() ; 
		$Session->unset_userdata($key);
	}
	
	//=================================================================
	public static function destroyAll()	
	{
		$Session = getSession() ; 
		foreach($Session->all_userdata() as $key => $value)
		{
			if(strstr($key,"secKey"))
				$Session->unset_userdata($key);
		}
	}
	

}   
?>