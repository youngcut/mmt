
    <?	
		$filter = "";
		$sort = "do_name";
		$isBack = 0;
        //Angeforderte Materialliste wird geholt
		if($_SESSION['kat'] != 0) { //Kategorie wurde gesetzt
			$filter = (1 <= $_SESSION['kat']) && ($_SESSION['kat'] <= 4) ? "do_class = ".$_SESSION['kat'] : "";
			
		}
		//Filtert nur von User ausgeliehene Artikel wenn im 'Zurückbuchenmodul' (Array gefüllt von id) ist. 
		if($_SESSION['back'] != ""){
			$arrBack = explode(", ", $_SESSION['back']);
			$filter = "do_index IN(";
			if(count($arrBack) >1) {
				$filter .= implode($arrBack, ", ").")";
			} else {
				$filter = "do_index = ".$arrBack[0];	
			}
			$isBack = 1;
		}
		
		echo getMatList($filter, $sort, $isBack);
		
    ?>
	