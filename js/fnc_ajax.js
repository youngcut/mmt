
function delElement(db, where) {
	result = 0;
	$.ajax({
			type: 'POST',
			url: config['ajaxPath'] ,
			data: { action: "delElement", db:db, where:where },
			timeout:100000,
			async: false,
			success: function(data) {
									result = JSON.parse(data);
							},
			error: function(par1, par2, par3){
					alert("Error in ajax..")
			}
	});
	return result			
}

function getUserPic(user) {
	var result = "";
	$.ajax({
			type: 'POST',
			url: config['ajaxPath'],
			data: "action=getUserPic&user="+user,
			timeout:100000,
			async: false,
			success: function(data) {
									result = data;
							},
			error: function(par1, par2, par3){
					alert("Error in ajax..")
			}
	});
	return result;
}

function getUser(query) {
	  var result = "";
	  $.ajax({
			  type: 'POST',
			  url: config['ajaxPath'] ,
			  data: "action=getUser&query="+query,
			  timeout:100000,
			  async: false,
			  success: function(data) {
									  result = JSON.parse(data);
									  console.log(result)
							  },
			  error: function(par1, par2, par3){
					  alert("Error in ajax..")
			  }
	  });
	  return result;
}


function getBack(art, dam, mail) {
	  var result = "";
	  $.ajax({
			  type: 'POST',
			  url: config['ajaxPath'] ,
			  data: { action: "getBack", art: art, dam: dam, mail:mail },
			  timeout:100000,
			  async: false,
			  success: function(data) {
									  result = data;
							  },
			  error: function(par1, par2, par3){
					  alert("Error in ajax..")
			  }
	  });
	  return result;
}

function configVar(arr) {
	result = 0;
	$.ajax({
			type: 'POST',
			url:  config['ajaxPath'],
			data: { action: "configVar", arr: arr },
			timeout:100000,
			async: false,
			success: function(data) {
									result = JSON.parse(data);
							},
			error: function(par1, par2, par3){
					alert("Error in ajax..")
			}
	});
	return result
}

function sessionVar(arr, readOnly) {
	result = 0;
	if(!readOnly) readOnly = 0
	$.ajax({
			type: 'POST',
			url: config['ajaxPath'],
			data: { action: "sessionVar", arr: arr, readO: readOnly },
			timeout:100000,
			async: false,
			success: function(data) {
									result = JSON.parse(data);
							},
			error: function(par1, par2, par3){
					alert("Error in ajax..")
			}
	});
	return result
}

function makeNew(db, arr) {
	console.log(arr);
	$.ajax({
			type: 'POST',
			url: config['ajaxPath'],
			data: { action: "newElement", arr: arr, db: db },
			timeout:100000,
			async: false,
			success: function(data) {
									result = JSON.parse(data);
							},
			error: function(par1, par2, par3){
					alert("Error in ajax..")
			}
	});
	return result
}

function checkBooking(mat, from, to) {
	
	$.ajax({
			type: 'POST',
			url: config['ajaxPath'],
			data: { action: "checkBooking", mat: mat, from: from, to: to },
			timeout:100000,
			async: false,
			success: function(data) {
									result = data;
							},
			error: function(par1, par2, par3){
					alert("Error in ajax..")
			}
	});
	return result
}

function update (arr) {
	result = "Fehler!";
	$.ajax({
			type: 'POST',
			url: config['ajaxPath'] ,
			data: { action: "updateElement", changes: arr },
			timeout:100000,
			async: false,
			success: function(data) {
							result = data;
							},
			error: function(par1, par2, par3){
					alert("Error in ajax..")
			}
	});
	if(result != "-1") {
		arrChange = [];
		return 1;
	}
}


function getBackButton(user) {
	$.ajax({
			type: 'POST',
			url: config['ajaxPath'] ,
			data: { action: "getBackButton", user: user },
			timeout:100000,
			async: false,
			success: function(data) {
							result = data;
							},
			error: function(par1, par2, par3){
					alert("Error in ajax..")
			}
	});
		return result
}


