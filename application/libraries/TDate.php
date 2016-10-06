<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//a promotion for pDate 1.2.1, developped to be used with CodeIgniter and easier call-back functions.
//<a href="http://gnu.org/copyleft/gpl.html" target="_blank">http://gnu.org/copyleft/gpl.html</a> 


class TDate {
	
	//Original Variables...
	private	$weekNames	= array('شنبه','یکشنبه','دوشنبه','سه‌شنبه','چهارشنبه','پنج‌شنبه','جمعه');
	private $monthNames	= array('','فروردین','اردیبهشت','خرداد','تیر','مرداد','شهریور','مهر','آبان','آذر','دی','بهمن','اسفند');
	private $monthDays	= array(0, 31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29);
	
	//developped variables...
	private $timestamp 						; 
	private $isBlank 			= false 	; 
	private $stamp 							;
	
	private	$scriptTimeZone		=	0		;
	private	$userTimeZone		=	0		;
	private	$defaultFormat		= array("fa"=>"j M Y" , "en"=>"j M Y");
	
	#####################################
	#		DEVELOPPED FUNCTIONS		#
	#####################################
	
	//======================================================================================================= 
	public function TDate($stamp=NULL , $userZone=NULL , $scriptZone=NULL)
	{
		$this->stamp = $stamp ; 
		if($stamp      === NULL ) $stamp 		= time() ; 
	
		//Loading default variables...
		if($stamp=="BLANK" || !$stamp) {
			$stamp = NULL ;
			$this->isBlank = true ; 
		}
		
		if($userZone   === NULL	) $userZone		= $this->userTimeZone 	; 
		if($scriptZone === NULL ) $scriptZone	= $this->scriptTimeZone	; 
	
		$this->timestamp['server'] = $stamp ; 
		$this->timestamp['script'] = $this->giveStamp("script") ; 
		$this->timestamp['user'  ] = $this->giveStamp("user"  ) ; 
	}

	//========================================================================================
	private function giveStamp($zone="script" , $oldStamp=NULL)
	{
		if($oldStamp===NULL)
			$oldStamp = $this->timestamp['server'] ; 
	
		switch($zone) {
			case "server" :
				return $oldStamp ; 
			case "script" : 
				return $oldStamp + $this->scriptTimeZone ; 
			case "user"   : 
				return $oldStamp + $this->scriptTimeZone ; 
			default       : 
				return $oldStamp + $zone ; 
		}
	
	}

	//========================================================================================
	public function show($format=NULL , $lang="fa" , $zone="script") 
	{
		//interlock
		if($this->isBlank) return "" ; 
	
		//Preparetions...
		$lang = strtolower($lang) ; 
		$zone = strtolower($zone) ; 
		if($format===NULL) 
			$format	= $this->defaultFormat[$lang]; 

		$requestedTime = $this->giveStamp($zone) ; 
		
		//Showing...
		if($lang=="fa")
			return $this->pDate($format, $this->timestamp[$zone]) ; 
		elseif($lang=="en")
			return date ($format, $this->timestamp[$zone]) ; 
	}

	//========================================================================================
	public function relative($lang="fa" , $now=NULL , $zone="script")
	{
		//Preparetions...
		$lang = strtolower($lang) ; 
		$zone = strtolower($zone) ; 
		if($now===NULL) $now = time() ; 
	
		$requestedTime = $this->giveStamp($zone) ; 
		$now           = $this->giveStamp($zone,$now) ; 
		
		$format	= $this->defaultFormat[$lang]; 
			
		//Showing...
		if($lang=="fa") 
			return $this->relative_fa($requestedTime , $now) ; 
		if($lang=="en") 
			return $this->relative_en($requestedTime , $now) ; 
	}
	
