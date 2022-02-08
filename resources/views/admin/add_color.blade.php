@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm màu sản phẩm
                        </header>
                        <?php
                                $message = Session::get('message');
                                if($message){
                                    echo '<span class="text-alert">'.$message.'</span>';
                                    Session::put('message', null);
                                }
                            ?>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/save-color')}}" method="post">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên màu sản phẩm</label>
                                    <input type="text" name="color_name" class="form-control" id="exampleInputEmail1" 
                                    placeholder="Tên màu sản phẩm">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả màu sản phẩm</label>
                                    <textarea style="resize:none" rows="8"  name="color_desc" class="form-control" id="exampleInputPassword1" 
                                    placeholder="Mô tả màu sản phẩm"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hiển thị</label>
                                        <select name="color_status" class="form-control input-sm m-bot15" >
                                            <option value="0">Ẩn</option>
                                            <option value="1">Hiển thị</option>
                                    </select>
                                </div>
                                <button type="submit" name="add_color" class="btn btn-info">Thêm màu sản phẩm</button>
                            </form>
                            </div>

                        </div>
                    </section>
            
            </div>
@endsection