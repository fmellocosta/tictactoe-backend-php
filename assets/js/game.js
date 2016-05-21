$(document).ready(function(){
	
	$(":button").click(function(){
		event.preventDefault();
		doAction();
	});
	
	function doAction() {
		
		register();
		
		if (checkListenerStatus === "IDLE") {
			startListener();
		} else {
			stopListener();
		}
			
	}
	
	function register() {
		//call API
	}
	
	function checkListenerStatus() {
		//return the current listener status
	}
	
	function startListener() {
		//start listener that monitor other player move
		changeEndMessage("Waiting the other player move...");
	}
	
	function stopListener() {
		//stop the listener that monitor other player move
		changeEndMessage("");
	}	
	
	function changeMessage(message) {
		$(".end > h3").html(message);
	}
	
});