	//-----------------------------------------------------------------
	private function relative_fa($stamp , $now) 
	{
		$secconds = $now - $stamp ; 
		
		//return $secconds ; 
		if($secconds==0) return "هم‌اکنون" ;
		
		if($secconds>0) {
			$minutes = round($secconds/60) ; 
			if(!$minutes) return "لحظاتی پیش" ; 
			if($minutes<25) return "$minutes دقیقه پیش" ; 
			if($minutes<35) return "نیم ساعت پیش" ; 
			if($minutes<50) return "$minutes دقیقه پیش" ; 
		
			$hours = round($minutes/60) ; 
			if($minutes<1410) return "$hours ساعت پیش" ; 
			
			$days = round($secconds / 86400) ;
			if(!$days) return "امروز" ; 
			if($days==1) return "دیروز" ;
			if($days<7) return "$days روز پیش" ; 
			
			$weeks = round($days/7) ; 
			if(!$weeks) return "همین هفته" ; 
			if($weeks==1) return "یک هفته پیش" ;
			if($weeks<=4) return "$weeks هفته پیش" ; 
		
			$months = round($days/30) ; 
			if($months<=1) return "یک ماه پیش" ; 
			if($months<11) return "$months ماه پیش" ;
			
			$years = round($days/365) ;
			if($years<=1) return "پارسال" ;
			if($years>40) return "هرگز" ; 
			return "$years سال پیش" ; 
		}
		if($secconds<0) {
			$secconds = abs($secconds) ; 
		
			$minutes = round($secconds/60) ; 
			if(!$minutes) return "لحظاتی دیگر" ; 
			if($minutes<25) return "$minutes دقیقه بعد" ; 
			if($minutes<35) return "نیم ساعت بعد" ; 
			if($minutes<50) return "$minutes دقیقه بعد" ; 
		
			$hours = round($minutes/60) ; 
			if($minutes<1410) return "$hours ساعت بعد" ; 
			
			$days = round($secconds / 86400) ;
			if(!$days) return "امروز" ; 
			if($days==1) return "فردا" ;
			if($days==2) return "پس‌فردا" ; 
			if($days<7) return "$days روز بعد" ; 
			
			$weeks = round($days/7) ; 
			if(!$weeks) return "همین هفته" ; 
			if($weeks==1) return "یک هفته بعد" ;
			if($weeks<=4) return "$weeks هفته بعد" ; 
		
			$months = round($days/30) ; 
			if($months<=1) return "یک ماه بعد" ; 
			if($months<11) return "$months ماه بعد" ;
			
			$years = round($days/365) ;
			if($years<=1) return "یک سال بعد" ;
			return "$years سال بعد" ; 
		}
		
		
			
	}
	
	//-----------------------------------------------------------------
	private function relative_en($stamp , $now) 
	{
		$secconds = $now - $stamp ; 
		//return $secconds ; 
		
		if($secconds==0) return "Now" ;
		
		if($secconds>0) {
			$minutes = round($secconds/60) ; 
			if(!$minutes) return "a few moments ago" ; 
			if($minutes<25) return "$minutes minutes ago" ; 
			if($minutes<35) return "half an hour ago" ; 
			if($minutes<50) return "$minutes minutes ago" ; 
		
			$hours = round($minutes/60) ; 
			if($minutes<1410) return "$hours hours ago" ; 
			
			$days = round($secconds / 86400) ;
			if(!$days) return "today" ; 
			if($days==1) return "yesterday" ;
			if($days<7) return "$days days ago" ; 
			
			$weeks = round($days/7) ; 
			if(!$weeks) return "this week" ; 
			if($weeks==1) return "last week" ;
			if($weeks<=4) return "$weeks weeks ago" ; 
		
			$months = round($days/30) ; 
			if($months<=1) return "last month" ; 
			if($months<11) return "$months months ago" ;
			
			$years = round($days/365) ;
			if($years<=1) return "last year" ;
			if($years>40) return "Never" ; 
			return "$years years ago" ; 
		}
		if($secconds<0) {
			$secconds = abs($secconds) ; 
		
			$minutes = round($secconds/60) ; 
			if(!$minutes) return "in a few moments" ; 
			if($minutes<25) return "in next $minutes minutes" ; 
			if($minutes<35) return "in half an hour" ; 
			if($minutes<50) return "in next $minutes minutes" ; 
		
			$hours = round($minutes/60) ; 
			if($minutes<1410) return "in next $hours hours" ; 
			
			$days = round($secconds / 86400) ;
			if(!$days) return "today" ; 
			if($days==1) return "tomorrow" ;
			if($days==2) return "the day after tomorrow" ; 
			if($days<7) return "in $days days" ; 
			
			$weeks = round($days/7) ; 
			if(!$weeks) return "this week" ; 
			if($weeks==1) return "next week" ;
			if($weeks<=4) return "in $weeks weeks" ; 
		
			$months = round($days/30) ; 
			if($months<=1) return "next month" ; 
			if($months<11) return "in $months months" ;
			
			$years = round($days/365) ;
			if($years<=1) return "next year" ;
			return "in $years years" ; 
		}
		
		
			
	}

