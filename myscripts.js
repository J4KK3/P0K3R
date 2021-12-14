
document.addEventListener("DOMContentLoaded", function(event) { 
	
	window.addEventListener("keydown", hideCard, false);
	
	function hideCard(e){
		
		
		var elem = document.getElementById('p1');
		if (e.keyCode == 32){
			
			if(elem.style.display == "inline"){
				elem.style.display = "none";
			}
			else if(elem.style.display == "none"){
				elem.style.display = "inline";
			}
		}
	}
});
	
	





	
