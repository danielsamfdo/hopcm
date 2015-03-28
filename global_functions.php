<?php
function yes_or_no($val)
{
	if($val == 1)
	{
		return "Yes";
	}
	else
	{
		return "No";
	}
}
function format_date($originalDate, $format = "d-m-Y"){
	return date($format, strtotime($originalDate));
}
?>