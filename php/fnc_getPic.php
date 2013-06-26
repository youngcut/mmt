<?

	if(!isset($config)) {
		require_once("../config.php");
		require_once($config['dir']['php']."fnc_mmt.php");
		
		session_save_path($config['dir']['session']);
		session_start();
	}
	
	



?>