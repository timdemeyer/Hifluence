
// -------------------------------------------------------------------------------------------

$(function(){



	// --------------------------------------------
/*
	checkDOMChange();

	function checkDOMChange()
	{
	    // check for any new element being inserted here,
	    // or a particular node being modified

		$("#fb-button").click(function(e){
			
			console.log("clicked");
			$(".fb_iframe_widget").trigger("click");

		});

	    // call the function again after 100 milliseconds
	    setTimeout( checkDOMChange, 250 );
	}
*/

	// CUSTOM FILE UPLOAD BUTTON - SHOW SELECTED FILENAME ------------------------------------

	// ".inputfile" => original file input button
	// "#filename-holder" => placeholder for file name 

	$(".inputfile").on( 'change', function( e )
	{
		//var $label = $("#filename-holder");
		var $label = $("#uploadNameHolder");
		var labelVal = $label.html();	
		var fileName = '';

		if( this.files && this.files.length > 1 )
			fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
		else if( e.target.value )
			fileName = e.target.value.split( '\\' ).pop();

		if( fileName )
			//$label.find( 'span' ).html( "Selected file:<br>" + fileName );
			$label.html( "Selected file:<br>" + fileName );
			// change bg image / color ?
		else
			$label.html( labelVal );
	});


	// CREATE RANDOM BACKGROUND BALLOONS -------------------------------------------------------

	var minSize=30;
	var maxSize=350;
	var numberOfBalloons=20;

	for(var i=0; i<numberOfBalloons; i++)
	{
		var size = Math.round(Math.random()*100+minSize); // diameter size in pixels
		var xPos = Math.floor(Math.random()*101); // xposition percentage (0-100%)
		var yPos = Math.floor(Math.random()*101); // yposiiton percentage (0-100%)

		var randomNumber = Math.round(Math.random()*5);
		var extraClassName = "";
		switch(randomNumber){
			case 0: extraClassName = "b-fb"; break;
			case 1: extraClassName = "b-hf"; break;
			case 2: extraClassName = "b-cat"; break;			
			case 3: extraClassName = "b-twitter"; break;
			case 4: extraClassName = "b-asterix"; break;
			case 5: extraClassName = "b-linkedin"; break;
		}

		// negatieve margin om te voorkomen dat balloons buiten schermgebied gaan (links en onder)
		// niet toepassen indien xpos = 0

		// create a new balloon with random position and random size
		$( '<div class="balloon '+ extraClassName +'" style="left:' + xPos + '%; top:' + yPos + '%; width:' + size + 'px; height:' + size + 'px; margin-left:-' + size + 'px; "></div>" ').appendTo("body"); 	
		
	}

	// Set div to parent height --------------------------------------------------------------

	$(".col-mid").height($(".col-2").height());

	// START WEBCAM WHEN BUTTON IS TRIGGERED -------------------------------------------------

	var webcamIsInitiated = false;

	$("#btn-webcam").click(function(event){
    	event.preventDefault();
		if(!webcamIsInitiated) 
		{
			startWebCam();
		}
		$("#webcam-container").show("slow");
	});

	$(".btnClose").click(function(){
		$("#webcam-container").hide("slow");
	});

	// WEBCAM ACCESS ------------------------------------------------------------------------

	function startWebCam()
	{
		webcamIsInitiated = true;
		// Start WebCam Video Stream
		var video = document.getElementById("videoElement");
		navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia || navigator.oGetUserMedia;

		if(navigator.getUserMedia){
			navigator.getUserMedia({video:true}, handleVideo, videoError);
		}

		function handleVideo(stream){
			video.src = window.URL.createObjectURL(stream);
		    video.play();
		}

		function videoError(e){
			// do something
		}		

		// take snapshot from videostream
		var canvas = document.getElementById('canvas');
		var context = canvas.getContext('2d');

		$("#btnSnapNew").click(function(){
			$("#hiddenButtons, #btnSnapPhoto").toggleClass("hidden");
			$("#canvas").css("z-index","4"); // lay canvas beneath video
		});

		$("#btnSnapPhoto").click(function(){
			context.drawImage(video, 0, 0, 480, 360);
			$("#canvas").css("z-index","6"); // lay canvas above video
			$("#hiddenButtons, #btnSnapPhoto").toggleClass("hidden");	
		});

		$("#btnKeepPhoto").click(function(){
			// convert canvas to image
			var image = new Image(); 
			image.src = canvas.toDataURL("image/png");
			
			// save image to harddrive
			var link = document.createElement("a");
		    link.setAttribute("href", image.src);
		    link.setAttribute("download", "SnapShot.png");
		    document.body.appendChild(link);
		    link.click();		
		    $("#webcam-container").hide("slow");
		});

	}


	// -----------------------------------------------------------------------------------------------





})


// --------------------------------------------------------------


