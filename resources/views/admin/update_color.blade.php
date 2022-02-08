@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật màu sản phẩm 
                        </header>
                        <?php
                                $message = Session::get('message');
                                if($message){
                                    echo '<span class="text-alert">'.$message.'</span>';
                                    Session::put('message', null);
                                }
                            ?>
                        <div class="panel-body">
                            @foreach($update_color as $key => $color)
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/updates-color/'.$color->color_id)}}" method="post">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên màu</label>
                                    <input type="text" value="{{$color->color_name}}" name="color_name" class="form-control" id="exampleInputEmail1" 
                                    placeholder="Tên màu sản phẩm">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả màu sản phẩm</label>
                                    <textarea style="resize:none" rows="8"  name="color_desc" class="form-control" id="exampleInputPassword1" 
                                    placeholder="Mô tả danh mục">{{$color->color_desc}}</textarea>
                                </div>
                                <button type="submit" name="update_color" class="btn btn-info">Cập nhật màu sắc sản phẩm</button>
                            </form>
                            </div>
                            @endforeach
                        </div>
                    </section>
            
            </div>
@endsection