<?
	
	$_SESSION["kat"] = 0;
	$_SESSION["mat"] = 0;
	$_SESSION["back"] = "";
	$_SESSION["wizard"] = 0;
?>

<div onClick="javascript:chgPage(false, 0)" class="frm_btn">
	<img src="<? echo $config['pic']['mmt']['matrix']; ?>" />
</div>
<div onClick="javascript:chgPage(false, 1)" class="frm_btn">
	<img src="<? echo $config['pic']['mmt']['matrix']; ?>" style="bottom:130px"/>
</div>
<div onClick="javascript:chgPage(false, 2, {kat:0})" class="frm_btn">
	<img src="<? echo $config['pic']['mmt']['matrix']; ?>" style="bottom:260px"/>
</div>
<div onClick="javascript:chgPage(false, 3)" class="frm_btn">
	<img src="<? echo $config['pic']['mmt']['matrix']; ?>" style="bottom:390px"/>
</div>