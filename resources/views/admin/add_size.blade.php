@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm size sản phẩm
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
                                <form role="form" action="{{URL::to('/save-size')}}" method="post">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên size</label>
                                    <input type="text" name="size_name" class="form-control" id="exampleInputEmail1" 
                                    placeholder="Tên size">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả size</label>
                                    <textarea style="resize:none" rows="8"  name="size_desc" class="form-control" id="exampleInputPassword1" 
                                    placeholder="Mô tả size"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hiển thị</label>
                                        <select name="size_status" class="form-control input-sm m-bot15" >
                                            <option value="0">Ẩn</option>
                                            <option value="1">Hiển thị</option>
                                    </select>
                                </div>
                                <button type="submit" name="add_size" class="btn btn-info">Thêm size sản phẩm</button>
                            </form>
                            </div>

                        </div>
                    </section>
            
            </div>
@endsection