	//========================================================================================
	public function fullShow($format=NULL , $lang="fa" , $now=NULL , $zone="script")
	{
		if(!$this->stamp)
			return "هرگز" ; 
		else
			return $this->relative($lang , $now , $zone)." (".$this->show($format , $lang , $zone).") ";
	}

	//========================================================================================
	public function getDayFirst()
	{
		$stamp	= $this->stamp	;
		return mktime(0,0,0,	date("n",$stamp),date("j",$stamp),date("y",$stamp))	+0;
	}

	//========================================================================================
	public function getMonthFirst()
	{
		$gregorian = $this->jalali_to_gregorian($this->show("Y"), $this->show("n"), 1	)	;
		return	mktime(0,0,0,	$gregorian[1]	,$gregorian[2]	,$gregorian[0]	)	;
	}

	//========================================================================================
	public function getYearFirst()
	{
		$gregorian = $this->jalali_to_gregorian($this->show("Y"), 1, 1					)	;
		return	mktime(0,0,0,	$gregorian[1]	,$gregorian[2]	,$gregorian[0]	)	;
	}
	

	#####################################
	#		STATIC FUNCTIONS			#
	#####################################

	//========================================================================================
	public static function duration($stamp1 , $stamp2=0 , $lang="fa")
	{
		if($lang=="en") 
			return self::duration_en($stamp1 , $stamp2) ; 

		$gap	= abs($stamp1 - $stamp2)	;
		
		if($gap<5)		return "ناچیز"				;
		if($gap<50)		return "کم‌تر از یک دقیقه"	;
		
		$gap	= round($gap/60);
		
		if($gap<55)		return $gap." دقیقه "		;
		
		$hours	= floor($gap/60);
		$mins	= $gap%60		;
		
		if($mins<5)
			return	"$hours ساعت"					;
		else
			return "$hours ساعت و $mins دقیقه"		;
			
	}	
	
	//---------------------------------------------------------------
	public static function duration_en($stamp1 , $stamp2)
	{
		$gap	= abs($stamp1 - $stamp2)	;
		
		if($gap<5)		return "Negligible"				;
		if($gap<50)		return "Less than a minute"	;
		
		$gap	= round($gap/60);
		
		if($gap<55)		return $gap." minute(s) "		;
		
		$hours	= floor($gap/60);
		$mins	= $gap%60		;
		
		if($mins<5)
			return	"$hours hours"					;
		else
			return "$hours hour(s) and $mins minute(s)"		;
	}
	
