
<!doctype html>
<html>
<head>
    <title>Weather Scraper</title>

    <meta charset="utf-8" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
     
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-theme.min.css" rel="stylesheet">
	 
    <script type = "text/javascript" src = "jquery_production.js">
	</script>
    <script type = "text/javascript" src = "js/bootstrap.min.js">
	</script> 
	
	<style type = "text/css">
	
	html, body {
		height: 100%;
	}
		
		.container {
			background-image: url("images/Weather.jpeg");
			background-size: cover;
			background-position:center;
			width: 100%;
			height: 100%;
		}
		
		h1 {
			text-align:center;
			margin-bottom: 20px;
		}
		
		form {
			text-align: center;
		}
		
		.btn-lg {
			font-size: 1.5em;
			width: 250px;
		}
		
		#cityInput {
			height: 3em;
			font-size: 1.1em;
		}
		
		.alert-danger {
			display: none;
		}
		
	</style>
        
</head>

<body>
	<div class = "container">
		<div class = "row">
			<div class = "col-md-6 col-md-offset-3">
				
				<h1>Weather Predictor</h1>
				<br /><br />
				<p class = "lead">Enter the city whose weather you would like to find out. I'll run along and search the interwebz for you.</p>
				<br />
				<form id = "submitWeatherForm" method = "post">
					<div class="form-group">
					    <input type="text" class="form-control" id="cityInput" name = "userEnteredCity" placeholder="Eg. London, Paris, San Fransico..." value = "<?php echo $userInput;?>"/>
					  </div>
					  <br />
					  <button type="submit" id = "findWeather" class="btn btn-primary btn-lg">Find My Weather</button>
				</form>
				<br />
			<div id = "displayWeather" class = "alert alert-danger">Success!</div>
			<div id = "invalidEntry" class = "alert alert-danger">Please enter a valid city!</div>
			</div>
		</div>
	</div>
	
	
	<script type = "text/javascript">
		
		if (typeof jQuery != "undefined") {
			console.log("jQuery is installed!");
		} else {
			alert("jQuery not running!");
		}
		
		//Set top margin for h1
		repositionH1();
		
		$(window).resize(function() {
			repositionH1();
		});
		
		
		function repositionH1() {
			console.log("Reposition h1 function called.");
			$("h1").css("margin-top", $(window).height()/6);
		}
		
		$("#submitWeatherForm").submit(function(event) {
			event.preventDefault();
			var userEnteredCity = $("#cityInput").val();
			console.log(userEnteredCity);
		
			if (userEnteredCity == "") {
				event.preventDefault();
				$("#invalidEntry").css("display", "block");
				$("#displayWeather").css("display", "none");
			} else {
				$.get("scraper.php?userEnteredCity="+userEnteredCity, function(data) {
					console.log(data);
					if (data.indexOf("Warning") >= 0){
						$("#invalidEntry").fadeIn();
					} else {
						$("#displayWeather").html(data).fadeIn();
					}
				})
			}			
		});
		
		$("#cityInput").change(function() {
			if ($(this).val() != ""){
				$(".alert-danger").fadeOut(250);
			}
		});
		
		
		
	</script>
	
</body>
</html>