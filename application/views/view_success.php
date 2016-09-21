<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Registration Complete!</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="<?=base_url()?>public/css/style.css">
	<script src="<?=base_url()?>public/scripts/jquery-3.1.0.min.js"></script>
	<script src="<?=base_url()?>public/scripts/script.js"></script>
</head>
<body>

	<script>
	// AJAX JSON REQUEST FOR TAGS ------------------------------------------------

		$.ajax({
		  type:'GET',
		  url: "http://www.timdemeyer.be/hifluence/Form/getjsondata",
		  contentType: "application/json",
		  dataType: "json",
		  success: function(result){

			var jsonstring = result[0]['Json'];
			var obj = jQuery.parseJSON( jsonstring );
			console.log(obj);

			var innerhtml = "";
			$.each(obj, function(key,value){
				//console.log(key + ": " + value);
				innerhtml += '<option value="'+ value +'">'+ value +'</option>';
			});
			// fill dropdown with json tags
			$("#select-tags").html(innerhtml);
		  }
		});		
	// --------------------------------------------------------------------------	
	</script>


	<div id="background">

		<section id="form">
			<header id="headerbar">
				<h2>Registration Complete</h2>
			</header>

			<div class="formBorder">
			
				<?php
					if (isset($message)) {
						echo '<div class="padder"><div class="successmessage"><p>'. $message .'</p></div></div>';
					}
				?>

				<div class="padder">

					<p>Select a tag to attach to your profile.</p>

					<?php echo form_open('Form/addTag'); ?>

						<select id="select-tags" name="selectedtag">
						<option>Loading tags...</option>	
						</select>

						<input type="hidden" name="hid_email" value="<?=$email;?>" >
						<input type="submit" class="btn float-l" >
					
					</form>

				</div>

			</div>

		</section>
	</div>





	</body>
	</html>