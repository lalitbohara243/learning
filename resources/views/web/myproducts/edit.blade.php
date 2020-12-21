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
            <?php  $conditions=['New(not used)','Used Few times','Excellent','Good','Not working'];
            $delivery_area=['within my area','within my city','anywhere in Nepal'];
            $subcategory=$myproduct->sub_category->first();
//            $subcategories=\App\Models\SubCategory::pluck('name','id')->toArray();

            ?>
            <div class="row">
                <h2 class="mb-50">Selected Category:&nbsp;{{$subcategory->name}}</h2>

                <div class="col-lg-8 col-md-8" style="margin-left: 120px;">
                    {!! Form::model($myproduct, ['route' => ['web.myproducts.update', $myproduct->product_code], 'method' => 'patch','files' => true]) !!}
                    {{--<div class="row">--}}
                        {{--<div class="col-md-2">--}}
                            {{--{!! Form::label('condition', 'Condition:') !!}--}}
                        {{--</div>--}}
                        {{--<div class="col-md-10 form-group p_star">--}}
                            {{--@if(isset($subcategory))--}}

                                {{--{!! Form::select('sub_category_id',$subcategories, $subcategory->id, ['class' => 'form-control']) !!}--}}


                            {{--@endif--}}

                        {{--</div>--}}
                    {{--</div>--}}
                    <div class="row">
                    <div class="col-md-2">
                        {!! Form::label('title', 'Title:') !!}
                    </div>
                    <div class="col-md-10 form-group">
                        {!! Form::text('title', null, ['class' => 'form-control','placeholder'=>'Title']) !!}
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-md-2">
                        {!! Form::label('description', 'Description:') !!}
                    </div>
                    <div class="col-md-10 form-group p_star">
                        {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-md-2">
                        {!! Form::label('featured_image', 'Featured Image:') !!}
                    </div>
                    <div class="col-md-10 form-group p_star">
                        {!! Form::file('featured_image') !!}
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-md-2">
                        {!! Form::label('price', 'Price:') !!}
                    </div>
                    <div class="col-md-10 form-group p_star">
                        {!! Form::text('price', null, ['class' => 'form-control','placeholder'=>'Price']) !!}
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-md-2">
                        {!! Form::label('condition', 'Condition:') !!}
                    </div>
                    <div class="col-md-10 form-group p_star">
                        {!! Form::select('condition', array_combine($conditions,$conditions), null, ['class' => 'form-control']) !!}
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-md-2">
                        {!! Form::label('used_for', 'Used For:') !!}
                    </div>
                    <div class="col-md-10 form-group p_star">
                        {!! Form::text('used_for', null, ['class' => 'form-control','placeholder'=>'Used For']) !!}
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-md-2">
                        {!! Form::label('expiry_time', 'Expiry Time:') !!}
                    </div>
                    <div class="col-md-10 form-group p_star">
                        {!! Form::text('expiry_time', null, ['class' => 'form-control','placeholder'=>'Expiry Time:']) !!}
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-md-2">
                        {!! Form::label('delivery', 'Delivery:') !!}
                    </div>
                    <div class="col-md-10 form-group">
                        <div class="col-md-5">
                            {!! Form::radio('delivery', "0", false,['id'=>'delivery_radio1','onclick' => 'showform(this)']) !!} Yes
                        </div>
                        <div class="col-md-5">
                            {!! Form::radio('delivery', "1", false,['id'=>'delivery_radio2','onclick' => 'showform(this)']) !!}No

                        </div>

                    </div>
                    </div>
                    <div class="row">

                    <div class="col-md-2 delivery">
                        {!! Form::label('delivery_area', 'Delivery Area:') !!}
                    </div>
                    <div class="col-md-10 form-group delivery">
                        {!! Form::select('delivery_area', array_combine($delivery_area,$delivery_area), null, ['class' => 'form-control']) !!}
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-md-2 delivery">
                        {!! Form::label('delivery_charge', 'Delivery Charge:') !!}
                    </div>
                    <div class="col-md-10 form-group delivery">
                        {!! Form::text('delivery_charge', null, ['class' => 'form-control']) !!}
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-md-2">
                        {!! Form::label('warranty_period', 'Warranty Period:') !!}
                    </div>
                    <div class="col-md-10 form-group p_star">
                        {!! Form::text('warranty_period', null, ['class' => 'form-control']) !!}
                    </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <table class="table bill_product table-fixed gridView">
                                        <thead>
                                        <tr style="text-align: center;">
                                            <th>Feature</th>
                                            <th>Value</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(isset($subcategory->attributes))
                                            @foreach($subcategory->attributes as $attribute)
                                                @foreach($myproduct->attribute as $att)
                                                    @if($attribute->feature==$att->feature)
                                                        <tr>


                                                            <td width="500px">
                                                                <div class="form-group has-error product ">
                                                                    <h4 style="text-align: center;background-color: white;height:38px;padding-top: 7px;">{{$attribute->feature}}</h4>
                                                                    {!! Form::hidden('attribute_id[]', $attribute->id,['class' => 'form-control']) !!}
                                                                </div>
                                                            </td>
                                                            @if(isset($att->pivot->value))
                                                                <td width="400px">
                                                                    <div class="form-group has-error product ">                                                      {!! Form::text('value[]', $att->pivot->value, ['class' => 'form-control']) !!}
                                                                    </div>
                                                                </td>
                                                            @else
                                                                <td width="400px">
                                                                    <div class="form-group has-error product ">                                                      {!! Form::text('value[]', null, ['class' => 'form-control']) !!}
                                                                    </div>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            @endforeach
<?php $patt_IDs =$myproduct->attribute->pluck('id')->toArray();
?>

                                        @foreach($subcategory->attributes as $attrib)

                                            @if(!in_array($attrib->id,$patt_IDs))
                                                <tr>


                                                    <td width="500px">
                                                        <div class="form-group has-error product ">
                                                            <h4 style="text-align: center;background-color: white;height:38px;padding-top: 7px;">{{$attrib->feature}}</h4>
                                                            {!! Form::hidden('attribute_id[]', $attrib->id,['class' => 'form-control']) !!}
                                                        </div>
                                                    </td>
                                                    <td width="400px">
                                                        <div class="form-group has-error product ">                                                      {!! Form::text('value[]', null, ['class' => 'form-control']) !!}
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-4 form-group">
                        <button  class="btn btn-round btn-lg" type="submit">Next</button>

                    </div>
                    <div class="col-md-6">
                    </div>
                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    </div>
    <!--================login_part end =================-->


@endsection
@section('scripts')
    <script>
        $('.delivery').hide();
    </script>
    <script>
        function showform(that) {
            if (that.value ==0) {
                $('.delivery').show();
            }
            else {
                $('.delivery').hide();
            }
        }
    </script>
@endsection