	//=======================================================================================================
	public static function handleTime($value , $zone="script" , $mode=NULL)
	{
		
		//making stamp...
		$valueArray = TDate::parser($value , "/") ; 
		if($mode=="end") {
			$h = 23 ; $i = 59 ; $s = 59 ; 
		}
		$stamp = mktime($h,$i,$s,$valueArray[2]+0,$valueArray[3]+0,$valueArray[1]+0) ; 
		
		//Change Time Zone...
		switch($zone) {
			case "server" :
				$stamp += 0 ; 
				break ;
			case "script" :
				$stamp = $stamp - $GLOBALS['tdate']['ScriptTimeZone'] ; 
				break ;
			case "user" :
				$stamp = $stamp - $GLOBALS['tdate']['UserTimeZone'] ; 
				break ;
			default:
				$stamp = $stamp - $zone ; 
		}
		return $stamp ; 
	}

	//========================================================================================
	public static function parser($items , $parser="|")
	{
		//Preparetions...
		if(substr($items,-1)!=$parser)
			$items.=$parser ; 
		
		$i      = 0 ; 
		$Stack  = 'START' ; 
		$Result = NULL ; 
		
		while($Stack != '') {
			$i++ ; 
			$Pos   = strpos($items , $parser) ; 
			$Stack = substr($items , 0 , $Pos) ; 
			$Result[$i] = $Stack ; 
			$items = substr($items , $Pos+1 , strlen($items)) ; 
		}
		$Result[Total] = $i-1 ; 
		return $Result ; 
	}

	//========================================================================================
	public static function WeekDay($inlet , $mode="d2e") 
	{
		switch($mode){
			case "d2e":
				switch($inlet){
					case 1: return "Sat";
					case 2: return "Sun";
					case 3: return "Mon";
					case 4: return "Tue";
					case 5: return "Wed";
					case 6: return "Thu";
					case 7: return "Fri";
				}
				
			case "d2f":
				switch($inlet){
					case 1: return "شنبه";
					case 2: return "یکشنبه";
					case 3: return "دوشنبه";
					case 4: return "سه‌شنبه";
					case 5: return "چهارشنبه";
					case 6: return "پنج‌شنبه";
					case 7: return "جمعه";
				}
			
		}
	}
	
	#####################################
	#	ORIGINAL pdate FUNCTIONS		#
	#####################################

	//======================================================================================================= 
	private function pdate($format, $timestamp= '')
	{
		if($timestamp === '')
			$timestamp= time();
	
	# Create need date parametrs
	date_default_timezone_set('Asia/Tehran');
	$date= date('Y-m-d-w', $timestamp);
	list($gYear, $gMonth, $gDay, $gWeek)= explode ('-', $date);
	list($pYear, $pMonth, $pDay)= $this->gregorian_to_jalali($gYear, $gMonth, $gDay);
	$pWeek= ($gWeek + 1);

		if($pWeek == 7)
		{
			$pWeek= 0;
		}

	$lenghFormat= strlen($format);
	$i= 0;
	$result= '';

		while($i < $lenghFormat)
		{
			$par= $format{$i};
				if($par == '\\')
				{
					$result.= $format{++$i};
					$i++;
					continue;
				}
				switch($par)
				{
					# Day
					case 'd':
						$result.= (($pDay < 10) ? '0' . $pDay : $pDay);
					break;
					
					case 'D':
						$result.= substr($this->weekNames[$pWeek], 0, 2);
					break;
					
					case 'j':
						$result.= $pDay;
					break;
					
					case 'l':
						$result.= $this->weekNames[$pWeek];
					break;
					
					case 'N':
						$result.= $pWeek+1;
					break;
					
					case 'w':
						$result.= $pWeek;
					break;
					
					case 'z':
						$result.= $this->dayOfYear($pYear, $pMonth, $pDay);
					break;
					
					case 'S':
						$result.= "م";
					break;
					
					# Week
					case 'W':
						$result.= ceil($this->dayOfYear($pYear, $pMonth, $pDay) / 7);
					break;
					
					# Month
					case 'F':
						$result.= $this->monthNames[$pMonth];
					break;
					
					case 'm':
						$result.= (($pMonth < 10) ? '0' . $pMonth : $pMonth);
					break;
					
					case 'M':
						$result.= $this->monthNames[$pMonth];
					break;
					
					case 'n':
						$result.= $pMonth;
					break;
					
					case 't':
						$result.= (($this->isKabise($pYear) and $pMonth == 12) ? 30 : $this->monthDays[$pMonth]);
					break;
					
					# Years
					case 'L':
						$result.= (int)$this->isKabise($pYear);
					break;
					
					case 'Y':
					case 'o':
						$result.= $pYear;
					break;
					
					case 'y':
						$result.= substr($pYear, 2);
					break;
					
					# Time
					case 'a':
					case 'A':
						if(date('a', $timestamp) == 'am')
						{
							$result.= ($par == 'a') ? 'ق.ظ' : 'قبل از ظهر';
						}
						else{
							$result.= ($par == 'a') ? 'ب.ظ':'بعد از ظهر';
						}
					break;
					
					case 'B':
					case 'g':
					case 'G':
					case 'h':
					case 'H':
					case 's':
					case 'u':
					case 'i':

					# Timezone
					case 'e':
					case 'I':
					case 'O':
					case 'P':
					case 'T':
					case 'Z':
							$result.= date($par, $timestamp);
					break;

					# Full Date/Time
					case 'c':
							$result.= $pYear . '-' . $pMonth . '-' . $pDay . 'T' . date('H::i:sP', $timestamp);
					break;

					case 'r':
							$result.= substr($this->weekNames[$pWeek],0,2) . '، ' . $pDay . ' ' . $this->monthNames[$pMonth] . ' ' . $pYear . ' ' . date('H::i:s P', $timestamp);
					break;

					case 'U':
							$result.= $timestamp;
					break;

					default:
					$result.= $par;
				}
			$i++;
		}

	return $result;
}

