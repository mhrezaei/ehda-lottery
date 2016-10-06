<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	//required CI Sessions library!

class TSessions {

	//========================================================================================
    public function __construct($params=NULL)
    {
        
    }
    
	//============================================================
	public static function set($key , $value)
	{
		$Session = self::makeInstance() ; 
		$Session->set_userdata($key,$value);
		return ; 
	}
	
	//============================================================
	public static function get($key)
	{
		$Session = self::makeInstance() ; 
		return $Session->userdata($key) ;
	}

	//============================================================
	public static function destroy($key) 
	{
		$Session = self::makeInstance() ; 
		$Session->unset_userdata($key);
		return ; 
	}


	//============================================================
	public static function makeInstance()
	{
		$CI			=& get_instance()				;
		$Session	= $CI->session					;
		
		return $Session ; 
	}

   
 }
?>
