<!DOCTYPE html>
<html><head>
<meta http-equiv="content-type" content="text/html; charset=windows-1252">
<title>jQuery DateTimePicker Examples</title>
<link rel="stylesheet" type="text/css" href="jQuery%20DateTimePicker%20Examples_arquivos/DateTimePicker.css">
<link href="jQuery%20DateTimePicker%20Examples_arquivos/jquerysctipttop.css" rel="stylesheet" type="text/css">

<!--[if lt IE 9]>
<link rel="stylesheet" type="text/css" href="dist/DateTimePicker-ltie9.css" />
<script type="text/javascript" src="dist/DateTimePicker-ltie9.js"></script>
<![endif]-->

</head>

<body>
<div id="jquery-script-menu">
<div class="jquery-script-center">
<ul>
<li><a href="http://www.jqueryscript.net/time-clock/Responsive-Flat-Date-Time-Picker-with-jQuery-DateTimePicker-Plugin.html">Download This Plugin</a></li>
<li><a href="http://www.jqueryscript.net/">Back To jQueryScript.Net</a></li>
</ul>
<div class="jquery-script-ads"><script type="text/javascript"><!--
google_ad_client = "ca-pub-2783044520727903";
/* jQuery_demo */
google_ad_slot = "2780937993";
google_ad_width = 728;
google_ad_height = 90;
//-->
</script>
<script type="text/javascript" src="jQuery%20DateTimePicker%20Examples_arquivos/show_ads.js">
</script></div>
<div class="jquery-script-clear"></div>
</div>
</div>
<h1 style="margin-top:150px;">jQuery DateTimePicker Examples</h1>
<div>
<p>Date : </p>
<input value="11-11-2015" data-field="date" data-max="20-07-2016" data-min="20-07-2012" readonly="readonly" type="text">
</div>
<div>
<p>Time : </p>
<input data-field="time" readonly="readonly" type="text">
</div>
<div>
<p>DateTime : </p>
<input data-field="datetime" readonly="readonly" type="text">
</div>
<div>
<p>Date : </p>
<input data-field="date" readonly="readonly" type="text">
</div>
<div>
<p>Time : </p>
<input data-field="time" readonly="readonly" type="text">
</div>
<div>
<p>DateTime : </p>
<input data-field="datetime" readonly="readonly" type="text">
</div>
<div style="display: none;" class="dtpicker-overlay" id="dtBox"><div class="dtpicker-bg"><div class="dtpicker-cont"><div class="dtpicker-content"><div class="dtpicker-subcontent"></div></div></div></div></div>
<script src="jQuery%20DateTimePicker%20Examples_arquivos/jquery.js"></script> 
<script type="text/javascript" src="jQuery%20DateTimePicker%20Examples_arquivos/DateTimePicker.js"></script> 
<script type="text/javascript">
		
			$(document).ready(function()
			{
				$("#dtBox").DateTimePicker({
				
					dateTimeFormat: "dd-MM-yyyy hh:mm:ss AA",
					maxDateTime: "20-07-2016 12:00:00 AM",
					minDateTime: "20-07-2012 12:00:00 AM",
				
					minTime: "10:00",
					maxTime: "17:00",
				
					animationDuration: 100
				});
			});
		
		</script>


</body></html>