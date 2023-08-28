<!DOCTYPE html>
<html>
<head>
    <title>Document Rewriter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    .ck-editor__editable_inline {
        min-height: 300px;
    }
    </style>
</head>
<body>
    <h1>CKEditor with DOC Content</h1>
    <form action="{{url('/user/edited-content')}}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary mb-3">Save</button>
        <textarea name="editor" id="editor">{!!$htmlContent!!}</textarea>
    </form>

    <script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
        .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
</script>
</body>
</html>
