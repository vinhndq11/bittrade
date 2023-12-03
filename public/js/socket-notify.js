function showNotification(message) {
	if (document.visibilityState === "visible" || !message){
		return;
	}
	const notification = new Notification('Thông báo', {body: message, icon: window.icon});
	notification.onclick = () => {
		notification.close();
		window.parent.focus();
	}
}

function requestAndShowPermission(message) {
	Notification.requestPermission().then(function (permission) {
		if (permission === "granted") {
			showNotification(message);
		}
	});
}

function showMessageNotification(message) {
	if(typeof Notification === "undefined"){
		return null;
	}
	let permission = Notification.permission;
	if (permission === "granted") {
		showNotification(message);
	} else if (permission === "default") {
		requestAndShowPermission(message);
	}
}

jQuery(function () {
	const socket = io(window.socket_link1, {query: {session_id: window.session_id}});
	socket.on('we_message', ({type, message, count}) => {
		let player = document.getElementById('notification');
		player.play();
		$.notify(message, {allow_dismiss: true, type: 'success'});
		$(`.${type}_count`).text(count);
		window.tableMain && window.tableMain.draw();
		showMessageNotification(message);
	});
});
