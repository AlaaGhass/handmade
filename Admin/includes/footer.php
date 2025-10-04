		<div class="footer"></div>
		<script src="<?php echo $js ?>jquery-1.12.1.min.js"></script>
		<script src="<?php echo $js ?>jquery-ui.min.js"></script>
		<script src="<?php echo $js ?>bootstrap.min.js"></script>
		<script src="<?php echo $js ?>jquery.selectBoxIt.min.js"></script>
		<script src="<?php echo $js ?>front.js"></script>
	</body>
</html>
<script type="text/javascript">
		function showMessage(message) {
  if (!("Notification" in window)) {
    // Code to run if notifications are not
    // supported by the visitor's browser
  } else {
    if (Notification.permission === "granted") {
      var notification = new Notification(message);
    } else if (Notification.permission !== "denied") {
      Notification.requestPermission().then(function (permission) {
        if (permission === "granted") {
          var notification = new Notification(message);
        }
  });
    }
  }
}

showMessage("لديك رسائل جديدة");
</script>