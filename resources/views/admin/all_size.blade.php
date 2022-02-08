@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
        Liệt kê size sản phẩm
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
        <select class="input-sm form-control w-sm inline v-middle">
          <option value="0">Bulk action</option>
          <option value="1">Delete selected</option>
          <option value="2">Bulk edit</option>
          <option value="3">Export</option>
        </select>
        <button class="btn btn-sm btn-default">Apply</button>             
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <div class="input-group">
          <input type="text" class="input-sm form-control" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="button">Go!</button>
          </span>
        </div>
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <?php
              $message = Session::get('message');
              if($message){
                echo '<span class="text-alert">'.$message.'</span>';
                Session::put('message', null);
              }
            ?>   
            <th>Tên size</th>
            <th>Hiển thị</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_size as $key => $size)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{$size->size_name}}</td>
            <td>
                <span class="text-ellipsis">
                    <?php
                        if($size->size_status==1){
                          ?>
                            <a href="{{URL::to('/unactive-size/'.$size->size_id)}}"><span class="fa-thumb-styling fa fa-thumbs-up"></span></a>
                           <?php
                        }else{
                          ?>
                            <a href="{{URL::to('/active-size/'.$size->size_id)}}" ><span class="fa-thumb-styling fa fa-thumbs-down"></span></a>
                          <?php
                        }
                    ?>
                 </span>
            </td>
            <td>
              <a href="{{URL::to('/update-size/'.$size->size_id)}}" class="active styling-update" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-active"></i></a>
              <a onclick="return confirm('Bạn có muốn xóa size sản phẩm này?')" href="{{URL::to('/delete-size/'.$size->size_id)}}" class="active styling-delete" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i>
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
@endsection