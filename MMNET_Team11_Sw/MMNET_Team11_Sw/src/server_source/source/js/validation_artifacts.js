$().ready(function() {
	var _URL = window.URL || window.webkitURL;
	$("#file").change(function(e) {
		var file, img;
		if (( file = this.files[0])) {
			img = new Image();
			img.onload = function() {
				var w = this.width;
				var h = this.height;
				if (h < 1000 || w < 1000)
					var result = confirm("Are you sure you want to upload this image? We detect that it is a low quality image. Click OK to continue and Cancel to upload another image");
				if (!result) {
					var f = document.getElementById("file");
					f.value = "";
				}
			};
			img.onerror = function() {
				var f = document.getElementById("file");
				f.value = "";
				alert("not a valid file: " + file.type);
			};
			img.src = _URL.createObjectURL(file);

		}

	});
	$("form").validate({
		rules : {
			artifact_name : "required"
		},
		messages : {
			artifact_name : "The artifact name can't be empty! Please enter the name of the artifact"
		}
	});
	$("#file").validate();
}); 