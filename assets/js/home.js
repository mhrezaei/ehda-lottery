$(document).ready(function(){
	initSize();
});

String.prototype.replaceAll = function(
	strTarget, // The substring you want to replace
	strSubString // The string you want to replace in.
){
	var strText = this;
	var intIndexOfMatch = strText.indexOf( strTarget );

	// Keep looping while an instance of the target string
	// still exists in the string.
	while (intIndexOfMatch != -1){
		// Relace out the current instance.
		strText = strText.replace( strTarget, strSubString )

		// Get the index of any next matching substring.
		intIndexOfMatch = strText.indexOf( strTarget );
	}

	// Return the updated string with ALL the target strings
	// replaced out with the new substring.
	return( strText );
}

function initSize()
{
	var windowHeight = Math.min($( window ).height() , 700) ;
	var windowWidth = $( window ).width() ;

	$("img.bg").height($(document).height());

	$("div.bg").height(windowHeight - 100);
	$("div.bg").width(windowWidth - 200);

//	$("#divHome1").height(windowHeight - $("#divHome-nav").height()) ;
//	$("#divHome-leitner").height(windowHeight) ; 
}

function action()
{
	//Preparetions...
	var $value = $("#txtInput").val();

	//Normalization...
	

	//Ajax...
	if($value=='999'){
		$('.result-name').html('طاها کامکار');

	}
	else {
		$.ajax({
			url     : base_url('index.php/home/find/' + $value),
			cache   : false,
			dataType: "html",
			method  : "GET"
		}).done(function ($result) {
			$('.result-name').html($result);
		});
	}

	//Visual Effects...
	s1 = $value[0];
	s2 = $value[1];
	s3 = $value[2];

	digitDance("1",30,s1);
	digitDance("2",40,s2);
	digitDance("3",50,s3);

	//Result...
	setTimeout(function(){
		$('.result').slideDown('fast');

	},3000);
}

function next(mood)
{
	if(mood=='save') {
		var $value = $("#txtInput").val();
		$.ajax({
			url: base_url('index.php/home/save/'+$value),
			cache: false,
			dataType: "html",
			method: "GET"
		}).done(function($result) {
//			$('.result-name').html($result);
		});
	}
	$('.result').slideUp('fast');
	digitDance("1",10,'-');
	digitDance("2",10,'-');
	digitDance("3",10,'-');
	inputFocus();
}

function inputFocus()
{
	$("#txtInput").focus().val('');
}

function digitDance(position , duration , final)
{
	var divSelector = "#dig" + position ;
	var j = 1 ;
	var r = 0 ;
	var s = '';

	for(var i=1 ; i<duration ; i++) {
		setTimeout( function() {
			j++ ;
			r = Math.floor(Math.random()*10);
			s = pd(r.toString());
			$(divSelector).html(s) ;
		} , 40*i);
	}

	setTimeout(function(){
		$(divSelector).html(pd(final)) ;
	} , 40*duration+1);
}

function pd($value)
{
	$value	= $value.replaceAll("0" , "۰") ;
	$value	= $value.replaceAll("1" , "۱") ;
	$value	= $value.replaceAll("2" , "۲") ;
	$value	= $value.replaceAll("3" , "۳") ;
	$value	= $value.replaceAll("4" , "۴") ;
	$value	= $value.replaceAll("5" , "۵") ;
	$value	= $value.replaceAll("6" , "۶") ;
	$value	= $value.replaceAll("7" , "۷") ;
	$value	= $value.replaceAll("8" , "۸") ;
	$value	= $value.replaceAll("9" , "۹") ;
	$value	= $value.replaceAll("¡" , "‌") ;

	return $value ;

}