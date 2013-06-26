function getMyTime(out, offset)
    {
    var currentTime = new Date();

    var currentHours = currentTime.getHours();
    var currentMinutes = currentTime.getMinutes();
    var currentSeconds = currentTime.getSeconds();
	var currentDay = currentTime.getDate();
	var currentYear = currentTime.getFullYear();
	var currentWeek = ["Sonntag", "Montag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag", "Samstag"][currentTime.getDay()];
	var currentMonth = ["Januar", "Februar", "März", "April", "Mai", "Juni", "Juli", "August", "September", "Oktober","November","Dezember"][currentTime.getMonth()];
    // Pad the minutes and seconds with leading zeros, if required
    currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;
    currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;

	
	switch (out) {
    	case 'datetime':
		    currentHours = ( currentHours < 10 ? "0" : "" ) + currentHours;
		    currentDay = ( currentDay < 10 ? "0" : "" ) + currentDay;
		    currentMonth = ( (currentTime.getMonth()+1) < 10 ? "0" : "" ) + (currentTime.getMonth()+1);
		
			return currentYear+"-"+currentMonth+"-"+currentDay+" "+currentHours+":"+currentMinutes+":"+currentSeconds;
			break;
    	case 'databox':
			(offset) ? offset = 1 : offset = 0;
			return (currentDay+offset)+". "+currentMonth+" "+currentYear;
			break;
		case 'setHeader':
    		$("#time").text(currentWeek + ", " + currentDay + ". " + currentMonth + " " + currentYear + " "+ currentHours + ":" + currentMinutes + ":" + currentSeconds);
			break;
		case 'slider':
			var resHours = currentHours
			var resMinutes = "00"
			if(currentMinutes > 0 && currentMinutes < 30) resMinutes = "30"
			if(currentMinutes > 30) resHours++
			if(resHours > 20) resHours = 20
			if(resHours < 6) resHours = 6
			return resHours+"."+resMinutes
			break;
	}
    
        
 }
