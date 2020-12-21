@extends('layouts.app')
@section('styles')
    <style>
        .d-block
        {
            height:500px;
        }
        .carousel-control-next {
            right: 0px;
        }
    </style>
    @endsection
@section('content')
     <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('products.index') }}">Product</a>
            </li>
            <li class="breadcrumb-item active">Detail</li>
     </ol>
     <div class="container-fluid">
          <div class="animated fadeIn">
                 {{--@include('coreui-templates::common.errors')--}}
                 <div class="row">
                     <div class="col-lg-12">
                         <div class="card">
                             <div class="card-header">
                                 <strong>Details</strong>
                                  <a href="{{ route('products.index') }}" class="btn btn-light">Back</a>
                             </div>
                             <div class="card-body">
                                 @include('products.show_fields')
                             </div>
                         </div>
                     </div>
                 </div>
          </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('.carousel').carousel()
    </script>
@endsection
