<div class="row">
    @foreach($products as $product)
        <div class="col-md-4">
            <div class="card mb-3">
                <img class="card-img-top" data-src="{{url('storage/'.$product->featured_image)}}" alt="100%x180"
                     src="{{url('storage/'.$product->featured_image)}}"
                     data-holder-rendered="true" style="height: 280px; width: 100%; display: block;">
                <div class="card-body">
                    <div class="title" style="display: flex;justify-content: space-between">
                        <h4 class="card-title">{{$product->title}}</h4>
                        <h5>Rs.{{$product->price}}</h5>
                    </div>
                    <p>{{\Illuminate\Support\Str::limit($product->description,100)}}</p>
                    <a  class="float-right" href="{{ route('products.show', [$product->id]) }}"> <span  class="btn btn-success"> View </span> </a>
            {{--{!! Form::open(['route' => ['products.destroy', $product->id], 'method' => 'delete']) !!}--}}
                        {{--<a href="{{ route('products.show', [$product->id]) }}" class='btn btn-ghost-success'><i--}}
                                {{--class="fa fa-eye"></i></a>--}}
                        {{--{!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}--}}
                        {!! Form::close() !!}

                </div>
            </div>
        </div>
    @endforeach

    {{$products->links()}}
</div>
