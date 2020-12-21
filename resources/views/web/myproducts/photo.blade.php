@extends('web.layouts.app1')
@section('styles')
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
        .img-delete {
            display: block;
            background: #444;
            border: 1px solid black;
            color: white;
            text-align: center;
            cursor: pointer;
        }
        .img-delete:hover {
            background: white;
            color: black;
        }
    </style>
@endsection

@section('content')

    <!--================login_part Area =================-->
    <div class="col-lg-9 col-12 mb-30">
        <div class="myaccount-content">
            <div class="row">
                <div class="col-md-12 mb-50">
            <form method="post" action="{{route('web.photo.image')}}" enctype="multipart/form-data" class="dropzone" id="dropzone">
                @csrf
                <input type="hidden" name="product_id" value="{{$product->id}}">
            </form>
                </div></div>
            <?php $photos=\App\Models\Photo::where('product_id',$product->id)->get();?>

    <div class="row">
@if(isset($photos))
            @foreach($photos as $data)

                <div class=" col-md-3">
                    <img class="image" src="{{imageUrl('storage/products/'.$data->image,300,300,100)}}">
                    <a class="button" href="{{route('web.photo.destroy',['data'=>$data->image])}}">
                        <i class="fa fa-times-circle fa-2x"></i>
                    </a>
                </div>
            @endforeach
@endif
    </div>
        <div class="row">
            <div class="col-md-12 mt-50">
        <a href="{!! route('web.myproducts.request',['slug'=>$product->product_code]) !!}" class="btn btn-round btn-lg" type="submit">Next</a>
            </div>
        </div>
    </div>
        </div>


    <!--================login_part end =================-->


@endsection

@section('scripts')
    <script>
        Dropzone.prototype.defaultOptions.dictDefaultMessage = "Add at least 4 photos of your product.Click here to upload.";
        Dropzone.options.dropzone =
            {
                maxFilesize: 12,
                maxFiles: 6,
                renameFile: function (file) {
                    var dt = new Date();
                    var time = dt.getTime();
                    return time + file.name;
                },
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                addRemoveLinks: true,
                timeout: 5000,
                removedfile: function (file) {
                    var name = file.upload.filename;
                    console.log(file.upload.filename);
//                    var name = file.name;
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'POST',
                        url: '{{route('web.photo.delete')}}',
                        data: {filename: name},
                        success: function (data) {
                            console.log("File has been successfully removed!!");
                        },
                        error: function (e) {
                            console.log(e);
                        }
                    });
                    var fileRef;
                    return (fileRef = file.previewElement) != null ?
                        fileRef.parentNode.removeChild(file.previewElement) : void 0;
                },
                success: function (file, response) {
                },
                error: function (file, response) {
                    return false;
                }
            };
    </script>
@endsection