	//=======================================================================================================
	private function pstrftime($format, $timestamp= '')
	{

			if($timestamp === '')
			{
				$timestamp= time();
			}

		# Create need date parametrs
		$date= date('Y-m-d-w', $timestamp);
		list($gYear, $gMonth, $gDay, $gWeek)= explode ('-', $date);
		list($pYear, $pMonth, $pDay)= $this->gregorian_to_jalali($gYear, $gMonth, $gDay);
		$pWeek= ($gWeek + 1);
		
			if($pWeek==7)
			{
				$pWeek= 0;
			}

		$lenghFormat= strlen($format);
		$i= 0;
		$result= '';

			while($i < $lenghFormat)
			{
				$par= $format{$i};
					if($par == '%')
					{
						$type= $format{++$i};
						switch($type)
						{
							# Day
							case 'a':
								$result.= substr($this->weekNames[$pWeek], 0, 2);
							break;

							case 'A':
								$result.= $this->weekNames[$pWeek];
							break;

							case 'd':
								$result.= (($pDay < 10) ? '0' . $pDay : $pDay);
							break;

							case 'e':
								$result.= $pDay;
							break;

							case 'j':
								$dayinM= $this->dayOfYear($pYear, $pMonth, $pDay);
								$result.= (($dayinM < 10) ? '00' . $dayinM : (($dayinM < 100) ? '0' . $dayinM : $dayinM));
							break;

							case 'u':
								$result.= ($pWeek + 1);
							break;

							case 'w':
								$result.= $pWeek;
							break;

							# Week
							case 'U':
								$result.= floor($this->dayOfYear($pYear, $pMonth, $pDay) / 7);
							break;

							case 'V':
							case 'W':
								$result.= ceil($this->dayOfYear($pYear, $pMonth, $pDay) / 7);
							break;

							# Month
							case 'b':
							case 'h':
								$result.= $this->monthNames[$pMonth];
							break;

							case 'B':
								$result.= $this->monthNames[$pMonth];
							break;

							case 'm':
								$result.= (($pMonth < 10) ? '0' . $pMonth : $pMonth);
							break;

							# Year
							case 'C':
								$result.= ceil($pYear / 100);
							break;

							case 'g':
							case 'y':
								$result.= substr($pYear, 2);
							break;

							case 'G':
							case 'Y':
								$result.= $pYear;
							break;

							# Time
							case 'H':
							case 'I':
							case 'l':
							case 'M':
							case 'R':
							case 'S':
							case 'T':
							case 'X':
							case 'z':
							case 'Z':
								$result.= strftime('%' . $type, $timestamp);
							break;

							case 'p':
							case 'P':
							case 'r':
								if(date('a', $timestamp) == 'am')
								{
									$result.= ($type == 'p') ? 'ق.ظ' : (($type == 'P') ? 'قبل از ظهر' : strftime("%I:%M:%S قبل از ظهر", $timestamp));
								}
								else{
									$result.= ($type=='p')?'ب.ظ':(($type=='P')?'بعد از ظهر':strftime("%I:%M:%S بعد از ظهر", $timestamp));
								}
							break;
							
							# Time and Date Stamps
							case 'c':
								$result.= substr($this->weekNames[$pWeek], 0, 2) . ' ' . $this->monthNames[$pMonth] . ' ' . $pDay . ' ' . strftime("%T", $timestamp) . ' ' . $pYear;
							break;
							
							case 'D':
							case 'x':
								$result.= (($pMonth < 10) ? '0' . $pMonth : $pMonth) . '/' . (($pDay < 10) ? '0' . $pDay : $pDay) . '/' . substr($pYear, 2);
							break;
							
							case 'F':
								$result.= $pYear . '-' . (($pMonth < 10) ? '0' . $pMonth:$pMonth) . '-' . (($pDay < 10) ? '0' . $pDay : $pDay);
							break;
							
							case 's':
								$result.= $timestamp;
							break;
							
							# Miscellaneous
							case 'n':
								$result.= "\n";
							break;
							
							case 't':
								$result.= "\t";
							break;
							
							case '%':
								$result.= '%';
							break;
							
							default: $result.= '%'.$type;
							
							
						}
					}
					else
					{
						$result.= $par;
					}
				$i++;
			}

		return $result;
	}

