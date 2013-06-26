<?

	//Userinformationen werde geholt
	$line1 = "";
	$line2 = "";
	$i = 0;
    foreach($config['text']['german']['id']['user'] as $k => $v) {
		if($i<3) {
        	$line1 .= '<li data-role="list-divider">'.$v.'</li><li class="userInfos" id="'.$k.'">-</li>';
		} else {
			$line2 .= '<li data-role="list-divider">'.$v.'</li><li class="userInfos" id="'.$k.'">-</li>';
		}
		$i++;
    }
?>

<div class="ui-grid-solo"> 
    <input type="search" name="search" id="search-basic" value="" />
</div>
<p><div class="ui-grid-a">
    <div class="ui-block-a"><ul data-role="listview"><? echo $line1; ?></ul></div>
    <div class="ui-block-b"><ul data-role="listview"><? echo $line2; ?></ul></div>
</div></p>

<div class="content-primary">
    <ul data-role="listview" data-inset="true" id="userButton">
       
    </ul>
</div> 

