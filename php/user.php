
		<?
            $usr_attr = $db->query_MySQL('SELECT dl_user, dl_mma, dl_mmt, dl_index FROM logon');
            if ($usr_attr !== false) {
				echo '<div data-role="collapsible-set">';
                while ($usr_res = $db->fetchObject($usr_attr)) {
					if($usr_res->dl_index > 0){
						$isMmt = '';
						$isMma = '';
					
						echo '<div data-role="collapsible" data-collapsed="true">';
							echo '<h3>'.$usr_res->dl_user.'</h3>';
							
							//Checkboxen Rechte						
							echo '<p><fieldset data-role="controlgroup">';
							
								if($usr_res->dl_mmt) $isMmt = 'checked';
							
								echo '<input type="checkbox" name="check_a'.$usr_res->dl_index.'" id="check_a'.$usr_res->dl_index.'" class="custom" '.$isMmt.' />';
								echo '<label for="check_a'.$usr_res->dl_index.'">'.$config['text']['german']['user']['mmt'].'</label>';
			
								if($usr_res->dl_mma) $isMma = 'checked';
								
								echo '<input type="checkbox" name="check_b'.$usr_res->dl_index.'" id="check_b'.$usr_res->dl_index.'" class="custom" '.$isMma.' />';
								echo '<label for="check_b'.$usr_res->dl_index.'">'.$config['text']['german']['user']['mma'].'</label>';
			
								
							echo '</fieldset></p>';
							
							//Passworfelder
							echo '<div data-role="fieldcontain">';
								echo '<label for="pass_a'.$usr_res->dl_index.'">'.$config['text']['german']['user']['pw'][0].'</label>';
								echo '<input type="password" name="pass_a'.$usr_res->dl_index.'" id="pass_a'.$usr_res->dl_index.'" value="" />';
							echo '</div>';
							
							echo '<div data-role="fieldcontain">';
								echo '<label for="pass_b'.$usr_res->dl_index.'">'.$config['text']['german']['user']['pw'][1].'</label>';
								echo '<input type="password" name="pass_b'.$usr_res->dl_index.'" id="pass_b'.$usr_res->dl_index.'" value="" />';
							echo '</div>';
							
							//Buttons
							echo '<div onClick="javascript:userMod(1, '.$usr_res->dl_index.')" data-role="button" data-icon="check" data-theme="b">'.$config['text']['german']['user']['save'].'</div>';
							echo '<div onClick="javascript:userMod(0, '.$usr_res->dl_index.')" data-role="button" data-icon="delete" data-theme="e">'.$config['text']['german']['user']['del'].'</div>';
						echo '</div>';
					}
				
                }
				
					echo '<div data-role="collapsible" data-collapsed="true">';
						echo '<h3>'.$config['text']['german']['user']['new'].'</h3>';
						
						
						//Checkboxen Rechte						
						echo '<p><fieldset data-role="controlgroup">';
						
							echo '<input type="checkbox" name="check_a0" id="check_a0" class="custom" />';
							echo '<label for="check_a0">'.$config['text']['german']['user']['mmt'].'</label>';
							
							echo '<input type="checkbox" name="check_b0" id="check_b0" class="custom" />';
							echo '<label for="check_b0">'.$config['text']['german']['user']['mma'].'</label>';
		
							
						echo '</fieldset></p>';
						
						//User
						echo '<div data-role="fieldcontain">';
							echo '<label for="in_b0">'.$config['text']['german']['user']['username'].'</label>';
							echo '<input type="text" name="in_b0" id="in_b0" value="" />';
						echo '</div>';
						
						//Passworfelder
						echo '<div data-role="fieldcontain">';
							echo '<label for="pass_a0">'.$config['text']['german']['user']['pw'][0].'</label>';
							echo '<input type="password" name="pass_a0" id="pass_a0" value="" />';
						echo '</div>';
						
						echo '<div data-role="fieldcontain">';
							echo '<label for="pass_b0">'.$config['text']['german']['user']['pw'][1].'</label>';
							echo '<input type="password" name="pass_b0" id="pass_b0" value="" />';
						echo '</div>';
						
						//Button
						echo '<div onClick="javascript:userMod(2, 0)" data-role="button" data-icon="delete" data-theme="e">'.$config['text']['german']['user']['new'].'</div>';
						
					echo '</div>';
				echo '</div>';
            }
            $db->disconnect_MySQL();
			
		?>
            
    