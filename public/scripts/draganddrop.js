/*
filedrag.js - HTML5 File Drag & Drop demonstration
Featured on SitePoint.com
Developed by Craig Buckler (@craigbuckler) of OptimalWorks.net
*/
(function() {

	// getElementById
	function $id(id) {
		return document.getElementById(id);
	}


	// output information
	function Output(msg) {
		var m = $id("uploadNameHolder");
		m.innerHTML = msg; // msg + m.innerHTML;
		// function FileSelectHandler is triggered twice
		// caused by filedrag onchange. Prevent this?
	}


	// file drag hover
	function FileDragHover(e) {
		e.stopPropagation();
		e.preventDefault();
		e.target.className = (e.type == "dragover" ? "hover" : "");
	}


	// file selection
	function FileSelectHandler(e) {
		// cancel event and hover styling
		FileDragHover(e);
		// fetch FileList object
		var files = e.target.files || e.dataTransfer.files;
		// process all File objects
		for (var i = 0, f; f = files[i]; i++) {
			ParseFile(f);
		}
	}

	// on drop files -> copy label image to real input type file button
	$($("#lbl-custom-upload")).on("dragover drop", function(e) {
	    e.preventDefault();  // allow dropping and don't navigate to file on drop
	}).on("drop", function(e) {
	    $("input[type='file']").prop("files", e.originalEvent.dataTransfer.files);  // put files into element
	});


	// output file information
	function ParseFile(file) {
		Output("<p>" + file.name + "<br>(" + file.type + ", " + file.size + "bytes)</p>");
	}


	// initialize
	function Init() {
		var fileselect = $id("reg-profileimage");
		var	filedrag = $id("lbl-custom-upload");
		// var submitbutton = $id("submitbutton"); 
		// file select

		fileselect.addEventListener("change", FileSelectHandler, false);
		// is XHR2 available?
		
		var xhr = new XMLHttpRequest();
		if (xhr.upload) {
			// file drop
			filedrag.addEventListener("dragover", FileDragHover, false);
			filedrag.addEventListener("dragleave", FileDragHover, false);
			filedrag.addEventListener("drop", FileSelectHandler, false);
			// filedrag.style.display = "block"; // show only if all dragAndDrop features are supported
			// remove submit button
			// submitbutton.style.display = "none";
		}
		
	}

	// call initialization file
	if (window.File && window.FileList && window.FileReader) {
		Init();
	}


})();