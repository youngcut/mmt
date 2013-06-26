<h3><? echo $config['text']['german']['mma']['attr']['desc']; ?></h3>
<div data-role="collapsible-set">
    <?
        for($count = 1; $count < 5; $count++) {
            echo '<div data-role="collapsible" data-mini="true" data-collapsed-icon="arrow-r" data-expanded-icon="arrow-d">';
                echo '<h3>'.$config['text']['german']['mma']['attr']['arr'][$count-1].'</h3><p>';
                $res_attr = $db->query_MySQL(sprintf('SELECT * FROM `attribute` WHERE da_kat = %d', $count));
                if ($res_attr !== false) {
                    while ($res = $db->fetchObject($res_attr)) {
                        echo '<label for="basic">'.$config['text']['german']['mma']['attr']['count'].($res->da_attr+1).':</label>';
                        echo '<input type="text" class="saver" db-database="attribute" db-field="da_name" db-where="da_kat='.$res->da_kat.' AND da_attr='.$res->da_attr.'"db-autosave="true" value="'.$res->da_name.'" data-mini="true" />';
                    }
                }
            echo '</p></div>';
        }
        $db->disconnect_MySQL();
    ?>
</div>

<h3><? echo $config['text']['german']['mma']['attr']['lang']; ?></h3>

<select name="select-choice-min" class="saver" db-database="config" db-where="dc_key=1" db-field="dc_value" db-autosave="true" id="select-choice-min" data-mini="true">
    <? 
	foreach($config['text']['language'] as $avaLang) {
		$sel = ($avaLang[0]==$config['settings'][1]) ? " selected" : "";
		echo '<option '.$sel.' value="'.$avaLang[1].'">'.$avaLang[0].'</option>';
	}
	?>
</select>



<? $usr = getUser($config['settings'][0]); ?>
<h3><? echo $config['text']['german']['mma']['attr']['mainuser'][0].'<i>'.$usr['cn'][0]; ?></i></h3>

<div onClick="javascript:chgPage(0, false, {})" data-role="button" data-mini="true"><? echo $config['text']['german']['mma']['attr']['mainuser'][1]; ?></div>
