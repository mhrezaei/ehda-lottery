<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class JsonFeed {

	//========================================================================================
    public function __construct($params=NULL)
    {
        
    }
    

	//========================================================================================
    public static function say($message , $array=NULL)
    {
		//Preparetions...
		$message	= self::predefinedFeeds($message);
		
		//Output...
		$array['message']	= $message;
		echo json_encode($array);
		die();
    }
	
	//========================================================================================
	private static function predefinedFeeds($message)
	{
		$message	= str_replace('form-fill'		, "خطا در تکمیل فرم"						,$message);
		$message	= str_replace('fill-stared'		, "تکمیل تمام بخش‌های ستاره‌دار ضروری‌ست"	,$message);
		$message	= str_replace('error-loading'	, "بروز خطا در دریافت اطلاعات"				,$message);
		$message	= str_replace('error-saving'	, "بروز خطا در ذخیره‌سازی اطلاعات"			,$message);
		$message	= str_replace('restricted'		, "دسترسی غیرمجاز"							,$message);
		$message	= str_replace('forbidden'		, "دسترسی غیرمجاز"							,$message);
		$message	= str_replace('unknown'			, "بروز خطای غیرمنتظره"						,$message);
		$message	= str_replace('secCode'			, "کد امنیتی درست نیست"						,$message);
		$message	= str_replace('done'			, "انجام شد"								,$message);
		$message	= str_replace('session-expired'	, "لطفاً دوباره وارد شوید"					,$message);
		
		
		return $message ; 
		
	}

}

?>