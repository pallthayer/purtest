var tooltips=Array();
tooltips["carsoffroad"]="Each day you carpool increases the cars off road tally by one.";
tooltips["milesnotdriven"]="Miles you didn't drive";
tooltips["emissions"]="Measured in pounds of CO2";
tooltips["confirmation_trigger"]="Triggers the daily ride confirm process (Upcoming Rides application)";
tooltips["private"]="The pool leader can invite members using the Edit Members page.";
tooltips["public"]="Members can request to join the pool. The pool leader accepts or declines.";
tooltips["default"]="Assigns a single default driver of your choice for all rides.";
tooltips["day_of_week"]="Assigns drivers by days of the week in the regular schedule.";
tooltips["fairness"]="Assigns a driver based on fairness. See Help section for more info.";
tooltips["default_route"]="The default route. Can be changed when daily rides are finalized.";
tooltips["driver_assignment"]="Driver assignment. Can be changed when daily rides are finalized.";
tooltips["driver_ranking"]="Listed in order of whose turn it is to drive based on Purpool fairness.";

tooltips["monday_driver_ranking"]="Listed in order of whose turn it is to drive based on Purpool fairness.";
tooltips["tuesday_driver_ranking"]="Listed in order of whose turn it is to drive based on Purpool fairness.";
tooltips["wednesday_driver_ranking"]="Listed in order of whose turn it is to drive based on Purpool fairness.";
tooltips["thursday_driver_ranking"]="Listed in order of whose turn it is to drive based on Purpool fairness.";
tooltips["friday_driver_ranking"]="Listed in order of whose turn it is to drive based on Purpool fairness.";
tooltips["saturday_driver_ranking"]="Listed in order of whose turn it is to drive based on Purpool fairness.";
tooltips["sunday_driver_ranking"]="Listed in order of whose turn it is to drive based on Purpool fairness.";



function addToolTipListeners(){
	var i;
	// Add mouse over and out event listeners to tooltip objects -anchors with tooltipClass class attribute
	for(i=0;i<document.anchors.length;i++){
		if(document.anchors[i].className=="tooltipClass"){
			document.anchors[i].onmouseover=tooltipOn;
			document.anchors[i].onmouseout=tooltipOff;
		}
	}
}
function tooltipOn(evt){
	var mouse = mouseCoords(evt);
	document.getElementById("tooltip").style.left = 10 + mouse.x + "px";
	document.getElementById("tooltip").style.top = -60 + mouse.y + "px";
	document.getElementById("tooltip").innerHTML = tooltips[this.id];//tooltips["carsoffroad"];
	document.getElementById("tooltip").style.visibility = "visible";
}
function tooltipOff(){
	document.getElementById("tooltip").style.visibility = "hidden";
}

function mouseCoords(ev){ 
	ev  = ev || window.event;
	if(ev.pageX || ev.pageY){ 
		return {x:ev.pageX, y:ev.pageY}; 
	} 
	return { 
		x:ev.clientX + document.body.scrollLeft - document.body.clientLeft, 
		y:ev.clientY + document.body.scrollTop  - document.body.clientTop 
	}; 
} 

function addMondayToolTipListener(){
	document.getElementById("monday_driver_ranking").onmouseover=mondayTooltipOn;
	document.getElementById("monday_driver_ranking").onmouseout= mondayTooltipOff;
}
function addTuesdayToolTipListener(){
	document.getElementById("tuesday_driver_ranking").onmouseover=tuesdayTooltipOn;
	document.getElementById("tuesday_driver_ranking").onmouseout= tuesdayTooltipOff;
}
function addWednesdayToolTipListener(){
	document.getElementById("wednesday_driver_ranking").onmouseover=wednesdayTooltipOn;
	document.getElementById("wednesday_driver_ranking").onmouseout= wednesdayTooltipOff;
}
function addThursdayToolTipListener(){
	document.getElementById("thursday_driver_ranking").onmouseover=thursdayTooltipOn;
	document.getElementById("thursday_driver_ranking").onmouseout= thursdayTooltipOff;
}
function addFridayToolTipListener(){
	document.getElementById("friday_driver_ranking").onmouseover=fridayTooltipOn;
	document.getElementById("friday_driver_ranking").onmouseout= fridayTooltipOff;
}
function addSaturdayToolTipListener(){
	document.getElementById("saturday_driver_ranking").onmouseover=saturdayTooltipOn;
	document.getElementById("saturday_driver_ranking").onmouseout= saturdayTooltipOff;
}
function addSundayToolTipListener(){
	document.getElementById("sunday_driver_ranking").onmouseover=sundayTooltipOn;
	document.getElementById("sunday_driver_ranking").onmouseout= sundayTooltipOff;
}

