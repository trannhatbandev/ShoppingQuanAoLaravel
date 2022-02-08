@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
       Liệt kê sản phẩm
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
            <th>Tên sản phẩm</th>
            <th>Mô tả sản phẩm</th>
            <th>Nội dung sản phẩm</th>
            <th>Giá sản phẩm</th>
            <th>Hình sản phẩm</th>
            <th>Trạng thái sản phẩm</th>
            <th>Danh mục</th>
            <th>Thương hiệu</th>
            <th>Size</th>
            <th>Màu</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_product as $key => $product)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{$product->product_name}}</td>
            <td>{{$product->product_desc}}</td>
            <td>{{$product->product_content}}</td>
            <td>{{$product->product_price}}</td>
            <td><image src="public/uploads/product/{{$product->product_image}}" style="with: 100px; height:100px;"></td>
            <td>
                <span class="text-ellipsis">
                    <?php
                        if($product->product_status==1){
                          ?>
                            <a href="{{URL::to('/unactive-product/'.$product->product_id)}}"><span class="fa-thumb-styling fa fa-thumbs-up"></span></a>
                           <?php
                        }else{
                          ?>
                            <a href="{{URL::to('/active-product/'.$product->product_id)}}" ><span class="fa-thumb-styling fa fa-thumbs-down"></span></a>
                          <?php
                        }
                    ?>
                 </span>
            </td>
            <td>{{$product->category_name}}</td>
            <td>{{$product->brand_name}}</td>
            <td>{{$product->size_name}}</td>
            <td>{{$product->color_name}}</td>
            <td>
              <a href="{{URL::to('/update-product/'.$product->product_id)}}" class="active styling-update" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-active"></i></a>
              <a onclick="return confirm('Bạn có muốn xóa sản phẩm này?')" href="{{URL::to('/delete-product/'.$product->product_id)}}" class="active styling-delete" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i>
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
@endsection