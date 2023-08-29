<!DOCTYPE html>
<html>
<head>
    <title>Document Uploader</title>
    <!-- Link Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .centered-form {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Your App</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            
            <li class="nav-item">
                <form action="<?php echo e(route('logout')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-link nav-link">Logout</button>
                </form>
            </li>
        </ul>
    </div>
</nav>

<div class="container centered-form">
    <form action="<?php echo e(url('/upload')); ?>" method="POST" enctype="multipart/form-data" class="w-50">
        <?php echo csrf_field(); ?>
        <div class="form-group">
            <label for="file">Upload Document:</label>
            <input type="file" class="form-control-file" name="document" accept=".pdf,.doc,.docx">
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
</div>

<!-- Link Bootstrap JS (jQuery and Popper.js are required for Bootstrap) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\document_rewriter_project\document-re-writer\application\resources\views/upload/file-uploader-form.blade.php ENDPATH**/ ?>