function mondayTooltipOn(evt){
	var mouse = mouseCoords(evt);
	document.getElementById("monday_tooltip").style.left = -50 + mouse.x + "px";
	document.getElementById("monday_tooltip").style.top = -280 + mouse.y + "px";
	document.getElementById("monday_tooltip").innerHTML = tooltips[this.id];//tooltips["carsoffroad"];
	document.getElementById("monday_tooltip").style.visibility = "visible";
}
function mondayTooltipOff(){
	document.getElementById("monday_tooltip").style.visibility = "hidden";
}

function tuesdayTooltipOn(evt){
	var mouse = mouseCoords(evt);
	document.getElementById("tuesday_tooltip").style.left = -50 + mouse.x + "px";
	document.getElementById("tuesday_tooltip").style.top = -280 + mouse.y + "px";
	document.getElementById("tuesday_tooltip").innerHTML = tooltips[this.id];//tooltips["carsoffroad"];
	document.getElementById("tuesday_tooltip").style.visibility = "visible";
}
function tuesdayTooltipOff(){
	document.getElementById("tuesday_tooltip").style.visibility = "hidden";
}

function wednesdayTooltipOn(evt){
	var mouse = mouseCoords(evt);
	document.getElementById("wednesday_tooltip").style.left = -50 + mouse.x + "px";
	document.getElementById("wednesday_tooltip").style.top = -280 + mouse.y + "px";
	document.getElementById("wednesday_tooltip").innerHTML = tooltips[this.id];//tooltips["carsoffroad"];
	document.getElementById("wednesday_tooltip").style.visibility = "visible";
}
function wednesdayTooltipOff(){
	document.getElementById("wednesday_tooltip").style.visibility = "hidden";
}

function thursdayTooltipOn(evt){
	var mouse = mouseCoords(evt);
	document.getElementById("thursday_tooltip").style.left = -50 + mouse.x + "px";
	document.getElementById("thursday_tooltip").style.top = -280 + mouse.y + "px";
	document.getElementById("thursday_tooltip").innerHTML = tooltips[this.id];//tooltips["carsoffroad"];
	document.getElementById("thursday_tooltip").style.visibility = "visible";
}
function thursdayTooltipOff(){
	document.getElementById("thursday_tooltip").style.visibility = "hidden";
}

function fridayTooltipOn(evt){
	var mouse = mouseCoords(evt);
	document.getElementById("friday_tooltip").style.left = -50 + mouse.x + "px";
	document.getElementById("friday_tooltip").style.top = -280 + mouse.y + "px";
	document.getElementById("friday_tooltip").innerHTML = tooltips[this.id];//tooltips["carsoffroad"];
	document.getElementById("friday_tooltip").style.visibility = "visible";
}
function fridayTooltipOff(){
	document.getElementById("friday_tooltip").style.visibility = "hidden";
}

function saturdayTooltipOn(evt){
	var mouse = mouseCoords(evt);
	document.getElementById("saturday_tooltip").style.left = -50 + mouse.x + "px";
	document.getElementById("saturday_tooltip").style.top = -280 + mouse.y + "px";
	document.getElementById("saturday_tooltip").innerHTML = tooltips[this.id];//tooltips["carsoffroad"];
	document.getElementById("saturday_tooltip").style.visibility = "visible";
}
function saturdayTooltipOff(){
	document.getElementById("saturday_tooltip").style.visibility = "hidden";
}

function sundayTooltipOn(evt){
	var mouse = mouseCoords(evt);
	document.getElementById("sunday_tooltip").style.left = -50 + mouse.x + "px";
	document.getElementById("sunday_tooltip").style.top = -280 + mouse.y + "px";
	document.getElementById("sunday_tooltip").innerHTML = tooltips[this.id];//tooltips["carsoffroad"];
	document.getElementById("sunday_tooltip").style.visibility = "visible";
}
function sundayTooltipOff(){
	document.getElementById("sunday_tooltip").style.visibility = "hidden";
}

