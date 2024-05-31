ClassicEditor
	.create( document.querySelector('#editor_ckeditor'), {
		toolbar : {
			items : [
				'selectAll', 'findAndReplace', 
				'|',
				'undo', 'redo',
				'|',
				'heading',
				'|',
				'fontFamily', 'fontColor','fontBackgroundColor','fontSize','highlight','bold', 'italic', 'strikethrough', 'subscript', 'superscript',
				'|',
				'removeFormat',
				'|',
				'alignment','bulletedList','numberedList',
				'|',
				'link', 'specialCharacters',
				'|',
				'codeBlock','htmlEmbed',
				'|',
				'outdent','indent',
				'|',
				'insertTable','mediaEmbed',
				'|',
				'sourceEditing',
			],
			shouldNotGroupWhenFull: true
		},
	} )
	.then( editor => {
		window.editor = editor;
	} )
	.catch( handleSampleError );

function handleSampleError( error ) {
	const issueUrl = 'https://github.com/ckeditor/ckeditor5/issues';

	const message = [
		'Oops, something went wrong!',
		`Please, report the following error on ${ issueUrl } with the build id "j8d2q534ha8h-tn6ucpj2aurn" and the error stack trace:`
	].join( '\n' );

	console.error( message );
	console.error( error );
}
