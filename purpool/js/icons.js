var poolIcon, peopleIcon, workplaceIcon; // GIcon objects to use as custom GMarkers

poolIcon = new GIcon();	
poolIcon.image = 'images/marker-pool.png';
poolIcon.shadow = 'images/marker-shadow.png'; 
poolIcon.transparent = 'images/marker-transparent.png';
poolIcon.printImage = 'images/marker-pool-print.gif';
poolIcon.printShadow = 'images/marker-printShadow.gif'
poolIcon.iconSize = new GSize(16,18); 
poolIcon.shadowSize = new GSize(16,22);
poolIcon.iconAnchor = new GPoint(5,5); 
poolIcon.infoWindowAnchor = new GPoint(5,5);

peopleIcon = new GIcon();	
peopleIcon.image = 'images/marker-profile.png';
peopleIcon.shadow = 'images/marker-shadow.png'; 
peopleIcon.transparent = 'images/marker-transparent.png';
peopleIcon.printImage = 'images/marker-profile-print.gif';
peopleIcon.printShadow = 'images/marker-printShadow.gif'
peopleIcon.iconSize = new GSize(16,18); 
peopleIcon.shadowSize = new GSize(16,22);
peopleIcon.iconAnchor = new GPoint(5,5); 
peopleIcon.infoWindowAnchor = new GPoint(5,5);
	
workplaceIcon = new GIcon();	
workplaceIcon.image = 'images/star.png';
workplaceIcon.shadow = 'images/star-shadow.png';
workplaceIcon.transparent = 'images/marker-transparent.png';
workplaceIcon.printImage = 'images/marker-star-print.gif';
workplaceIcon.printShadow = 'images/marker-printShadow.gif';
workplaceIcon.iconSize = new GSize(31,25); 
workplaceIcon.shadowSize = new GSize(33,32);
workplaceIcon.iconAnchor = new GPoint(5,5); 
workplaceIcon.infoWindowAnchor = new GPoint(5,5);
