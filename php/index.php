<?

// -------------------------------------------- 
// |      MMT - Material Management Tool       |
// |			Roman Gsponer 2013 ®		   |
// |			- Kilchenmann AG -			   |
// ---------------------------------------------

	//Konfigurationsdatei auslesen und Session (er)öffnen
	require_once("config.php");
	session_save_path($config['dir']['session']);
	session_start();
	require_once($config['dir']['php']."fnc_mmt.php");

	//Seite wird profilaktisch auf Login gesetzt
	$failtext = "";
	$showpage = (isset($_SESSION['goto'])) ? $_SESSION['goto'] : "login" ;
	
	//Abfrage goto
	if(isset($_REQUEST['goto'])) {
		switch ($_REQUEST['goto']) {
			case "logout":
				$_SESSION = array();
				session_destroy();
				break;
			default:
				if(!file_exists($config['dir']['php'].$_SESSION['goto'].".php")) {
					$failtext = "fail: not able to forward to: ".$_SESSION['goto'];
				} else {
					$showpage = checkVariable($_REQUEST['goto']);
				}
				break;
		}
	}
	
	

	//Schreibe Standard Sessionvariablen (falls nicht vorhanden)
	if(!isset($_SESSION['login'])) {
		$_SESSION["login"] = FALSE;
		$_SESSION["goto"] = "login";
		$_SESSION["isMma"] = FALSE;
		$_SESSION["mobileTheme"] = $config["theme"]["mmt"];
		$_SESSION["usr_name"] = "";
		$_SESSION["mmt_rechte"] = 0;
		$_SESSION["mma_rechte"] = 0;
		$_SESSION["cur_Lang"] = $config['settings']["language"];
		$_SESSION["kat"] = 0;
		$_SESSION["mat"] = 0;
		$_SESSION["back"] = "";
		$_SESSION["wizard"] = 0;
		$showpage = 'login';
	}
	
	//Logindaten erhalten
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$showpage = 'login';
		$failtext = $config['text']['german']['login']['fail'][3];
		if((isset($_POST['username']) === true && $_POST['username'] != NULL) &&
		(isset($_POST['passwort']) === true && $_POST['passwort'] != NULL) &&
		(isset($_POST['forward']) === true && $_POST['forward'] != NULL)) {
				$username = checkVariable($_POST['username']);
				$passwort = checkVariable($_POST['passwort']);
				$forward = checkVariable($_POST['forward']);
				$return = checkLogin($username, $passwort, $forward);
				$showpage = $return[0];
				$failtext = $return[1];
		}
	}
?>

<!-- MMT - Material Management Tool - Copyright Roman Gsponer 2013® - für Kilchenmann AG -->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" />
<html xmlns="http://www.w3.org/1999/xhtml" />
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="<? echo $config['dir']['css'] ?>jquery.mobile-1.3.1.css" />
<link rel="stylesheet" href="<? echo $config['dir']['css'] ?>mmt.css" />
<link rel="stylesheet" type="text/css" href="<? echo $config['dir']['css'] ?>datepicker.css" />
<script src="<? echo $config['dir']['jquery'] ?>jquery-1.8.2.min.js"></script>
<script src="<? echo $config['dir']['jquery'] ?>jquery.mobile-1.3.1.js"></script>
<script src="<? echo $config['dir']['js'] ?>fnc_ajax.js"></script>
<script src="<? echo $config['dir']['js'] ?>mmt.js"></script>
<script src="<? echo $config['dir']['js'] ?>clock.js"></script>

<script type="text/javascript" src="<? echo $config['dir']['jquery'] ?>jqm-datebox.core.min.js"></script>
<script type="text/javascript" src="<? echo $config['dir']['jquery'] ?>jqm-datebox.mode.calbox.min.js"></script>
<script type="text/javascript" src="<? echo $config['dir']['jquery'] ?>jquery.mobile.datebox.i18n.de.utf8.js"></script>
<script type="text/javascript" src="<? echo $config['dir']['jquery'] ?>jquery.noty.js"></script>
<script type="text/javascript" src="<? echo $config['dir']['jquery'] ?>layouts/center.js"></script>
<script type="text/javascript" src="<? echo $config['dir']['jquery'] ?>themes/default.js"></script>


<title><? echo $config['text']['german']['title'] ?></title>

<? print_r($_SESSION); ?>

</head>
<body>


    <div data-role="page" id="<? echo $showpage ?>">
    
	<?
        //Meldung
        if(isset($_SESSION['msg']))  {
            $msg = $config['text']['german']['noty'][$_SESSION['msg']];
            echo '<div id="msg" data-msg="'.$msg[0].'" data-style="'.$msg[1].'"></div>';
            unset($_SESSION['msg']);
        }
    ?>
        <? echo getHeader($showpage); ?>
        
        <div data-role="content" id="content" data-theme="<? echo $_SESSION["mobileTheme"]; ?>">
			<? require_once($config['dir']['php'].$showpage.'.php'); ?>
        </div>
    	
		<? echo getFooter($showpage); ?>
        
	</div>
    
</body>
</html>