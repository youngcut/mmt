<?
class dB {
	private $dbLink;
	private $adLink;
	public  $queryCount = 0;
	
	//Zugriffdaten Active Directory
	private $adHost = "KSA-AD-3";
	private $adUsername = "chkima\mmt";
	private $adPassword = "seCaCC3s_maT";
	private $dn = "DC=kimanet, DC=ch";
	private $adSearch = "samaccountname";
	
	//Zugriffdatent MySQL (intern geschützt)
	private $dbHost = "localhost";
	private $dbUsername = "mmt";
	private $dbPassword = "1234";
	private $dbName = "mmt";
	
	//verbinden MySQL
	function connect_MySQL() {
			$this->dbLink = mysql_connect($this->dbHost, $this->dbUsername, $this->dbPassword);
	
			if (!$this->dbLink) {
					$this->ShowError();
					return false;
			}
			else if (!mysql_select_db($this->dbName,$this->dbLink))        {
					$this->ShowError();
					return false;
			} else {
					mysql_query("set names utf8",$this->dbLink);
					return true;
			}
	}
	
	//trennen MySQL
	function disconnect_MySQL() {
			 mysql_close($this->dbLink);
			 $this->dbLink = "";
	}
	
	//verbinden AC
	function connect_LDAP() {
		 $this->adLink = ldap_connect($this->adHost)
		 or die(-1);
		 ldap_set_option($this->adLink, LDAP_OPT_PROTOCOL_VERSION, 3);
		 ldap_set_option($this->adLink, LDAP_OPT_REFERRALS, 0);
		 if(!$this->adLink) {
				 $this->ShowError();
				 return false;
		 }
		 else if (!ldap_bind($this->adLink, $this->adUsername, $this->adPassword)) {
				 $this->ShowError();
				 return false;
		 } else {
				 return true;
		 }
	}
	
	//fehler auswerten
	function ShowError() {
			$error = mysql_error();
	}
	
	//befehle ausführen
	function query_MySQL($query) {
			 $result = "";
			 if (!$this->dbLink) {
				$this->connect_MySQL();
			 }
			 if (!$result = mysql_query($query, $this->dbLink)) {
				   $this->ShowError();
				   return false;
			 }
			 $this->queryCount++;
			 return $result;
	}    
	
	//Id des letzten Eintrages holen
	function last_MySQL($lastId) {
			 $result = "";
			 if (!$this->dbLink) {
				$this->connect_MySQL();
			 }
			 if (!$result = mysql_insert_id()) {
				   $this->ShowError();
				   return false;
			 }
			 $this->queryCount++;
			 return $result;
	}            
	
	
	//Suche in AC
	function query_LDAP($query) {
		$result = false;
		if($query) {
			 $filter="(&(samaccountname=".$query."*)(objectCategory=person)(objectclass=user)(title=*)(mail=*))";
			 $justthese = array("samaccountname", "cn", "title", "mail", "mobile");
			 if (!$this->adLink) {
				$this->connect_LDAP();
			 }
			 if(! $result_ldap = ldap_search($this->adLink, $this->dn, $filter, $justthese)) {
				  return false;
			 } else {
					$next_step=ldap_first_entry($this->adLink, $result_ldap);
					if($next_step) $result = ldap_get_attributes($this->adLink, $next_step);
					 
			}
			ldap_close($this->adLink);
		}
		return $result;
	}
	
	//MySQL abfragen
	function fetchObject($result) {
			if (!$Object=mysql_fetch_object($result))
			{
					$this->ShowError();
					return false;
			}
			else
			{
					return $Object;
			}
	}

}
?>