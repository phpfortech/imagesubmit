<!DOCTYPE html>
<html>
<head>
	<title>Coming Soon</title>
	<style>
		body {
			margin: 0;
			padding: 0;
			background-color: #fff;
			font-family: Arial, sans-serif;
		}
		.container {
			max-width: 800px;
			margin: 0 auto;
			padding: 100px 20px;
			text-align: center;
		}
		h1 {
			font-size: 50px;
			margin-bottom: 20px;
			color: #333;
		}
		p {
			font-size: 20px;
			line-height: 1.5;
			margin-bottom: 30px;
			color: #666;
		}
		.countdown {
			display: flex;
			justify-content: center;
			align-items: center;
			margin-bottom: 30px;
		}
		.countdown-item {
			display: flex;
			flex-direction: column;
			justify-content: center;
			align-items: center;
			background-color: #eee;
			width: 100px;
			height: 100px;
			margin: 0 10px;
			border-radius: 5px;
			box-shadow: 0px 0px 5px rgba(0,0,0,0.1);
		}
		.countdown-item span {
			font-size: 30px;
			font-weight: bold;
			color: #333;
		}
		.countdown-item label {
			font-size: 16px;
			color: #666;
		}
	</style>
</head>
<body>
	<div class="container">
		<h1>Coming Soon</h1>
		<p>Our website is under construction. We'll be back soon!</p>
		<div class="countdown">
			<div class="countdown-item">
				<span id="days">00</span>
				<label>Days</label>
			</div>
			<div class="countdown-item">
				<span id="hours">00</span>
				<label>Hours</label>
			</div>
			<div class="countdown-item">
				<span id="minutes">00</span>
				<label>Minutes</label>
			</div>
			<div class="countdown-item">
				<span id="seconds">00</span>
				<label>Seconds</label>
			</div>
		</div>
		<script>
			// Set the date we're counting down to
			var countDownDate = new Date("2023-06-01T00:00:00Z").getTime();

			// Update the count down every 1 second
			var x = setInterval(function() {

			  // Get today's date and time
			  var now = new Date().getTime();
			    
			  // Find the distance between now and the count down date
			  var distance = countDownDate - now;
			    
			  // Time calculations for days, hours, minutes and seconds
			  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
			  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
			  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
			  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
			  		  // Output the result in an element with id="demo"
		  document.getElementById("days").innerHTML = days;
		  document.getElementById("hours").innerHTML = hours;
		  document.getElementById("minutes").innerHTML = minutes;
		  document.getElementById("seconds").innerHTML = seconds;
		    
		  // If the count down is over, write some text 
		  if (distance < 0) {
		    clearInterval(x);
		    document.getElementById("demo").innerHTML = "EXPIRED";
		  }
		}, 1000);
	</script>
</div>
</body>
</html>
