<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//=================================================================================
function thml_opener()
{
	echo '<!DOCTYPE html>'."\n"
		.'<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">'."\n"
		.'<html dir="rtl">'."\n"
		.'<head>'."\n"	;
}

//=================================================================================
function thtml_headClose($bodyProperties=NULL)
{
	?>
	<script type="text/javascript">
		function base_url($additive) 
		{
			if($additive) 
				return "<?php echo base_url() ; ?>" + $additive ; 
			else
				return "<?php echo base_url() ; ?>" ; 
		}
		function zero() 
		{
			return "<?php $CI =& get_instance(); echo $CI->encrypt->encode('0'); ?>" ;
		}
	</script>
	</head>
	<body <?php echo $bodyProperties ?>>
	
	<?php 
	return;
	echo "<script type='text/javascript'>function base_url() { return '".base_url()."'; }</script>\n" ; 
	echo "</head>\n" ; 
	echo "<body $bodyProperties >\n" ; 
}

function thtml_closer()
{
	echo "</body>\n</html>\n" ;
}

//=================================================================================
function thtml_meta($name = "" , $content = "" , $type = "name" , $newline = "\n")
{
	echo meta($name , $content , $type , $newline);
}

//=================================================================================
function thtml_title($title=NULL)
{
	echo "<title>$title</title>\n" ; 
}

//=================================================================================
function thtml_stylesheet($address=NULL)
{
	
	echo '<link rel="stylesheet" type="text/css" href="' ; 
	echo base_url("assets/".$address.".css")	;
	echo '">' ; 
	echo "\n"	;

}
//=================================================================================
function thtml_javascript($address=NULL)
{
	echo '<script type="text/javascript" src="' ; 
	echo base_url("assets/".$address.".js")	;
	echo '"></script>'	;
	echo "\n"	;

}


//=================================================================================
function thtml_modalOpener($modalId , $modalTitle , $size=NULL)
{
	if($size=="large")
		$sizeClass = "modal-lg" ; 
	elseif($size=="small")
		$sizeClass = "modal-sm" ; 
	else
		$sizeClass = NULL;
	
	?>
	<div id="<?php echo $modalId; ?>" class="modal fade">
		<div class="modal-dialog <?php echo $sizeClass ; ?>">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 id="<?php echo $modalId; ?>-title" class="modal-title"><?php echo $modalTitle ?></h4>
				</div>
	<?php
	
}

//=================================================================================
function thtml_modalCloser()
{
	?>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<?php 

}
?>