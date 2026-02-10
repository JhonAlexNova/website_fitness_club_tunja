<style>
        /* Define una altura mínima para el editor */
        .ck-editor__editable[role="textbox"] {
            min-height: 200px; /* aproximadamente 10 filas de altura */
        }
    </style>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });
</script>