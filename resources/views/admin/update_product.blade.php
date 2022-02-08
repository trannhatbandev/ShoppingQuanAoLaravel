@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật sản phẩm 
                        </header>
                        <?php
                                $message = Session::get('message');
                                if($message){
                                    echo '<span class="text-alert">'.$message.'</span>';
                                    Session::put('message', null);
                                }
                            ?>
                        <div class="panel-body">
                        @foreach($update_product as $key => $update_value)
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/updates-product/'.$update_value->product_id)}}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                                    <input type="text" name="product_name" class="form-control" id="exampleInputEmail1" value="{{$update_value->product_name}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                                    <textarea style="resize:none" rows="8"  name="product_desc" class="form-control" id="exampleInputPassword1" 
                                   >{{$update_value->product_desc}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                                    <textarea style="resize:none" rows="8"  name="product_content" class="form-control" id="exampleInputPassword1" 
                                   >{{$update_value->product_content}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá sản phẩm</label>
                                    <input type="text" name="product_price" class="form-control" id="exampleInputEmail1" 
                                    value="{{$update_value->product_price}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình sản phẩm</label>
                                    <input type="file" name="product_image" class="form-control" id="exampleInputEmail1" >
                                    <image src="{{URL::to('public/uploads/product/'.$update_value->product_image)}}" style="with: 100px; height: 100px;">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hiển thị</label>
                                        <select name="product_status" class="form-control input-sm m-bot15" >
                                            <option value="0">Ẩn</option>
                                            <option value="1">Hiển thị</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Danh mục sản phẩm</label>
                                        <select name="category_id" class="form-control input-sm m-bot15" >
                                            @foreach($cate_product as $key => $cate)
                                                @if($cate->category_id==$update_value->category_id)
                                                    <option selected value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                                @else
                                                    <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                                @endif
                                            @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Thương hiệu sản phẩm</label>
                                        <select name="brand_id" class="form-control input-sm m-bot15" >
                                            @foreach($brand_product as $key => $brand)
                                                @if($brand->brand_id==$update_value->brand_id)
                                                    <option selected value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                                @else
                                                    <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                                @endif
                                            @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Size</label>
                                        <select name="size_id" class="form-control input-sm m-bot15" >
                                            @foreach($size_product as $key => $size)
                                                @if($size->size_id==$update_value->size_id)
                                                    <option selected value="{{$size->size_id}}">{{$size->size_name}}</option>
                                                @else
                                                     <option value="{{$size->size_id}}">{{$size->size_name}}</option>
                                                @endif  
                                            @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Màu sắc</label>
                                        <select name="color_id" class="form-control input-sm m-bot15" >
                                            @foreach($color_product as $key => $color)
                                                @if($color->color_id==$update_value->color_id)
                                                    <option selected value="{{$color->color_id}}">{{$color->color_name}}</option>
                                                @else
                                                    <option value="{{$color->color_id}}">{{$color->color_name}}</option>
                                                @endif    
                                            @endforeach
                                    </select>
                                </div>
                                <button type="submit" name="update_product" class="btn btn-info">Cập nhật sản phẩm</button>
                            </form>
                            @endforeach
                            </div>

                        </div>
                    </section>
            
            </div>
@endsection