	//=======================================================================================================
	private function dayOfYear($pYear, $pMonth, $pDay)
	{
		$days= 0;

			for($i= 1; $i < $pMonth; $i++)
			{
				$days+= $this->monthDays[$i];
			}

		return $days+$pDay;
	}

	//=======================================================================================================
	private function isKabise($year)
	{
		$mod= $year % 33;

			if($mod == 1 or $mod == 5 or $mod == 9 or $mod == 13 or $mod == 17 or $mod == 22 or $mod == 26 or $mod == 30)
			{
				return 1;
			}

		return 0;
	}

	//=======================================================================================================
	private function pmktime($hour= 0, $minute= 0, $second= 0, $month= 0, $day= 0, $year= 0, $is_dst= -1)
	{
		
			if($hour==0 && $minute==0 && $second==0 && $month==0 && $day==0 && $year==0)
			{
				return time();
			}

		list($year, $month, $day)=$this->jalali_to_gregorian($year, $month, $day);
		return mktime($hour, $minute, $second, $month, $day, $year, $is_dst);
	}

	//=======================================================================================================
	private function pcheckdate($month, $day, $year)
	{

			if($month < 1 || $month > 12 || $year < 1  || $year > 32767 || $day < 1)
			{
				return 0;
			}

			if($day > $this->monthDays[$month])
			{
				if($month != 12 || $day != 30 || !$this->isKabise($year))
				{
					return 0;
				}
			}

		return 1;
	}

	//=======================================================================================================
	private function pgetdate($timestamp= '')
	{

			if($timestamp=== '')
				$timestamp=mktime();
		list($seconds, $minutes, $hours, $mday, $wday, $mon, $year, $yday, $weekday, $month)= explode('-', $this->pdate('s-i-G-j-w-n-Y-z-l-F', $timestamp));
		return array(0=>$timestamp, 'seconds'=>$seconds, 'minutes'=>$minutes, 'hours'=>$hours, 'mday'=>$mday, 'wday'=>$wday, 'mon'=>$mon, 'year'=>$year, 'yday'=>$yday, 'weekday'=>$weekday,	'month'=>$month,);
	}

