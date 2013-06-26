<?
	if(!isset($config)) {
		require_once("../config.php");
		require_once($config['dir']['php']."fnc_mmt.php");
		
		session_save_path($config['dir']['session']);
		session_start();
	}

	
	if (isset($_REQUEST['action']) && !empty($_REQUEST['action'])) {
		$action = $_REQUEST['action'];
	} else {
		die(FAILED);
	}
	
	
	$out = NULL;
	
	switch($action) {
		
		//Gibt einen Wert aus der Konfigurationsdatei zurück (key als array)
		case  "configVar": {
			if( isset($_REQUEST['arr']) == true && $_REQUEST['arr'] != NULL ) {
				
				$vars = checkVariable($_POST['arr']);
				$value = $config;
				foreach($vars as $keys) {
					$value = $value[$keys];
				}
				$out = json_encode($value);
			} else {
				$out = FAILED;
			}
		}
		break;
		
		//Gibt/Schreibt ein Wert der Sessionvariable.
		case  "sessionVar": {
			if ((isset($_POST['readO']) === true && $_POST['readO'] != NULL ) &&
				(isset($_POST['arr']) === true && $_POST['arr'] != NULL )) {
			
				$readO = checkVariable($_POST['readO']);
				$arr = (array) checkVariable($_POST['arr']);
				$out = array();
				
				if($readO == "TRUE") {
					foreach($arr as $a) {
						array_push($out, $_SESSION[$a]);
					}	
				} else {
					foreach ($arr as $a => $b) {
						$_SESSION[$a] = $b;
						$out[$a] = $b;
					}
				}
				$out = json_encode($out);


			} else {
				
				$out = FAILED;
			}
		}
		break;
		
		//Löscht ein Element
		case "delElement": {
				if (isset($_POST['db']) && !empty($_POST['db']) &&
					isset($_POST['where']) && $_POST['where'] != NULL)
					{
						 $dbDel = checkVariable($_POST['db']);
						 $where = checkVariable($_POST['where']);
						 
						 $out = FAILED;
						 $sql = sprintf('DELETE FROM %s WHERE %s ', $dbDel, $where);
						 if ($db->query_MySQL($sql) == true) {
								 $out = SUCCESS;
						 }
							$db->disconnect_MySQL();
				} else {
						$out = FAILED;
				}
		}
		break;
		
		//Ändert einen Eintrag
		case "updateElement": {
			if (isset($_POST['changes']) && $_POST['changes'] != NULL && isset($_SESSION['login'])) 
			{
					$changes = checkVariable($_POST['changes']);
					
					//passwort verschärfen
					if($changes['db-field'] == "dl_pass") $changes['value'] = md5("6jPxg3".$changes['value']);
					
					//anführungszeichen
					$changes['db-where'] = str_replace("%88", "'", $changes['db-where']);
					
					
					$sql = sprintf('UPDATE %s SET %s = \'%s\' WHERE %s',$changes['db-database'], $changes['db-field'], $changes['value'], $changes['db-where']);
					$out = FAILED;
					if ($db->query_MySQL($sql) == true) {
							 $out = 1;
							 $db->disconnect_MySQL();
					}
					$out = $sql;
			} else {
					$out = FAILED;
			}
		}
		break;
		
		//Bucht ein Artikel zurück
		case "getBack": {
			if ((isset($_POST['art']) && $_POST['art'] != NULL) &&
				(isset($_POST['dam']) && isset($_POST['mail']) && isset($_SESSION['login']))) 
			{
					$art = checkVariable($_POST['art']);
					$dam = (string) checkVariable($_POST['dam']);
					$toMail = (bool) checkVariable($_POST['mail']);
					
					
					$date = new DateTime();
					$date = date_format($date, 'Y-m-d H:i:s');
					$ttime = strtotime($date);
					
					$sql = sprintf('UPDATE booking SET db_back = \'%s\', db_damage = \'%s\' WHERE db_index = %d AND db_from < \'%s\'', $date, $dam, $art, $date);
					$out = 0;
					
					if ($db->query_MySQL($sql) == true) {
						if($toMail and $dam != NULL) {
							
							$res_to = $db->fetchObject($db->query_MySQL(sprintf('SELECT do_user, do_name FROM objects WHERE do_index = %d', $art)));
							$res_from = $db->fetchObject($db->query_MySQL(sprintf('SELECT db_user FROM booking WHERE db_index = %d AND db_from < \'%s\' LIMIT 1', $art, $date)));
							
							$usr_to = getUser($res_to->do_user);
							$usr_from = getUser($res_from->db_user);
							
							//%s hat am %s einen defekten Artikel (%s) gemeldet. /r/n Fehlerbeschrieb: /n %s /r/n
							$msg = sprintf($config['text']['mail']['msg'], $usr_from['cn'][0], strftime('%A, %e. %B %G %R:%S', $ttime), $res_to->do_name, $dam);
							
							mail($usr_to['mail'][0], $config['text']['mail']['subject'], str_replace("\n.", "\n..", $msg));	
						
						};
						$out = SUCCESS;
						$db->disconnect_MySQL();
					}
			} else {
					$out = FAILED;
			}
		}
		break;
		
		//holt ein Eintrag aus der Datenbank
		case  "getElement": {
			if( (isset($_REQUEST['db']) == true && $_REQUEST['db'] != NULL ) &&
				(isset($_REQUEST['where']) == true && $_REQUEST['where'] != NULL )) {
				$dbase = checkVariable($_POST['db']);
				$where = checkVariable($_POST['where']);
				
				$sql = sprintf('SELECT * FROM %s WHERE %s', $dbase, $where);
				
				$result = $db->query_MySQL($sql);
				$db->disconnect_MySQL();
				$out = FAILED;
				if ($result !== false) {
							$out = NULL;
							$result = (array) $db->fetchObject($result);
							$out = json_encode($result);
				}
			} else {
				$out = FAILED;
			}
		}
		break;
		//Erzeugt ein neuer Eintrag
		case "newElement": {
			if((isset($_POST['db']) === true && $_POST['db'] != NULL) &&
			(isset($_POST['arr']) === true && $_POST['arr'] != NULL) && isset($_SESSION['login'])) {
					$dbase = checkVariable($_POST['db']);
					$arr = checkVariable($_POST['arr']);
										
					$out = FAILED;

					
					//passwort verschärfen
					if(isset($arr['dl_pass'])) $arr['dl_pass'] = md5("6jPxg3".$arr['dl_pass']);

					$keys = array();
					$values = array();
					
					foreach($arr as $k=>$v) {
						array_push($keys, $k);
						array_push($values, $v);
					}
					
					$sql = sprintf('INSERT INTO %s (%s) VALUES (\'%s\')', $dbase , implode($keys, ", "), implode($values, "', '"));
					if($db->query_MySQL($sql)) {
						$out = $db->last_MySQL ($sql);
						$db->disconnect_MySQL();
					}
					
			} else {
					$out = FAILED;
			}
		}
		break;	
		//Erzeugt ein neuer Eintrag
		case "checkBooking": {
			if((isset($_POST['from']) === true && $_POST['from'] != NULL) &&
			(isset($_POST['to']) === true && $_POST['to'] != NULL) &&
			(isset($_POST['mat']) === true && $_POST['mat'] != NULL)) {
					$from = checkVariable($_POST['from']);
					$to = checkVariable($_POST['to']);
					$mat = checkVariable($_POST['mat']);
										
					$out = 0;
					
					$date = new DateTime();
					$date = date_format($date, 'Y-m-d H:i:s');
						
					if($from > $to or $from < $date){
						$out = $config['text']['german']['art']['msg'][1];
						break;
					}
					$sql = sprintf('SELECT db_user FROM booking WHERE db_index = %d AND ((db_from <= \'%s\') AND (db_to >= \'%s\'))', $mat , $to, $from);
					
					$res_check = $db->query_MySQL($sql);
					
					if($result = $db->fetchObject($res_check)){
						$usr = getUser($result->db_user);
						$out = sprintf($config['text']['german']['art']['msg'][0], $usr["cn"][0]);
					}
				
					$db->disconnect_MySQL();
					
			} else {
					$out = FAILED;
			}
		}
		break;
		//Holt Bild aus Active Directory
		case  "getUserPic": {
			if( isset($_REQUEST['user']) == true && $_REQUEST['user'] != NULL ) {
				$user = (string) checkVariable($_POST['user']);				
				$out = getUserPic($user);
				
			} else {
				$out = FAILED;
			}
		}
		break;
		//Ermittelt Person aus Active Directory
		case  "getUser": {
			if( isset($_REQUEST['query']) == true && $_REQUEST['query'] != NULL ) {
				$query = (string) checkVariable($_POST['query']);				
				$out = json_encode(getUser($query));
			} else {
				$out = FAILED;
			}
		}
		break;
		
		//Gibt Listeneintrag für 'res' zurück
		case "getBackButton": {
			if( isset($_REQUEST['user']) == true && $_REQUEST['user'] != NULL ) {
				$user = (string) checkVariable($_POST['user']);
				$userPic = getUserPic($user);
				
				switch ($_SESSION['wizard']) {
				
					case 3: //Present
				
						$out = '<li><a onClick="javascript:chgPage(0, true, {})">';
						$out .= '<img class="img_list_fail" src="'.$userPic.'" />';
						$out .= '<h3>'.$config['text']['german']['id']['nopresent'][0].'</h3>';
						$out .= '<p>'.$config['text']['german']['id']['nopresent'][1].'</p>';
						$out .= '</a></li>';
						
					break;
				
					case 1: //Zurückbuchen
						$date = new DateTime();
						$date = date_format($date, 'Y-m-d H:i:s');
						//Hole alle Buchungen die älter sind als Jetzt
						$sql = sprintf('SELECT id, db_index FROM booking WHERE db_user = \'%s\' AND db_back = \'00-00-0000 00:00:00\'', $user, $date);
						
						
						$res = $db->query_MySQL($sql);
						$o = array();
						$i = 0;
						//Gibts Einträge?
						while ($res_back = mysql_fetch_array($res)) {
							//Hole Status der Buchung
							$a = curBooking($res_back['db_index'], $date);
							//Wenn Buchung = 'besetzt'
							if($a['state'] != 0 and !in_array($a['db_index'], $o)){ 
								array_push($o, $a['db_index']);
								$i++;
							}
						}
						$out = '<li><a onClick="">';
						$out .= '<img class="img_list_occupied" src="'.$userPic.'" />';
						$out .= '<h3>'.$config['text']['german']['id']['button'][0].'</h3>';
						$out .= '</a></li>';
						
						if(!$i) {
							$out = '<li><a onClick="">';
							$out .= '<img class="img_list_occupied" src="'.$userPic.'" />';
							$out .= '<h3>'.$config['text']['german']['id']['button'][1].'</h3>';
							$out .= '</a></li>';
						} else {
							$out = '<li><a onClick="javascript:chgPage(0, false, {back:\''.implode($o, ", ").'\'})">';
							$out .= '<img class="img_list_available" src="'.$userPic.'" />';
							$out .= '<h3>'.sprintf($config['text']['german']['id']['button'][2], $i).'</h3>';
							$out .= '</a></li>';
						}
					break;
						
					case 4: //mma
				
						$out = '<li><a onClick="javascript:chgUser(\''.$user.'\')">';
						$out .= '<img class="img_list_available" src="'.$userPic.'" />';
						$out .= '<h3>'.$config['text']['german']['id']['change'].'</h3>';
						$out .= '</a></li>';
						
					break;
						
				}
				
			} else {
				$out = "";
			}
			
		}
		break;		
		default: 
			$out = FAILED;
			break;
	}
	echo $out;
?>
