<?
	$isEditable = ($_SESSION['wizard'] > 3);
	$artInfos = getArtInfos($_SESSION['mat'], $isEditable);
	$bookList = getBooking($_SESSION['mat']);

?>

<div class="ui-grid-solo" data-id="arttitel"> 
    <h3><? echo ($isEditable) ? '<input type="text" class="saver" db-database="objects" db-field="do_name" db-where="do_index='.$_SESSION['mat'].'" value="'.$artInfos['title'].'" />' : $artInfos['title']; ?></h3>
</div>

<div class="ui-grid-b" data-id="artinfos">
    <div class="ui-block-a"><img class="img_art" src="<? echo $artInfos['pic']; ?>"></div>
    <div class="ui-block-b"><ul data-role="listview"><? echo $artInfos['row1']; ?></ul></div>
    <div class="ui-block-c"><ul data-role="listview"><? echo $artInfos['row2']; ?></ul></div>
</div>
    
  
<p><div class="content-primary">
    <ul data-role="listview">
        <?
		//Artikelliste wird im mma geladen und kann bearbeitet werden
		if($_SESSION['isMma']) {
			
				echo '<li><a id="item_a" onClick="javascript:makeChange()">';
				echo '<img id="item_pic" src="'.$config['dir']['css'].'/images/btn_available.png "class="img_list_available"/>';
				echo '<h3 id="item_title">'.$config['text']['german']['art']['change'][0].'</h3>';
				echo '</a></li>';
				
				echo '<li><a id="item_a" onClick="javascript:delArt('.$_SESSION['mat'].')">';
				echo '<img id="item_pic" src="'.$config['dir']['css'].'/images/btn_occupied.png" class="img_list_occupied"/>';
				echo '<h3 id="item_title">'.$config['text']['german']['art']['change'][1].'</h3>';
				echo '</a></li>';
				
		} else {
		//Artikelliste wird im mmt geladen (readonly)
            foreach($bookList as $b) {
                echo '<li><a onClick="'.$b['onClick'].'">';
                echo '<img src="'.$b['img'].'" data-user="'.$b['usr'].'" class="img_list_'.$b['class'].'"/>';
                echo '<h3>'.$b['line1'].'</h3>';
                echo '<p>'.$b['line2'].'</p>';
                echo '</a></li>';
            }
		}
        ?>
    
    </ul>
</div></p>
            
