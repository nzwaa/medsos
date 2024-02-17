<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Feed</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <h2>New Feed</h2>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-secondary" href="{{ route('feed.index') }}"> Kembali</a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> Input gagal.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="post" action="{{ route('feed.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="flex items-center justify-center h-48 mb-3">
                                        <video id="preview-video" class="object-cover object-center w-full" controls style="max-height: 450px;">
                                            <source src="" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    </div>
                                    <div class="mb-3">
                                        <strong>Video:</strong>
                                        <input type="file" class="form-control" id="video" name="video" accept="video/mp4" onchange="previewVideo(event)">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Caption:</strong>
                                        <textarea class="form-control" style="height:150px" name="caption"></textarea>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary btn-block" style="border-radius: 20px;">Create</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewVideo(event) {
            var video = document.getElementById('preview-video');
            var file = URL.createObjectURL(event.target.files[0]);
            video.src = file;
        }
    </script>
</body>
</html>