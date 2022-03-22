@extends('layout')
@section('content')

<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
				  <li class="active">Thanh toán giỏ hàng</li>
				</ol>
			</div><!--/breadcrums-->

		
			<div class="review-payment">
				<h2>Xem lại giỏ hàng</h2>
			</div>
            <div class="table-responsive cart_info">
				<?php
					$content = Cart::getcontent();
					// echo "<pre>";
					// print_r($content);
					// echo "</pre>";
				?>
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Hình ảnh</td>
							<td class="description">Mô tả</td>
							<td class="price">Giá</td>
							<td class="quantity">Số lượng</td>
							<td class="total">Tổng tiền</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						@foreach($content as $value)
						<tr>
							<td class="cart_product">
								<a href=""><img src="{{URL::to('public/uploads/product/'.$value->attributes->image)}}" style="width:100px" alt=""></a>
							</td>
							<td class="cart_description">
								<p>{{$value->name}}</p>
							</td>
							<td class="cart_price">
								<p>{{$value->price}}. đ</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<form action="{{URL::to('/update-cart-quantity')}}" method="post">
										{{ csrf_field() }}
										<input class="cart_quantity_input" type="number" name="cart_to_quantity" value="{{$value->quantity}}" min="1">
										<input class="form-control" type="hidden" name="product_id_to_cart" value="{{$value->id}}">
										<input class="btn btn-default btn-sm" type="submit" value="Cập nhật số lượng">
									</form>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">

									<?php
										$subtotal = $value->quantity*$value->price;
										echo $subtotal."đ";

									?>
								</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{URL::to('/delete-to-cart/'.$value->id)}}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
            <h4 style="margin:40px 0; font-size:20px;">Chọn hình thức thanh toán</h4>
            <form action="{{URL::to('/order')}}" method="post">
                {{ csrf_field() }}
			<div class="payment-options">
					<span>
						<label><input name="check_option" type="checkbox" value="bằng ATM"> Trả bằng thẻ ATM</label>
					</span>
					<span>
						<label><input name="check_option" type="checkbox" value="bằng tiền mặt"> Nhận tiền mặt</label>
					</span>
					<span>
						<label><input name="check_option" type="checkbox" value="bằng paypal"> Thanh toán Paypal</label>
					</span>
                    <input class="btn btn-primary btn-sm" name="order" type="submit" value="Đặt hàng">
			</div>
            </form>
		</div>
	</section> <!--/#cart_items-->



@endsection