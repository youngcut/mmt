<?

	function checkLogin($username, $passwort, $forward) {
		
		global $config;
		global $db;				
		
		if($username != "" or $passwort != "") {
			
			//passwort verschärfen
    		$passwort = md5("6jPxg3".$passwort);
			//Falscher Benutzername oder Kennwort
			$failtext = $config['text']['german']['login']['fail'][0];
			$showpage = "login";
				
			$db_erg = $db->query_MySQL("SELECT * FROM logon WHERE dl_user LIKE '$username' LIMIT 1");
			$db_result = $db->fetchObject($db_erg);
				
			//Zugang erfolgt
			if ($db_result->dl_pass == $passwort) {
								
				//Sie haben keine Zugriffsberechtigung für diesen Bereich
				$failtext = $config['text']['german']['login']['fail'][1];
				
				
				$failtext = $config['text']['german']['login']['fail'][1];
				
				//Weiterleitung zu MMT
				if($db_result->dl_mmt and $forward == "mmt"){
					$showpage = "mmt";
					$_SESSION['login'] = TRUE;
					
					//Schreibe Standard Sessionvariablen
					$_SESSION["goto"] = $forward;
					$_SESSION["mobileTheme"] = $config["theme"][$forward];
					$_SESSION["usr_name"] = $db_result->dl_user;
					$_SESSION["mmt_rechte"] = $db_result->dl_mmt;
					$_SESSION["mma_rechte"] = $db_result->dl_mma;
				}
	
				//Weiterleitung zu MMA
				if($db_result->dl_mma and $forward == "mma") {
					$showpage = "mma";
					$_SESSION['wizard'] = 4;
					$_SESSION["isMma"] = TRUE;
					$_SESSION['login'] = TRUE;
					
					
					//Schreibe Standard Sessionvariablen
					$_SESSION["goto"] = $forward;
					$_SESSION["mobileTheme"] = $config["theme"][$forward];
					$_SESSION["usr_name"] = $db_result->dl_user;
					$_SESSION["mmt_rechte"] = $db_result->dl_mmt;
					$_SESSION["mma_rechte"] = $db_result->dl_mma;
				}
			}
			
		} else {
			
			//Sie haben kein Benutzername oder Passwort eingegeben
			$failtext = $config['text']['german']['login']['fail'][3];
		}
		
		return array($showpage, $failtext);
		
	}

	function getHeader($pageId) {
		global $config;
		global $db;
		
		
		$date = new DateTime();
		$date = strftime('%A, %e. %B %G %R:%S');
		
		$out = '<div data-role="header" data-id="theHeader" id="header" data-position="fixed">';
		
			switch ($pageId) {
				case "mma" :
					$out .= '<h1 id="time">'.$config['text']['german'][$pageId]['header'].'</h1>'; 
				break;
				case "login" :
					$out .= '<h1 id="time">'.$config['text']['german'][$pageId]['header'].'</h1>'; 
				break;
				case "mmt" :
					$out .= '<h1 id="time" style="text-align:center">'.$date.'</h1>';
						$out .= '<div data-mini="true" id="cola" data-role="collapsible">';
						$out .= '<select name="select-choice-11" id="select-choice-11" class="saver" db-database="config" db-where="dc_key = language" db-field="dc_value" db-autosave="true" data-inline="true">';
						foreach($config['text']['language'] as $avaLang) $out .= '<option value="'.$avaLang[1].'">'.$avaLang[0].'</option>';
						$out .= '</select>';
						$out .= '<a href="'.$config['files']['index'].'?goto=logout" data-ajax="false" data-role="button" data-inline="true" data-min="true" data-theme="c">'.$config['text']['german']['mmt']['ask'][0].'</a>';            
					$out .= '</div>';
				break;
				case "user" :
						$out .= '<h1 id="time">'.$config['text']['german'][$pageId]['header'].'</h1>'; 
				break;
				case "kat" :
					$out .= '<h1 id="time">'.$config['text']['german'][$pageId]['header'].'</h1>';
					if(!$_SESSION['isMma']) $out .= '<a onClick="javascript:chgPage(true, false, {})" data-icon="arrow-l">'.$config['text']['german']['wizard']['back'].'</a>';
	
				break;
				case "art" :
					$out .= '<h1 id="time">'.$config['text']['german'][$pageId]['header'].'</h1>';
					
					if(!$_SESSION['isMma'])	$out .= '<a onClick="javascript:chgPage(true, false, {})" data-icon="arrow-l">'.$config['text']['german']['wizard']['back'].'</a>';
							
					
	
				break;
				case "res" :
				
					$out .= '<h1 id="time">'.$config['text']['german'][$pageId]['header'].'</h1>';
					if($_SESSION['wizard'] == 0) {
						$out .= '<a onClick="javascript:chgPage(true, false, {}, \'none\')" data-icon="arrow-l">'.$config['text']['german']['wizard']['back'].'</a>';
					} else {
						$out .= '<a onClick="javascript:chgPage(true, false, {})" data-icon="arrow-l">'.$config['text']['german']['wizard']['back'].'</a>';
						
					}

				break;
				default :
					$out .= '<a onClick="javascript:chgPage(true, false, {})" data-icon="arrow-l">'.$config['text']['german']['wizard']['back'].'</a>';
					$out .= '<h1 id="time">'.$date.'</h1>';
				break;
			}
		$out .= "</div>";
		
		return $out;
	}
	
	function getFooter($pageId) {
		global $config;
		global $db;
		
		
		$out = '<div data-role="footer" data-id="theFooter" data-position="fixed">';
		
		
			if ($_SESSION["isMma"] == TRUE) {
				$out .= '<div data-role="navbar"><ul>';
					$out .= '<li><a onClick="javascript:chgPage(false, 4, {}, \'fade\')"'.(($_SESSION["wizard"] == 4) ? 'class="ui-btn-active"' : '').'>'.$config['text']['german']['mma']['footer'][0].'</a></li>';
					$out .= '<li><a onClick="javascript:chgPage(false, 5, {\'curWizPos\': 0}, \'fade\')"'.(($_SESSION["wizard"] == 5) ? 'class="ui-btn-active"' : '').'>'.$config['text']['german']['mma']['footer'][1].'</a></li>';
					$out .= '<li><a onClick="javascript:chgPage(false, 6, {}, \'fade\')"'.(($_SESSION["wizard"] == 6) ? 'class="ui-btn-active"' : '').'>'.$config['text']['german']['mma']['footer'][2].'</a></li>';
					$out .= '<li><a href="'.$config['files']['index'].'?goto=logout" data-ajax="false">'.$config['text']['german']['mma']['footer'][3].'</a></li>';
				$out .= '</ul></div>';
			} else {
				$out .= '<h1>'.$config['text']['german'][$pageId]['footer'][0].'</h1>';	
			}
		
		$out .= '</div>';
        
		return $out;
		
	}
	
	//holt Materialinfos
	function getArtInfos($artId, $isEditable) {
		
		global $config;
		global $db;
		
		//Artikelinfos aus Datenbank holen
		$sql = sprintf('SELECT * FROM objects WHERE do_index = %d', $artId);
		$res_obj = $db->query_MySQL($sql);
		if ($res_obj !== false) {
			$res_obj = (array) $db->fetchObject($res_obj);
		}
		$db->disconnect_MySQL();
		
		$usr = getUser($res_obj['do_user']);
		
		//Erste Informationen auslesen: Verantwortlicher und Zuordnung
		$res1 = ($res_obj['do_user'] == "") ? $config['text']['german']['art']['no'] : $usr['cn'][0];
		$res2 = ($res_obj['do_id'] == "") ? $config['text']['german']['art']['no'] : $res_obj['do_id'];
		
		if($isEditable) {
			
			$res1 = '<input type="text" class="saver" id="usr" db-database="objects" db-field="do_user" db-where="do_index='.$artId.'" value="'.$usr['cn'][0].'" data-mini="true" />';
			$res2 = '<input type="text" class="saver" db-database="objects" db-field="do_id" db-where="do_index='.$artId.'" value="'.$res_obj['do_id'].'" data-mini="true" />';
			
		}
		
		$out['row1'] = '<li data-role="list-divider">'.$config['text']['german']['art']['user'].'</li><li>'.$res1.'</li>';
		$out['row2'] = '<li data-role="list-divider">'.$config['text']['german']['art']['index'].'</li><li>'.$res2.'</li>';
		
		//Zusätzliche Informationen aufrufen
		foreach($config['attributes'][$res_obj['do_class']] as $i => $arr) {
			if($arr) {
				$res3 = ($res_obj['do_attr'.($i+1)] == "") ? $config['text']['german']['art']['no'] : $res_obj['do_attr'.($i+1)];
				
				if($isEditable) {
					$res3 = '<input type="text" class="saver" db-database="objects" db-field="do_attr'.($i+1).'" db-where="do_index='.$artId.'" value="'.$res_obj['do_attr'.($i+1)].'" data-mini="true" />';
				}				
				
				if($i  % 2 == 0) {
					$out['row1'] .= '<li data-role="list-divider">'.$arr.'</li><li>'.$res3.'</li>';
				} else {
					$out['row2'] .= '<li data-role="list-divider">'.$arr.'</li><li>'.$res3.'</li>';
				}
			}
		}
		
//Bild auslesen (!)
		$out['pic'] = $config['pic']['art']['nopic'];
		
		//Titel ausgeben
		$out['title'] = $res_obj['do_name'];
		
		return $out;
		
	}
	
	function curBooking($artId, $date) {
		global $db;
			$book_sql = sprintf('SELECT * FROM booking WHERE db_index = %d AND (db_to < \'%s\' OR db_back < \'%s\') AND db_from < \'%s\' ORDER BY db_from DESC LIMIT 1', $artId, $date, $date, $date);
		
		$bookings = $db->query_MySQL($book_sql);
		
		$out = array('state' => 0);
		
		// - Booking Datenbank -
		// id = Buchungsnummer (fortlaufend nummeriert)
		// db_index = Artikelnummer
		// db_from = Startdatum einer Buchung
		// db_to = Enddatum einer Buchung
		// db_back = Artikel wurde wieder zurückgebracht
		
		// 0 = verfügbar: keine künftigen Buchungen vorhanden oder 'to' und 'back' liegen in der Vergangenheit
		// 1 = besetzt: 'back' nicht gesetzt
		// 2 = nicht zurückgebucht: 'to' liegt in der Vergangenheit und 'back' ist nicht gesetzt.
		//Bei 1 & 2 werden zusätzlich die Werte aus der Datenbank mitgeliefert.
		
		if($rent = $db->fetchObject($bookings)) {
			
			$out = array_merge($out, (array) $rent);
			
			$out["state"] = 1;
			if($rent->db_back != "0000-00-00 00:00:00") $out["state"] = 0;
			if($rent->db_to < $date and $rent->db_back == "0000-00-00 00:00:00") $out["state"] = 2;
		}
		
		$db->disconnect_MySQL();
		
		return $out;
	}

	//Holt die Buchungen
	function getBooking($artId) {
		
		global $config;
		global $db;
				
		//Datum/Uhrzeit auslesen
		$date = new DateTime();
		$date = date_format($date, 'Y-m-d H:i:s');
		
		$taken = curBooking($artId, $date);
		$book = array();
		
		
		
		//Erste Position wird generiert
		switch ($taken['state']) {
			case 0: //verfügbar
				//Dieser Artikel befindet sich im Haus
				$book[0]['onClick'] = 'javascript:chgPage(0, false, {bookid:0}, \'none\')';
				$book[0]['usr'] = "";
				$book[0]['class'] = 'available';
				$book[0]['img'] = $config['dir']['css'].'images/btn_available.png';
				//Dieser Artikel ist verfügbar
				$book[0]['line1'] = $config['text']['german']['art']['line1']['available'];
				//Zum Reservieren oder Ausbuchen bitte anklicken.
				$book[0]['line2'] = ($_SESSION['wizard'] == 2) ? "" : $config['text']['german']['art']['line2']['available'];
			break;
			case 1: //Artikel besetzt
				$curBookId = $taken['id'];
				$dateTo = strftime('%e. %b %Y %H:%M', strtotime($taken['db_to']));
				$usr = getUser($taken['db_user']);
				$book[0]['onClick'] = 'javascript:chgPage(0, false, {bookid:0}, \'none\')';
				$book[0]['usr'] = $usr['sAMAccountName'][0];
				$book[0]['class'] = 'occupied';
				$book[0]['img'] = $config['dir']['css'].'images/btn_occupied.png';
//userpic
				//Dieser Artikel befindet sich bei %s in %s bis am %s
				$book[0]['line1'] = sprintf($config['text']['german']['art']['line1']['taken'], $taken['db_to']);
				//Hier klicken um die Kontaktdaten von %s anzuzeigen.
				$book[0]['line2'] = sprintf($config['text']['german']['art']['line2']['taken'], $usr['cn'][0], $taken['db_place']);
			break;
			case 2: //Artikel nicht zurückgebracht
				$curBookId = $taken['id'];
				$dateTo = strftime('%e. %b %Y %H:%M', strtotime($taken['db_to']));
				$usr = getUser($taken['db_user']);
				$book[0]['onClick'] = 'javascript:chgPage(0, false, {bookid:'.$taken['db_index'].'}, \'none\')';
				$book[0]['usr'] = $usr['sAMAccountName'][0];
				$book[0]['class'] = 'fail';
				$book[0]['img'] = $config['dir']['css'].'images/btn_fail.png';
				//Dieser Artikel befindet sich bei %s in %s bis am %s
				$book[0]['line1'] = sprintf($config['text']['german']['art']['line1']['noback'], $dateTo);
				//Hier klicken um die Kontaktdaten von %s anzuzeigen.
				$book[0]['line2'] = sprintf($config['text']['german']['art']['line2']['noback'], $usr['cn'][0], $taken['db_place']);
			break;
		}	
		
		
		//Buchungen aus Datenbank holen
		$sql = sprintf('SELECT * FROM booking WHERE db_index = %d AND db_from > \'%s\' ORDER BY db_from', $artId, $date);
		
		
		//Füllt Liste mit künftigen Buchungen aus
		if($res_book = $db->query_MySQL($sql)) {
			$i=1;
			while ($res_boo = $db->fetchObject($res_book)) {
				$usr = getUser($res_boo->db_user);
				//restliche Buchungen anzeigen
				$book[$i]['onClick'] = 'javascript:delBook('.$res_boo->id.')';
				$book[$i]['usr'] = $usr['sAMAccountName'][0];
				$book[$i]['class'] = 'occupied';
				$book[$i]['img'] = $config['dir']['css'].'images/btn_occupied.png';
				
				$dateFrom = strftime('%e. %b %Y %H:%M', strtotime($res_boo->db_from));
				$dateTo = strftime('%e. %b %Y %H:%M', strtotime($res_boo->db_to));
				
				//Von %s bis %s ist dieser Artikel reserviert
				$book[$i]['line1'] = sprintf($config['text']['german']['art']['line1']['reserved'], $dateFrom, $dateTo);;
				//Wird bei %s benützt von %s.
				$book[$i]['line2'] = sprintf($config['text']['german']['art']['line2']['reserved'], $usr['cn'][0], $res_boo->db_place);
				$i++;
			}
		}
		$db->disconnect_MySQL();
		return $book;
	}

	//holt die Materialliste
	function getMatList($filter, $sort, $isBack) {
		
		global $config;
		global $db;
		
		//Standart Zeile (Keine Artikel gefunden)
		
		$out = "";
		$usr="";
		
		$txtFilter = $filter != "" ? "WHERE ".$filter : "";
		$txtSort = $sort != "" ? "ORDER BY ".$sort : ", ";
	
		//Hole Einträge mit Filter und Sortierung
		$obj_sql = sprintf("SELECT * FROM objects %s %s ", $txtFilter, $txtSort);
		$date = new DateTime();
		$date = date_format($date, 'Y-m-d H:i:s');
		if ($objects = $db->query_MySQL($obj_sql)) {
			
			while ($object = $db->fetchObject($objects)) {
				
				$taken = curBooking($object->do_index, $date);
				$subtitle = "";
				$pic = $config['dir']['css'].'images/btn_available.png';
				
				if($isBack) {
					
					$pic = $config['dir']['css'].'images/btn_back.png';
					$subtitle = '<p>'.$config['text']['german']['mat']['back'].'</p>';
					$taken['state'] = 0;
					
				} else {
					
					$usr="";
					if($taken['state'] != 0) {
						$usr = getUser($taken['db_user']);
						$subtitle = '<p>'.sprintf($config['text']['german']['mat']['usual'][$taken['state']], $usr['cn'][0], $taken['db_place'], $taken['db_to']).'</p>';
						$usr = $usr['sAMAccountName'][0];
					} else {
						
						$subtitle = '<p>'.$config['text']['german']['mat']['usual'][$taken['state']].'</p>';
					}
				}
				
				
				$frame = array('available', 'occupied', 'fail');	
                $out .= '<li><a onClick="javascript:chgPage(0, false, {mat:'.$object->do_index.'})">';
                	$out .= '<img src="'.$pic.'" data-user="'.$usr.'" class="img_list_'.$frame[$taken['state']].'"/>';
					$out .= '<h3>'.$object->do_id.' - '.$object->do_name.'</h3>';
					$out .= $subtitle;
					$out .= '</a></li>';
            }
			
		} else {
			$out .= '<li><a href="#"><h2>'.$config['text']['german']['mat']['noresult'][0].'</h2><p>'.$config['text']['german']['mat']['noresult'][1].'</p></a>';
	
		}
		$out .= '</ul>';
		
		$openList = '<ul data-role="listview" data-inset="false">';
		$canNew = "";
		
		//In MMA: Neuer Artikel einfügen
		if($_SESSION['isMma']) {
			
			$canNew = '<li><a id="item_a" onClick="javascript:makeArt('.$_SESSION['kat'].')">';
			$canNew .= '<img id="item_pic" src="'.$config['dir']['css'].'/images/btn_add.png "class="img_list_available"/>';
			$canNew .= '<h3 id="item_title">'.$config['text']['german']['art']['new'].'</h3>';
			$canNew .= '</a></li>';
				
		}
		return $openList.$canNew.$out;
	}
	
	function getDamage(){
		
			global $config;
			global $db;
			
			$out = $config['text']['german']['back']['list'][0];
			
            $dam_sql = sprintf("SELECT db_damage, db_back, db_user FROM booking WHERE db_index = %d and db_back != '0000-00-00 00:00:00' ORDER BY db_back", $_SESSION['mat']);
            if ($dama = $db->query_MySQL($dam_sql)) {
				$out = '';
                while ($damage = $db->fetchObject($dama)) {
					$ttime = strtotime($damage->db_back);
					$out .= $damage->db_user.': '.(($damage->db_damage != "") ? $damage->db_damage : $config['text']['german']['back']['list'][1]).' - '.strftime('%A, %e. %B %G %R:%S', $ttime).'&#13;&#10;';
				}
            }
			return $out;
	}
	
	function getUser($query) {
	
		global $config;
		global $db;
			//Schaut ob Anbindung funtioniert
			if($_SERVER['HTTP_HOST'] == "mmt.kilchenmann.ch") {
				if ($result = $db->query_LDAP($query)) {						
							
							$result['sAMAccountName'][0] = strtolower($result['sAMAccountName'][0]);
							$result['mail'][0] = strtolower($result['mail'][0]);
							$out = $result;
							  
				} else {
					$out = false;
				}
			} else {
				//Gibt Test User auf
				$out = array("cn" => array("Test User"), "sAMAccountName" => array("uste"), "title" => array("No AC-Access!"), "mail" => array("mmt@kilchenmann.ch"), "mobile" => array("+41 (0)79 000 00 00"));
			}
		return $out;
	
	}
	
	function getUserPic($user, $noAjax = NULL) {
	
		global $config;
		global $db;
		
		$file = sprintf($config['dir']['ldappic'], strtolower($user));
		if (!file_exists($file)) $file = $config['files']['nopic'];
		
		list($width, $height) = getimagesize($file);
		
		$offset_x = 22;
		$offset_y = 20;
		
		$new_height = 126;
		$new_width = 126;
		
		$new_image = imagecreatefromjpeg($file);
		
		$image = imagecreatetruecolor(126, 126);
		
		imagecopyresized($image, $new_image, -15, 0, -12, 10, 250, 250, 195, 195);
		
		ob_start();
		
		header('Content-Type:image/jpeg');
		
		imagejpeg($image);
		
		$contents = ob_get_contents();
		ob_end_clean();
		imagedestroy($new_image);
		
		return "data:image/png;base64,".base64_encode($contents);
				
	}
	
	
	
?>