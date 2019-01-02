 CKEDITOR.editorConfig = function( config ) {
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	// config.removeButtons = 'Underline,JustifyCenter';
	config.filebrowserBrowseUrl      = '/abc';
	config.filebrowserImageBrowseUrl = '/abc?Type=Images';
	config.filebrowserFlileBrowseUrl = '/abc?Type=Files';
	config.filebrowserUploadUrl      = '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
	config.filebrowserImageUploadUrl = '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
	config.filebrowserFlashUploadUrl = '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';

};
