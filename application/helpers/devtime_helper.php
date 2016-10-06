<?php

	//========================================================================================
	function g($data)
	{
		?><pre class="errors" dir="ltr"><?php
		print_r($data) ; 
		?></pre><?php
	}

	function gd($data)
	{
		g($data) ; die() ; 
	}


  
?>