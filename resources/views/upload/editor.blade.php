<!DOCTYPE html>
<html>
<head>
    <title>CKEditor with DOC Content</title>
    <script src="https://cdn.ckeditor.com/ckeditor5/43.0.2/classic/ckeditor.js"></script>
</head>
<body>
    <h1>CKEditor with DOC Content</h1>
    <form action="{{ route('upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="document">
        <button type="submit">Upload and Edit</button>
    </form>

    <div id="editor">
        {!! $htmlContent !!}
    </div>

    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>
</body>
</html>
