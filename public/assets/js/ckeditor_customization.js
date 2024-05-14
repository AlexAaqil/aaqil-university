ClassicEditor
    .create(document.querySelector('.textarea_editable'), {
        toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote'],
        language: 'en'
    })
    .catch(error => {
        console.error(error);
    });