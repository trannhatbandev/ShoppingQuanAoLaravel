@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật size sản phẩm 
                        </header>
                        <?php
                                $message = Session::get('message');
                                if($message){
                                    echo '<span class="text-alert">'.$message.'</span>';
                                    Session::put('message', null);
                                }
                            ?>
                        <div class="panel-body">
                            @foreach($update_size as $key => $update_value)
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/updates-size/'.$update_value->size_id)}}" method="post">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên size</label>
                                    <input type="text" value="{{$update_value->size_name}}" name="size_name" class="form-control" id="exampleInputEmail1" 
                                    placeholder="Tên size">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả size</label>
                                    <textarea style="resize:none" rows="8"  name="size_desc" class="form-control" id="exampleInputPassword1" 
                                    placeholder="Mô tả size">{{$update_value->size_desc}}</textarea>
                                </div>
                                <button type="submit" name="update_size" class="btn btn-info">Cập nhật size</button>
                            </form>
                            </div>
                            @endforeach
                        </div>
                    </section>
            
            </div>
@endsection