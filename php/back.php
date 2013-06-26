<? $artInfos = getArtInfos($_SESSION['mat'], FALSE); ?>

<div class="ui-grid-solo" data-id="arttitel"> 
    <h3><? echo $artInfos['title']; ?></h3>
</div>

<div class="ui-grid-c" data-id="artinfos">
    <div class="ui-block-a"><img class="img_art" src="<? echo $artInfos['pic']; ?>"></div>
    <div class="ui-block-b" style="padding-right:18px">
        <label for="textarea-a"><? echo $config['text']['german']['back']['text'][0]; ?></label>
        <textarea name="textarea" id="txt_dam" style="height: 100px"></textarea>
        <label><input type="checkbox" name="checkbox-0" id="chk_dam" data-mini="true" /><? echo $config['text']['german']['back']['check']; ?></label>
    
    </div>
    <div class="ui-block-c" style="width:49%">
    
        <label for="textarea-10"><? echo $config['text']['german']['back']['text'][1]; ?></label>
    	<textarea disabled="disabled" cols="40" rows="8" name="textarea-10" id="textarea-10" style="height:160px"><? echo getDamage(); ?></textarea>
    	
    </div>
    <div class="ui-block-d"></div>
</div>
    
  
<p><div class="content-primary">
    <ul data-role="listview">
    	<li><a onClick="javascript:bookBack(<? echo $_SESSION['mat']; ?>);">
			<img src="<? echo $config['dir']['css']; ?>images/btn_available.png" class="img_list_available" />
            <h3><? echo $config['text']['german']['back']['button']; ?></h3>
         </a></li>
    </ul>
</div></p>
            
