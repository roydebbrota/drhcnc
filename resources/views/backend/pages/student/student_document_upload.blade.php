@extends('backend.layouts.app')
@section('backend_content')
    <div
        class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 mt-5 pb-2 mb-3 border-bottom  bg-warning">
        <h1 class="h2 text-center">Student Document Upload</h1>
    </div>

    <canvas class="my-4 w-100" id="myChart" width="900" height="10"></canvas>
    <h4 class="text-center">User Details</h4>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">User ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Applied For</th>
                    <th scope="col">Email</th>
                    <th scope="col">Division</th>
                    <th scope="col">DIstrict</th>
                    <th scope="col">Village</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="padding: 20px 2px;">{{ 'STD' . $student->session . $student->id }}</td>
                    <td style="padding: 20px 2px;">{{ $student->name }}</td>
                    <td style="padding: 20px 2px;">
                        {{ $student->course_name . '(session ' . $student->session . '-' . (int) $student->session + 1 . ')' }}
                    </td>
                    <td style="padding: 20px 2px;">{{ $student->email }}</td>
                    <td style="padding: 20px 2px;">{{ $student->division_name }}</td>
                    <td style="padding: 20px 2px;">{{ $student->district_name }}</td>
                    <td style="padding: 20px 2px;">{{ $student->village }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <h4 class="text-center px-2 py-3 alert-success">Upload/Change Image</h4>
    <form class="form-horizontal image-form" method="post" action="{{ route('upload.student.image') }}"
        enctype="multipart/form-data">
        @csrf
        <input type="hidden" id="student_id" name="student_id" value="{{ $student->id }}" />
        <div class="card-body border">
            <div class="row">
                <div class="form-group">
                    <div class="row mx-lg-4">
                        <div class="col-md-4 mb-3">
                            <label for="image" class="col-form-label text-md-end">{{ __('Photo (300x300)') }}</label>
                            <input type="file" class="@error('image') is-invalid @enderror image" id="image"
                                name="image" value="{{ old('image') }}" />
                            <div id="image-error" class="alert alert-danger" style="display: none;"></div>
                            @error('image')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <small class="w-100 text-danger">Photo must be 300 x 300 pixel (width x height)[.jpg format] and
                                file size not more than 100 KB(min.4KB)</small>
                            @if ($student->image)
                                Image
                                <img src="{{ asset($student->image) }}" class="mt-4"
                                    style="width:100px; height:auto"alt="d-flex">
                                <a href="{{ asset($student->image) }}" download>
                                    Download
                                </a>
                            @endif
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="signature" class="col-form-label">{{ __('Signature (300x80)') }}</label>
                            <input type="file" class="@error('image') is-invalid @enderror signature" id="signature"
                                name="signature" value="{{ old('signature') }}" />
                            <div id="signature-error" class="alert alert-danger" style="display: none;"></div>
                            @error('signature')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <small class="w-100 text-danger">Signature must be 300 x 80 pixel (width x height)[.jpg format]
                                and file size not more than 60 KB(min.4KB)</small>
                            @if ($student->signature)
                                Signature
                                <img src="{{ asset($student->signature) }}" class="mt-4"
                                    style="width:100px; height:auto"alt="d-flex">
                                <a href="{{ asset($student->signature) }}" download>
                                    Download
                                </a>
                            @endif
                        </div>
                        <div class="col-md-3 mb-3">
                            <button type="submit" class="btn btn-primary ">Upload</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    {{-- <canvas class="my-4 w-100" id="myChart" width="900" height="10"></canvas> --}}
    <h4 class="text-center px-2 py-3 alert-success">Upload Document</h4>
    <form class="form-horizontal" method="post" action="{{ route('upload.document') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" id="student_id" name="student_id" value="{{ $student->id }}" />
        <div class="card-body border">
            <div class="row">
                <div class="form-group">
                    <div class="row mx-lg-4">
                        <div class="col-md-4 mb-3">
                            <select class="form-select" name="name" id="name" required>
                                <option selected disabled>Select Name</option>
                                @forelse ($documentNames as $documentName)
                                    <option value="{{ $documentName->id }}">{{ $documentName->name }}</option>
                                @empty
                                @endforelse
                            </select>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                        <div class="col-md-4 mb-3">
                            <input type="file" class="@error('image') is-invalid @enderror" id="image" name="image"
                                value="{{ old('image') }}" />
                            @error('image')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-3">
                            <button type="submit" class="btn btn-primary ">Upload</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <canvas class="my-4 w-100" id="myChart" width="900" height="10"></canvas>
    <h6 class="text-center px-2 py-3 alert-success">
        {{ 'Uploaded Documents' }}
    </h6>
    @forelse ($documents as $document)
        <form class="form-horizontal" method="post" action="{{ route('update.document') }}"
            enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="document_id" name="document_id" value="{{ $document->id }}" />
            <div class="card-body border">
                <div class="row ">
                    <div class="col-md-4">
                        <p class="pt-2">
                            {{ 'Document Name: ' . $document->document_name }}
                        </p>

                    </div>
                    <div class="col-md-2 mt-2">

                        <img src="{{ asset($document->document) }}" class="mt-4"
                            style="width:150px; height:auto"alt="d-flex">
                        <a href="{{ asset($document->document) }}" download>
                            Download
                        </a>
                    </div>
                    <div class="col-md-2 mt-2">
                        <input type="file" class="@error('u_image') is-invalid @enderror" id="u_image"
                            name="u_image" value="{{ old('u_image') }}" required />
                        @error('u_image')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-2 mt-2">
                        <button type="submit" class="btn btn-primary btn-sm ">Change</button>
                    </div>

                    <div class="col-md-2 mt-2">
                        <p class="text-info fs-6">{{ 'Uploaded by: ' . $document->uploder }}</p>
                    </div>
                </div>

            </div>
        </form>
    @empty
    @endforelse
@endsection
@push('custom-scripts')
    <script>
        $(document).ready(function() {
            $('.image-form').on('submit', function(e) {
                e.preventDefault(); // Prevent the default form submission

                var valid = true;
                // Reset previous error messages
                $('#image-error').hide().text('');
                $('#signature-error').hide().text('');

                var image = $('#image')[0].files[0];
                var signature = $('#signature')[0].files[0];

                // Function to validate image dimensions, format, and file size
                function validateImage(file, expectedWidth, expectedHeight, maxSize, minSize,
                errorElement) {
                    return new Promise((resolve, reject) => {
                        if (file.type !== 'image/jpeg') {
                            $(errorElement).text('File must be in .jpg format').show();
                            valid = false;
                            return reject();
                        }

                        if (file.size > maxSize || file.size < minSize) {
                            $(errorElement).text(
                                `File size must be between ${minSize / 1024} KB and ${maxSize / 1024} KB`
                                ).show();
                            valid = false;
                            return reject();
                        }

                        var img = new Image();
                        img.src = URL.createObjectURL(file);
                        img.onload = function() {
                            if (img.width !== expectedWidth || img.height !== expectedHeight) {
                                $(errorElement).text(
                                    `Dimensions should be ${expectedWidth}x${expectedHeight}`
                                    ).show();
                                valid = false;
                                reject();
                            } else {
                                resolve();
                            }
                        };
                        img.onerror = function() {
                            $(errorElement).text('Error loading image').show();
                            valid = false;
                            reject();
                        };
                    });
                }

                // Validate image and signature dimensions, format, and file size
                var imageValidation = image ? validateImage(image, 300, 300, 100 * 1024, 4 * 1024,
                    '#image-error') : Promise.resolve();
                var signatureValidation = signature ? validateImage(signature, 300, 80, 60 * 1024, 4 * 1024,
                    '#signature-error') : Promise.resolve();

                // Check both validations
                Promise.all([imageValidation, signatureValidation])
                    .then(() => {
                        if (valid) {
                            $('.image-form').off('submit').submit(); // Re-submit the form if valid
                        }
                    })
                    .catch(() => {
                        // Prevent form submission if not valid
                        e.preventDefault();
                    });
            });


            if (window.File && window.FileList && window.FileReader) {
                $("#image").on("change", function(e) {
                    var files = e.target.files;
                    for (var i = 0; i < files.length; i++) {
                        var fileReader = new FileReader();
                        fileReader.onload = (function(e) {
                            var file = e.target;
                            $("<span class=\"pip\">" +
                                "<img class=\"imageThumb\" src=\"" + e.target.result +
                                "\" title=\"" + file.name + "\"/>" +
                                "<br/><span class=\"remove\">Remove image</span>" +
                                "</span>").insertAfter("#image");
                            $(".remove").click(function() {
                                $(this).parent(".pip").remove();
                            });
                        });
                        fileReader.readAsDataURL(files[i]);
                    }
                });

                $("#signature").on("change", function(e) {
                    var files = e.target.files;
                    for (var i = 0; i < files.length; i++) {
                        var fileReader = new FileReader();
                        fileReader.onload = (function(e) {
                            var file = e.target;
                            $("<span class=\"pip\">" +
                                "<img class=\"imageThumb\" src=\"" + e.target.result +
                                "\" title=\"" + file.name + "\"/>" +
                                "<br/><span class=\"remove\">Remove image</span>" +
                                "</span>").insertAfter("#signature");
                            $(".remove").click(function() {
                                $(this).parent(".pip").remove();
                            });
                        });
                        fileReader.readAsDataURL(files[i]);
                    }
                });
            } else {
                alert("Your browser doesn't support to File API");
            }
        });
    </script>
@endpush
@push('custom-css')
    <style>
        input[type="file"] {
            display: block;
        }

        .imageThumb {
            max-height: 75px;
            border: 2px solid;
            padding: 1px;
            cursor: pointer;
        }

        .pip {
            display: inline-block;
            margin: 10px 10px 0 0;
        }

        .remove {
            display: block;
            background: #444;
            border: 1px solid black;
            color: white;
            text-align: center;
            cursor: pointer;
        }

        .remove:hover {
            background: white;
            color: black;
        }
    </style>
@endpush
