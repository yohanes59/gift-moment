function previewImage() {
	var preview = document.getElementById('image-preview');
	var file = document.querySelector('input[type=file]').files[0];
	var reader = new FileReader();

	reader.onloadend = function() {
		var tempImg = new Image();
		tempImg.src = reader.result;

		tempImg.onload = function() {
			var canvas = document.createElement('canvas');
			var ctx = canvas.getContext('2d');

			canvas.width = 160;
			canvas.height = 150;

			ctx.drawImage(tempImg, 0, 0, 160, 150);

			preview.src = canvas.toDataURL('image/jpeg', 1.0);
		}
	}

	if (file) {
		reader.readAsDataURL(file);
	}
}