<img class="bg" src="<?php echo base_url('assets/images/bg.png'); ?>">
<div class="bg"></div>

<div class="content">
	<div class="line1">
		سیزدهمین مراسم بزرگداشت پیوند اعضا
	</div>
	<div class="line2">
		قرعه‌کشی مشهد مقدس برای خانواده‌های ایثارگر اهداکننده
	</div>

	<div class="digits row" dir="ltr" onclick="inputFocus()">
		<div id="dig3" class="col-md-3 img-circle digit">-</div>
		<div id="dig2" class="col-md-3 img-circle digit">-</div>
		<div id="dig1" class="col-md-3 img-circle digit">-</div>
	</div>

	<div class="result result-name" style="display: none">
		خانواده‌ی مرحوم فلان
	</div>

	<div class="result result-buttons" style="display: none">
		<span class="fa fa-check text-success" onclick="next('save')"></span>
		<span class="fa fa-remove text-danger" onclick="next('deny')"></span>
	</div>

	<form action="javascript:action()">
		<input id="txtInput" name="input" class="" autocomplete="off">
	</form>

</div>