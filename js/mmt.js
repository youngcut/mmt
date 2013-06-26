
var config = new Array()

$(document).ready(function(){
	
	config['ajaxPath'] = "../php/fnc_ajax.php";
	config['ajaxPic'] = "../php/fnc_getPic.php";
	config['txtResUser'] = configVar(['text', 'german', 'res', 'user', 0])
	config['txtResFail'] = configVar(['text', 'german', 'res', 'fail', 0])
	config['txtResIncomplete'] = configVar(['text', 'german', 'res', 'incomplete', 1])
	config['picPath'] = configVar(['dir', 'css'])+"images/"
	
	setInterval('getMyTime("setHeader")', 1000);
	
	var arrChange = [];
	var thisPage
	
	
	//Seitenaufruf
	$('div').live('pageshow',function(event, ui){ init(event.target.id);})
	$("#header").live( "click", function() {$("#cola").trigger( "expand" )});
	$("#content").live( "click", function() {$("#cola").trigger( "collapse" )});

	function init(thisPage) {
		
		//Lade User-Bild wenn data-user im Bild gesetzt ist.
		$('img').each(function(event, ui) {if($(this).data("user")) $(this).attr("src", getUserPic($(this).data("user")))})
		if($('#msg').length) {
			noty({
				text: $('#msg').data('msg'),
				type: $('#msg').data('style'),
				timeout: 3000,
				layout: 'center',
				theme: 'defaultTheme'
			});
		}
		
		getMyTime("setHeader")
		//Wird bei Seitenwechsel ausgeführt
		switch (thisPage) {
			case "mmt" : //Bei Aufruf von Haupftseite
				
			break;
					
			case "res" : // Bei Aufruf von Reservation
				var setBook = {};
				
				setBook["db_index"] = sessionVar(["mat"], "TRUE")[0];
				
					
				setBook["from"] = $('#checkin').datebox('callFormat', '%Y-%m-%d',  $('#checkin').datebox('getTheDate'));
				setBook["to"] = $('#checkout').datebox('callFormat', '%Y-%m-%d',  $('#checkout').datebox('getTheDate'));
			
				$('#slidein').val(parseFloat(getMyTime("slider")));
				$('#slidein').slider('refresh');
				$('#slidein').val(getMyTime("slider"));
				$('.resdate').val(getMyTime("databox"));

				checkSlider("slideout", false)
				
				var ganzZahl = parseInt($('#sliderin').val());
				var nachKomma = parseFloat($('#sliderin').val())-ganzZahl;
				var minuTen = "00";
				if(nachKomma == 0.5) minuTen = "30";
				$('#sliderin').value = ganzZahl+"."+minuTen;
				setBook["db_from_t"] = ($('#slidein').val() > 9.30) ? $('#slidein').val().replace(".", ":")+":00" :"0"+$('#slidein').val().replace(".", ":")+":00";
				setBook["db_to_t"] = ($('#slideout').val() > 9.30) ? $('#slideout').val().replace(".", ":")+":00" :"0"+$('#slideout').val().replace(".", ":")+":00";
				
				
				if((parseFloat($('#slidein').val())+0.5) > parseFloat($('#slideout').val())) $('#checkout').val(getMyTime("databox", true));
	
				$(".resdate").change(function(event, ui) { //Datum hat sich geändert
					setBook["from"] = $('#checkin').datebox('callFormat', '%Y-%m-%-d',  $('#checkin').datebox('getTheDate'));
					setBook["to"] = $('#checkout').datebox('callFormat', '%Y-%m-%-d',  $('#checkout').datebox('getTheDate'));
				});
				
				$(".resslider").change(function(event, ui) { //Zeit hat sich geändert
					
					checkSlider(event.target.id);
					
					var ganzZahl = parseInt($(this).val());
					var nachKomma = parseFloat($(this).val())-ganzZahl;
					var minuTen = "00";
					if(nachKomma == 0.5) minuTen = "30";
					event.target.value = ganzZahl+"."+minuTen;
					setBook["db_from_t"] = ($('#slidein').val() > 9.30) ? $('#slidein').val().replace(".", ":")+":00" :"0"+$('#slidein').val().replace(".", ":")+":00";
					setBook["db_to_t"] = ($('#slideout').val() > 9.30) ? $('#slideout').val().replace(".", ":")+":00" :"0"+$('#slideout').val().replace(".", ":")+":00";
					
				});
				
				$(".resinput").keyup(function(event, ui) { //Inputs haben sich geändert
					
					delete setBook["db_place"];
					var curItem = new Array();
					//Hole aktuelle Angaben vom Button
					curItem["class"] = $("#item_pic").attr("class").split(" ");
					curItem["class"][0] = "img_list_fail";
					curItem["img"] = $("#item_pic").attr("src");
					curItem["line1"] = $('#item_title').html();
					curItem["line2"] = config['txtResIncomplete'];
					curItem["onClick"] = "";
					//Kürzel auswerten
					if($("#user").val() != "") {
						usr = getUser($("#user").val())
						if(!usr["fail"]) { //Falsche Userdaten
							curItem["line1"] = config['txtResUser']+usr.cn[0]
							curItem["img"] = getUserPic(usr['sAMAccountName'][0])
							if(event.target.id == "user") setBook["db_user"] = usr['sAMAccountName'][0]
						} else {
							delete setBook["db_user"];
							curItem["line1"] = config['txtResFail'];
							curItem["class"][0] = 'img_list_occupied'
							curItem["img"] = config['picPath']+"btn_occupied.png"
							
						}
					}
					
					if($("#place").val() != "") setBook["db_place"] = $("#place").val()
					
					var lenBook = 0
					
					//Grösse des Arrays ermitteln
					$.each(setBook, function() {
						lenBook++
					});
					
					if(lenBook == 7) { //Alle angaben ok!
					console.log(setBook)
						curItem["class"][0] = "img_list_available"
						curItem["line2"] = configVar(['text', 'german', 'res', 'ok', 1])
						curItem["onClick"] = "booking()"
					}
					
					$('#item_a').attr("onClick", curItem["onClick"])
					$("#item_pic").attr("src", curItem["img"])
					$("#item_pic").attr("class", curItem["class"].join(" "))
					$('#item_title').html(curItem["line1"])
					$('#item_subtitle').html(curItem["line2"])
						
					booking = function() {
						
						setBook["to"] = $('#checkout').datebox('callFormat', '%Y-%m-%-d',  $('#checkout').datebox('getTheDate'));
						setBook["db_from"] = setBook["from"]+" "+setBook["db_from_t"];
						setBook["db_to"] = setBook["to"]+" "+setBook["db_to_t"];
						
						//console.log(setBook["db_from_t"]);
						//console.log($('#checkout').datebox('callFormat', '%-d. %B %Y',  $('#checkout').datebox('getTheDate')))
						console.log(setBook["db_from"]+" - "+setBook["db_to"])
						
						output = checkBooking(setBook["db_index"], setBook["db_from"], setBook["db_to"]) 
						
						if(output != 0) {
						
							noty({
								text: output,
								type: 'error',
								timeout: 3000,
								layout: 'center',
								theme: 'defaultTheme'
							});
							
						} else {
							delete setBook["db_to_t"]
							delete setBook["db_from_t"];
							delete setBook["from"]
							delete setBook["to"];
							
							newMat = makeNew("booking", setBook)
							if (newMat > 0) { //gespeichert
								setBook = {}
								chgPage(0, false, {'msg':1});
							} else {//nicht gespeichert
								chgPage(0, false, {'msg':0});
							};
							
						}
									
					}
				
				});
				
			break;
			case 'id' : //Bei Aufruf von Identifikation
				$('#search-basic').keyup(function() {
					res = getUser($('#search-basic').val())
					var usr
					$(".userInfos").val("-")
					$.each(res, function(key, value) {
						$("#"+key.toLowerCase()).html(value[0])
						if(key.toLowerCase() == "samaccountname") usr = value[0]
					});
					if($('#search-basic').val()) {
						$("#userButton").html(getBackButton(usr))
						$("#userButton").listview("refresh");
					}
				});
			break;
		}
	}
	
	//Speicherfunktion
	$( "body" ).delegate(".saver", {
		//Markiert Textinhalt wenn aktiviert
   		focus: function(event, ui) { 
			curVal = $(this).val()
			$(this).select() 
			this.onmouseup = function() {
            	this.onmouseup = null;
            	return false;
        		};
			},
		focusout: function(event, ui) {
			//Wenn feld verlassen
			if(curVal != $(this).val()) {
				//Attributes vorbereiten und filtrieren
				var attributes = {};
				$.each( this.attributes, function( index, attr ) {
					if(attr.name.slice(0,2) == "db") {
						attributes[ attr.name ] = attr.value;
					}
				});
				if($(this).attr('id') == "usr"){
					usr = getUser($(this).val());
					attributes['value'] = usr['sAMAccountName'][0].toLowerCase();
					$(this).val(usr['cn'][0])
				} else {
					attributes['value'] = $(this).val();
				}
				if(typeof(attributes['db-autosave']) != "undefined") {
					//autosave
					makeChange(attributes);
				} else {
					//nicht autosave
					arrChange[parseInt($('input').index(this))] = attributes
				}
			}
		}
	});
	
	//Schaut das Slider sich nicht überschneiden
	checkSlider = function(sli, fromDate) {		
		if($('#checkout').val()==$('#checkin').val()) { //Gleicher Tag
		
			if(fromDate) {
				$('#slidein').val(parseFloat(6));
				$('#slidein').slider('refresh');
				$('#slideout').val(parseFloat(17));
				$('#slideout').slider('refresh');
			}
		
			preChangeOut = parseFloat($('#slidein').val())+1
			preChangeIn = parseFloat($('#slideout').val())-1
			
			if((sli == "slidein")) {
				if((parseFloat($('#slidein').val())+0.5) >= parseFloat($('#slideout').val())) {
					$('#slidein').val(preChangeIn);
					$('#slidein').slider('refresh');
				}
			} else {
				if((parseFloat($('#slideout').val())-0.5) <= parseFloat($('#slidein').val())) {	
					$('#slideout').val(preChangeOut)
					$('#slideout').slider('refresh');
				}
			} 
		}
		
	}
	
	lockDateOut = function (date, name) {
		
		today    = new Date();
		curInDate = $('#checkin').datebox('callFormat', '%Y%m%d',  $('#checkin').datebox('getTheDate'))
		curOutDate = $('#checkout').datebox('callFormat', '%Y%m%d',  $('#checkout').datebox('getTheDate'))
		if (curOutDate < curInDate){
				$('#checkout').datebox('setTheDate', $('#checkin').datebox('getTheDate'));
				$('#checkout').val($('#checkout').datebox('callFormat', '%-d. %B %Y',  $('#checkout').datebox('getTheDate')));
		}
		checkSlider("slidein", true);
		// The difference of today and whatever got set (secs)
		diff     = parseInt((date - today) / ( 1000 * 60 * 60 * 24 ),10);
		// The same difference, in days (+1)
		diffstrt = (diff * -1)-1;
		$('#checkout').datebox({"minDays": diffstrt});
		
	}
	
	lockDateIn = function (date, name) {
		checkSlider("slideout", true);
		
	}

	$( "#popupPanel" ).on({
			popupbeforeposition: function() {
			var h = $( window ).height();
			$( "#popupPanel" ).css( "height", h );
		}
	});
	
	//Löscht eine Buchung
	delBook = function(bookId) {
		
		noty({
			text: configVar(["text", "german", "res", "confirm","0"]),
			type: 'warning',
			timeout: 3000,
			layout: 'center',
			theme: 'defaultTheme',
			buttons: [
			{addClass: 'btn btn-primary', text: configVar(["text", "german", "res", "confirm","1"]), onClick: function($noty) {
				$noty.close();
				if(delElement('booking', 'id = '+bookId) == 1) {
					chgPage(2, false, {msg:"3"});
				} else {
					chgPage(2, false, {msg:"2"});
				}
			  }
			},
			{addClass: 'btn btn-danger', text: configVar(["text", "german", "res", "confirm","2"]), onClick: function($noty) {
				$noty.close();
			  }
			}
			]
		});
	}
	
	//Erzeugt neuen Artikel
	makeArt = function(katId) {
		newId = makeNew("objects", {"do_class":katId, "do_user":configVar(['settings',0]).toLowerCase()})
		if (newId > 0) { //gespeichert
			setBook = {}
			chgPage(0, false, {'mat':newId});
		} else {//nicht gespeichert
			noty({
				text: configVar(['text', 'german', 'mat', 'nonew']),
				type: 'error',
				timeout: 3000,
				layout: 'center',
				theme: 'defaultTheme'
			});
		};
		
	}
	
	//Lösche Artikel in MMA
	delArt = function(artId) {
		
		noty({
			text: configVar(["text", "german", "art", "confirm","0"]),
			type: 'warning',
			timeout: 3000,
			layout: 'center',
			theme: 'defaultTheme',
			buttons: [
			{addClass: 'btn btn-primary', text: configVar(["text", "german", "art", "confirm","1"]), onClick: function($noty) {
				$noty.close();
				if(delElement('objects', 'do_index = '+artId) == 1) {
					chgPage(2, false, {msg:"3"});
				} else {
					chgPage(2, false, {msg:"2"});
				}
			  }
			},
			{addClass: 'btn btn-danger', text: configVar(["text", "german", "art", "confirm","2"]), onClick: function($noty) {
				$noty.close();
			  }
			}
			]
		});
	}
	
	//Wird Variable übergeben fügt diese dem arrChange hinzu. Ansonsten wird arrChange übergeben.
	makeChange = function(attributes) {
			
			if(typeof(attributes) == "object") {
				
				update(attributes)
				
			} else {
				
				if(attributes == false) {
					arrChange = []
					chgPage(0, false, {})
				} else {
					test = [0, 0]
					for (arr in arrChange) {
						if(update(arrChange[arr])) test[0]++
						test[1]++
					}
					arrChange = []
					if(test[0]==test[1]) chgPage(0, false, {msg:5})
				}
			}
		}
		
	//Artikel wird zurückgebucht
	bookBack = function(matId) {
		
		dam = $('#txt_dam').val()
		mail = 0
		if($("#chk_dam").attr('checked')) mail = 1 

		if(getBack(matId, dam, mail)) {
			chgPage(0, false, {msg:"4"});
		} else {
			chgPage(0, false, {msg:"0"});
		}
		
		
	}
	
	//Verwaltet Benutzer im MMA
	userMod = function(doto, element) {
	
		switch (doto) {
			case 0 : //lösche element
				noty({
					text: configVar(["text", "german", "user", "msg", "ask"]),
					type: 'warning',
					timeout: 3000,
					layout: 'center',
					theme: 'defaultTheme',
					buttons: [
					{addClass: 'btn btn-primary', text: configVar(["text", "german", "art", "confirm","1"]), onClick: function($noty) {
						$noty.close();
						if(delElement('logon', 'dl_index = '+element) == 1) {
							chgPage(2, false, {msg:"3"});
						} else {
							chgPage(2, false, {msg:"2"});
						}
					  }
					},
					{addClass: 'btn btn-danger', text: configVar(["text", "german", "art", "confirm","2"]), onClick: function($noty) {
						$noty.close();
					  }
					}
					]
				});
			break
			case 1 : //Ändere Element
			 
				
				if(($("#pass_a"+element).val() != $("#pass_b"+element).val()) || ($("#pass_a"+element).val().length < 4) || ($("#pass_b"+element).val().length < 4)) {
				noty ({
					text: configVar(['text', 'german', 'user', 'msg', 'pwfail']),
					type: 'error',
					timeout: 3000,
					layout: 'center',
					theme: 'defaultTheme'
				});
				} else {
					
					chg1 = update({'db-database': 'logon', 'db-field': 'dl_mmt', 'db-where': 'dl_index = '+element, 'value':($("#check_a"+element).attr('checked')) ? 1 : 0}) 
					chg2 = update({'db-database': 'logon', 'db-field': 'dl_mma', 'db-where': 'dl_index = '+element, 'value':($("#check_b"+element).attr('checked')) ? 1 : 0})
					chg3 = update({'db-database': 'logon', 'db-field': 'dl_pass', 'db-where': 'dl_index = '+element, 'value':$("#pass_a"+element).val()})
					if(chg1+chg2+chg3 == 3) {
						chgPage(0, false, {msg:"5"});
					}
					
				}
				
			break
			case 2 : //Neues Element
				
				if($("#in_b"+element).val().length < 4) {
					noty ({
						text: configVar(['text', 'german', 'user', 'msg', 'userfail']),
						type: 'error',
						timeout: 3000,
						layout: 'center',
						theme: 'defaultTheme'
					});
					break;
				}
				
				if(($("#pass_a"+element).val() != $("#pass_b"+element).val()) || ($("#pass_a"+element).val().length < 4) || ($("#pass_b"+element).val().length < 4)) {
					noty ({
						text: configVar(['text', 'german', 'user', 'msg', 'pwfail']),
						type: 'error',
						timeout: 3000,
						layout: 'center',
						theme: 'defaultTheme'
					});
					break;
				} 
					done = makeNew('logon', {	'dl_user':$('#in_b0').val(),
												'dl_mmt':($('#check_a0').attr('checked')) ? 1 : 0,
												'dl_mma':($('#check_b0').attr('checked')) ? 1 : 0,
												'dl_pass':$('#pass_b0').val()});
												
					if(done) chgPage(0, false, {msg:"6"});
			break
			
		}
		
	}
	
	
	chgUser = function(user) {
		done = update({'db-database':'config', 'db-field': 'dc_value', 'db-where':'dc_key=0', 'value':user});
		if(done) {
			chgPage(0, false, {msg:"5"})
		}
	}
	
	chgPage = function(wizback, setWiz, setVar, transl) {
		
		var arrChange = [];
		
		
		if(!transl) transl = 'slide'
		
		//Assistent Setzen
		if(typeof(setWiz) != "number") {
			var wizInfo = sessionVar(["wizard", "curWizPos"], "TRUE");
		} else {
			if(setWiz>3) {
				var wizInfo = [setWiz, -1];
			} else {
				var wizInfo = [setWiz, 0];
			}
		}
		
		//gewünschter Assistent Auslesen
		var wizArr = configVar(["wizards", wizInfo[0]]);
		
		var nextWizPos = wizInfo[1]
		
		if(wizback != true){
			nextWizPos++
		} else {
			nextWizPos--;
		}
		
		if((wizArr.length <= nextWizPos) || (wizback == 2)) nextWizPos = 0;
		
		var preSession = {"wizard":wizInfo[0], "curWizPos":nextWizPos, "goto":wizArr[nextWizPos]}
		
		
		if(typeof(setVar) == "object") {
			$.extend(preSession, setVar)
		}
		
		
		sessionVar(preSession, "FALSE")
		
		thisPage = wizArr[nextWizPos]
		
		
		$.mobile.changePage("index.php", {
			transition: transl,
			reverse: wizback,
			allowSamePageTransition: true,
			method: "post",
			reloadPage: true
		})
	}
	
	init($(".ui-page")[0].id)
});