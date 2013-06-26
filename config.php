<?

	$config['dir']['url'] = $_SERVER['DOCUMENT_ROOT']."/"; 
	$config['dir']['host'] = "//".$_SERVER['HTTP_HOST']."/";
	$config['dir']['forward'] = $config['dir']['host']."php/";
	$config['dir']['session'] = $config['dir']['url']."sessions/";
	$config['dir']['js'] = 	$config['dir']['host']."js/";
	$config['dir']['jquery'] = $config['dir']['host']."js/";
	$config['dir']['php'] = $config['dir']['url']."php/";
	$config['dir']['css'] = $config['dir']['host']."css/";
	$config['dir']['ldappic'] = $config['dir']['url']."pics/%s_outlook.jpg";
	
	$config['files']['db'] = $config['dir']['php']."fnc_database.php";
	$config['files']['mma'] = $config['dir']['forward']."mma.php";
	$config['files']['mmt'] = $config['dir']['forward']."mmt.php";
	$config['files']['session'] = $config['dir']['php']."fnc_session.php";
	$config['files']['ajax'] = $config['dir']['forward']."fnc_ajax.php";
	$config['files']['header'] = $config['dir']['php']."header.php";
	$config['files']['login'] = $config['dir']['php']."login.php";
	$config['files']['logout'] = $config['dir']['host']."php/fnc_session.php?logout=true";
	$config['files']['index'] = $config['dir']['host']."index.php";
	$config['files']['nopic'] = $config['dir']['url']."css/images/noldap.jpg";
	
	$config['pic']['mmt']['matrix'] = $config['dir']['css']."images/btn_home.png";
	$config['pic']['kat']['matrix'] = $config['dir']['css']."images/btn_kat.png";
	$config['pic']['art']['nopic'] = $config['dir']['css']."images/nopic.png";
	
	$config['theme']['mmt'] = "a";
	$config['theme']['mma'] = "c";
	//Sparche: Deutsch
	
	$config['text']['language'][0] = array("deutsch", "german");
	$config['text']['language'][1] = array("english", "english");
	
	$config['text']['german']['title'] = "MMT - Material Management Tool";
	
	$config['text']['german']['login']['header'] = $config['text']['german']['title'];
	$config['text']['german']['login']['footer'][0] = "- Bitte melden Sie sich an -";
	$config['text']['german']['login']['fail'][0] = "Falscher Benutzername oder Kennwort";
	$config['text']['german']['login']['fail'][1] = "Sie haben keine Zugriffsberechtigung für diesen Bereich";
	$config['text']['german']['login']['fail'][3] = "Fehler beim Login. Bitte Angaben kontrollieren.";
	$config['text']['german']['login']['input'][0] = "Benutzername:";
	$config['text']['german']['login']['input'][1] = "Passwort:";
	$config['text']['german']['login']['switch'][0] = "Anmelden für:";
	$config['text']['german']['login']['switch'][1] = "MMT - Usertool";
	$config['text']['german']['login']['switch'][2] = "MMA - Admintool";
	$config['text']['german']['login']['button'] = "Login";
	
	$config['text']['german']['mmt']['header'] = $config['text']['german']['title'];
	$config['text']['german']['mmt']['footer'][0] = "- Bitte wählen -";
	$config['text']['german']['mmt']['ask'][0] = "Sie sind dabei sich abzumelden - Fortfahren?";
	$config['text']['german']['mmt']['msg'][0] = "Artikel erfolgreich gebucht.";
	
	$config['text']['german']['mma']['header'] = "MMA - Material Management Admin";
	$config['text']['german']['mma']['footer'][0] = "Grundeinstellungen";
	$config['text']['german']['mma']['footer'][1] = "Artikel";
	$config['text']['german']['mma']['footer'][2] = "Benutzer";
	$config['text']['german']['mma']['footer'][3] = "Abmelden";
	$config['text']['german']['mma']['attr']['desc'] = "Bezeichner für Eigenschaften ändern";
	$config['text']['german']['mma']['attr']['arr'] = array("Autos", "Werkzeuge", "Messgeräte", "Laptops");
	$config['text']['german']['mma']['attr']['count'] = "Bezeichner ";
	$config['text']['german']['mma']['attr']['lang'] = "Sprache ändern";
	$config['text']['german']['mma']['attr']['mainuser'][0] = "Derzeitiger Hauptverantwortlicher: ";
	$config['text']['german']['mma']['attr']['mainuser'][1] = "Ändern";
	
	$config['text']['german']['kat']['header'] = $config['text']['german']['title'];
	$config['text']['german']['kat']['footer'][0] = "- Bitte Kategorie wählen -";
	
	$config['text']['german']['art']['header'] = $config['text']['german']['title'];
	$config['text']['german']['art']['footer'][0] = "- Artikelinfo -";
	$config['text']['german']['art']['no'] = "(Nicht angegeben)";
	$config['text']['german']['art']['user'] = "Verantwortilcher";
	$config['text']['german']['art']['index'] = "Nummer";
	$config['text']['german']['art']['new'] = "Neuer Artikel erstellen";
	$config['text']['german']['art']['line1']['reserved'] = "Vom <i>%s</i> bis <i>%s</i> ist dieser Artikel reserviert";
	$config['text']['german']['art']['line2']['reserved'] = "von <i>%s</i> in/bei <i>%s</i>.";
	$config['text']['german']['art']['line1']['available'] = "Dieser Artikel ist verfügbar";
	$config['text']['german']['art']['line2']['available'] = "Zum Reservieren oder Ausbuchen bitte anklicken.";
	$config['text']['german']['art']['line1']['taken'] = "Dieser Artikel wird bis <i>%s</i> benutzt";
	$config['text']['german']['art']['line2']['taken'] = "von <i>%s</i> in/bei <i>%s</i>.";
	$config['text']['german']['art']['line1']['noback'] = "Dieser Artikel wurde offensichtlich nicht zurückgebucht";
	$config['text']['german']['art']['line2']['noback'] = "letzter Benutzer: <i>%s</i> ";
	$config['text']['german']['art']['msg'][0] = "Diese Buchung überschneidet sich mit einer Anderen von <i>%s</i> ";
	$config['text']['german']['art']['msg'][1] = "Bitte Datum und Zeit kontrollieren";
	$config['text']['german']['art']['change'][0] = "Änderungen speichern";
	$config['text']['german']['art']['change'][1] = "Dieser Artikel löschen";
	$config['text']['german']['art']['confirm'][0] = "Wollen Sie diesen Artikel wirklich löschen?";
	$config['text']['german']['art']['confirm'][1] = "Ja";
	$config['text']['german']['art']['confirm'][2] = "Nein";
	
	$config['text']['german']['mat']['header'] = $config['text']['german']['title'];
	$config['text']['german']['mat']['footer'][0] = "- Für Informationen ein Artikel auswählen -";
	$config['text']['german']['mat']['back'] = "Dieser Artikel zurückbuchen?";
	$config['text']['german']['mat']['usual'][0] = "Dieser Artikel befindet sich im Haus";
	$config['text']['german']['mat']['usual'][1] = "Dieser Artikel befindet sich bei %s in %s bis am %s";
	$config['text']['german']['mat']['usual'][2] = "Dieser Artikel ist möglicherweise noch bei %s in %s ";
	$config['text']['german']['mat']['noresult'][0] = "Es wurden keine Artikel gefunden";
	$config['text']['german']['mat']['noresult'][1] = "Konrollieren Sie die Filtereinstellungen";
	$config['text']['german']['mat']['filter']['header1'] = "Datum/Uhrzeit";
	$config['text']['german']['mat']['filter']['header2'] = "Eigenschaften";
	$config['text']['german']['mat']['filter']['header3'] = "Sortieren nach";
	$config['text']['german']['mat']['nonew'] = "Artikel konnte nicht hinzugefügt werden";
	
	$config['text']['german']['id']['header'] = $config['text']['german']['title'];
	$config['text']['german']['id']['footer'][0] = "- Bitte identifizieren Sie sich -";
	$config['text']['german']['id']['footer'][1] = "- Bitte Person wählen. -";
	$config['text']['german']['id']['user']['cn'] = "Name";
	$config['text']['german']['id']['user']['mail'] = "Mailadresse";
	$config['text']['german']['id']['user']['pos'] = "Present";	
	$config['text']['german']['id']['user']['title'] = "Funktion";
	$config['text']['german']['id']['user']['samaccountname'] = "Kürzel";
	$config['text']['german']['id']['user']['mobile'] = "Mobile";
	$config['text']['german']['id']['button'][0] = "Fehler in der Datenbank";
	$config['text']['german']['id']['button'][1] = "Kein Artikel zum Zurückbuchen";
	$config['text']['german']['id']['button'][2] = "Sie haben <i>%s Artikel</i> ausgeliehen. Jetzt Zurückbuchen?";
	$config['text']['german']['id']['nopresent'][0] = "Die Present-Funktion steht derzeit nicht zur Verfügung";
	$config['text']['german']['id']['nopresent'][1] = "Klicken Sie hier um zum Hauptmenu zurückzukehren";
	$config['text']['german']['id']['change'] = "Hauptbenutzer ändern";
	
	$config['text']['german']['res']['header'] = $config['text']['german']['title'];
	$config['text']['german']['res']['footer'][0] = "- Reservieren Sie Ihren Artikel -";
	$config['text']['german']['res']['text'][0] = "Ausleihen von...";
	$config['text']['german']['res']['text'][1] = "...bis";
	$config['text']['german']['res']['text'][2] = "Ihr Kürzel:";
	$config['text']['german']['res']['text'][3] = "Kunde / Ort";
	$config['text']['german']['res']['incomplete'][0] = "Angaben sind unvollständig";
	$config['text']['german']['res']['incomplete'][1] = "Um Fortzufahren müssen alle Angaben vollständig und richtig ausgefüllt sein";
	$config['text']['german']['res']['user'][0] = "Artikel wird gebucht für: ";
	$config['text']['german']['res']['fail'][0] = "Unbekanntes Kürzel";
	$config['text']['german']['res']['ok'][1] = "Klicken Sie hier um den Artikel zu reservielen.";
	$config['text']['german']['res']['confirm'][0] = "Wollen Sie diese Buchung wirklich löschen?";
	$config['text']['german']['res']['confirm'][1] = "Ja";
	$config['text']['german']['res']['confirm'][2] = "Nein";
	
	$config['text']['german']['back']['header'] = $config['text']['german']['title'];
	$config['text']['german']['back']['footer'][0] = "- Zurückbuchen -";
	$config['text']['german']['back']['text'][0] = "Sind irgendwelche Mängel zu verzeichnen?";
	$config['text']['german']['back']['text'][1] = "Rückgabe-Protokol:";
	$config['text']['german']['back']['list'][0] = "Wurde noch nie Ausgeliehen";
	$config['text']['german']['back']['list'][1] = "Keine Mängel angegeben";
	$config['text']['german']['back']['check'] = "Mängel als Email weiterleiten";
	$config['text']['german']['back']['button'] = "Diesen Artikel zurückbuchen";
	
	$config['text']['german']['user']['header'] = $config['text']['german']['title'];
	$config['text']['german']['user']['mmt'] = "MMT-Rechte (User)";
	$config['text']['german']['user']['mma'] = "MMA-Rechte (Admin)";
	$config['text']['german']['user']['username'] = "Benutzername";
	$config['text']['german']['user']['pw'][0] = "Passwort";
	$config['text']['german']['user']['pw'][1] = "Passwort wiederholen";
	$config['text']['german']['user']['del'] = "Benutzer löschen";
	$config['text']['german']['user']['save'] = "Benutzer spiechern";
	$config['text']['german']['user']['new'] = "Benutzer hinzufügen";
	$config['text']['german']['user']['msg']['pwfail'] = "Bitte Passwort kontrollieren/eingeben";
	$config['text']['german']['user']['msg']['userfail'] = "Bitte Benutzername kontrollieren/eingeben";
	$config['text']['german']['user']['msg']['ask'] = "Wollen Sie diesen Benutzer wirklich löschen?";

	$config['text']['german']['abuchen']['header'][0] = "Ausbuchen";
	$config['text']['german']['zbuchen']['header'][0] = "Zurückbuchen";
	$config['text']['german']['search']['header'][0] = "Übersicht";
	$config['text']['german']['present']['header'][0] = "Present";
	$config['text']['german']['wizard']['back'] = "Zurück";
	$config['text']['german']['wizard']['filter'] = "Filter";
	$config['text']['german']['wizard']['logout'] = "Abmelden";
	
	$config['text']['german']['noty'][0] = array("Buchung nicht gespeichert. Wenden Sie sich an die IT", "error");
	$config['text']['german']['noty'][1] = array("Artikel erfolgreich gebucht.", "success");
	$config['text']['german']['noty'][2] = array("Konnte nicht gelöscht werden.", "error");
	$config['text']['german']['noty'][3] = array("Wurde gelöscht.", "success");
	$config['text']['german']['noty'][4] = array("Artikel wurde zurückgebucht.", "success");
	$config['text']['german']['noty'][5] = array("Änderungen gespeichert.", "success");
	$config['text']['german']['noty'][6] = array("Benutzer hinzugefügt.", "success");
	
	$config['text']['mail']['subject'] = "MMT - Meldung über Defekt";
	$config['text']['mail']['msg'] = "%s hat am %s einen defekten Artikel (%s) gemeldet. /r/n Fehlerbeschrieb: /n %s /r/n";
	
	$config['wizards'][0] = array("mmt", "kat", "mat", "art", "res");
	$config['wizards'][1] = array("mmt","id", "mat", "back");
	$config['wizards'][2] = array("mmt","mat", "art");
	$config['wizards'][3] = array("mmt","id");
	$config['wizards'][4] = array("mma", "id");
	$config['wizards'][5] = array("kat", "mat", "art");
	$config['wizards'][6] = array("user");
	
	$config['sql']['host'] = "localhost";
	$config['sql']['username'] = "mmt	";
	$config['sql']['passwort'] = "1234";
	$config['sql']['db']['mmt'] = "mmt";
	$config['sql']['db']['login'] = "logon";
	
	

	require_once($config['files']['db']);
	$db = new dB;
	
	define ("SUCCESS", 1);
	define ("FAILED", -1);
	error_reporting(E_ALL| E_STRICT);
	
	if(!isset($config['attributes'])) {
	
		$attr_sql = 'SELECT * FROM attribute';
		$result = $db->query_MySQL($attr_sql);
			
		while ($row = $db->fetchObject($result)) {
			$config['attributes'][$row->da_kat][$row->da_attr] = $row->da_name;
		}	
		$db->disconnect_MySQL();
		
	}
	
	//Zeitzone
	setlocale(LC_ALL, 'de_DE');
    date_default_timezone_set('Europe/Zurich');
	
	if(!isset($config['settings'])) {
	
		$config_sql = 'SELECT * FROM config';
		$con = $db->query_MySQL($config_sql);
			
		while ($cons = $db->fetchObject($con)) {
			$config['settings'][$cons->dc_key] = $cons->dc_value;
		}	
		$db->disconnect_MySQL();
		
	}
	
	function checkVariable($string) {
        return str_replace ( array ( '&', '"', "'", '<', '>' ),
        array ( '&amp;' , '&quot;', '&apos;' , '&lt;' , '&gt;' ), $string );
	}
	
	
?>