	//=======================================================================================================
	private function div($a, $b)
	{
		return (int)($a / $b);
	}

	//=======================================================================================================
	private function gregorian_to_jalali($g_y, $g_m, $g_d) 
	{
		$g_days_in_month = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31); 
		$j_days_in_month = array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29);     
		$gy = $g_y-1600; 
		$gm = $g_m-1; 
		$gd = $g_d-1; 
		$g_day_no = 365*$gy+$this->div($gy+3,4)-$this->div($gy+99,100)+$this->div($gy+399,400); 
		
		for ($i=0; $i < $gm; ++$i)
		$g_day_no += $g_days_in_month[$i]; 
		
		if ($gm>1 && (($gy%4==0 && $gy%100!=0) || ($gy%400==0))) 
		/* leap and after Feb */ 
		$g_day_no++; 
		$g_day_no += $gd; 
		$j_day_no = $g_day_no-79; 
		$j_np = $this->div($j_day_no, 12053); /* 12053 = 365*33 + 32/4 */ 
		$j_day_no = $j_day_no % 12053; 
		$jy = 979+33*$j_np+4*$this->div($j_day_no,1461); /* 1461 = 365*4 + 4/4 */ 
		$j_day_no %= 1461;

			if($j_day_no >= 366)
			{ 
				$jy+= $this->div($j_day_no - 1, 365); 
				$j_day_no= ($j_day_no - 1) % 365; 
			} 

		for($i = 0; $i < 11 && $j_day_no >= $j_days_in_month[$i]; ++$i)
		$j_day_no -= $j_days_in_month[$i];
		$jm = $i+1;
		$jd = $j_day_no+1;
		return array($jy, $jm, $jd);
	}

	//=======================================================================================================
	private function jalali_to_gregorian($j_y, $j_m, $j_d) 
	{ 

		$g_days_in_month = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31); 
		$j_days_in_month = array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29);

		$jy = $j_y-979;
		$jm = $j_m-1;
		$jd = $j_d-1;
	   $j_day_no = 365*$jy + $this->div($jy, 33)*8 + $this->div($jy%33+3, 4); 

	   for($i=0; $i < $jm; ++$i) 
	      $j_day_no += $j_days_in_month[$i]; 

	   $j_day_no += $jd; 

	   $g_day_no = $j_day_no+79; 

	   $gy = 1600 + 400*$this->div($g_day_no, 146097); /* 146097 = 365*400 + 400/4 - 400/100 + 400/400 */ 
	   $g_day_no = $g_day_no % 146097; 

	   $leap= 1; 
	   if ($g_day_no >= 36525) /* 36525 = 365*100 + 100/4 */ 
	   { 
	      $g_day_no--; 
	      $gy += 100*$this->div($g_day_no,  36524); /* 36524 = 365*100 + 100/4 - 100/100 */ 
	      $g_day_no = $g_day_no % 36524; 

	      if ($g_day_no >= 365) 
	         $g_day_no++; 
	      else 
	         $leap = 0; 
	   } 

		$gy += 4*$this->div($g_day_no, 1461); /* 1461 = 365*4 + 4/4 */ 
		$g_day_no %= 1461; 

			if($g_day_no >= 366)
			{
			$leap= 0;
			$g_day_no--;
			$gy += $this->div($g_day_no, 365);
			$g_day_no = $g_day_no % 365;
			}

		for($i = 0; $g_day_no >= $g_days_in_month[$i] + ($i == 1 && $leap); $i++)
		$g_day_no -= $g_days_in_month[$i] + ($i == 1 && $leap); 
		$gm = $i+1; 
		$gd = $g_day_no+1; 

		return array($gy, $gm, $gd); 
	}

		
	
}

?>