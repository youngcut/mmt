<? $artInfos = getArtInfos($_SESSION['mat'], false); ?>

<div class="ui-grid-solo" data-id="arttitel"> 
    <h3><? echo $artInfos['title']; ?></h3>
</div>

<div class="ui-grid-b" data-id="artinfos">
    <div class="ui-block-a"><img class="img_art" src="<? echo $artInfos['pic'] ?>"></div>
    <div class="ui-block-b" style="padding-right:20px">
        <p>
            <label for="mode1"><? echo $config['text']['german']['res']['text'][0]; ?></label>
            <input name="mode1" id="checkin" type="text" class= "resdate" data-mini="true" data-role="datebox" data-options='{"closeCallback":"lockDateOut", "mode":"calbox", "overrideDateFormat":"%-d. %B %Y", "calShowWeek": true, "afterToday": true, "useNewStyle":true}' />
            <input type="range" id="slidein" name="slider" class="resslider" value="8.00" min="5.0" max="20.0" step="0.5" data-highlight="true" data-mini="true" /> 
        </p>
        <p>
            <label for="mode1"><? echo $config['text']['german']['res']['text'][2]; ?></label>
            <input class= "resinput" type="text" id="user" data-mini="true" />
        </p>
    </div>
    <div class="ui-block-c" style="padding-right:20px">
        <p>
            <label for="mode1"><? echo $config['text']['german']['res']['text'][1]; ?></label>
            <input name="checkout" id="checkout" type="text" class= "resdate" data-mini="true" data-role="datebox" data-options='{"closeCallback":"lockDateIn", "mode":"calbox", "overrideDateFormat":"%-d. %B %Y", "calShowWeek": true, "useNewStyle":true}' />
            <input type="range" id="slideout" name="slider" class="resslider" value="17.00" min="5.0" max="20.0" step="0.5" data-highlight="true" data-mini="true" /> 
        </p>
        <p>
            <label for="mode1"><? echo $config['text']['german']['res']['text'][3]; ?></label>
            <input class= "resinput" type="text" id="place" data-mini="true" />
        </p>
    </div>
</div>

<div class="content-primary">
    <ul data-role="listview">
        <li>
        <?
			echo '<a id="item_a"onClick="">';
				echo '<img id="item_pic" src="'.$config['dir']['css'].'/images/btn_fail.png" class="img_list_fail"/>';
				echo '<h3 id="item_title">'.$config['text']['german']['res']['incomplete'][0].'</h3>';
				echo '<p id="item_subtitle">'.$config['text']['german']['res']['incomplete'][1].'</p>';
			echo '</a>';
		?>
        </li>
    </ul>
</div>