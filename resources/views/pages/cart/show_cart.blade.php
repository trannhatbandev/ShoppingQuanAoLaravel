@extends('layout')
@section('content')

<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
				  <li class="active">Giỏ hàng của bạn</li>
				</ol>
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
		</div>
	</section> <!--/#cart_items-->
	<section id="do_action">
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							
							<li>Tổng <span>{{Cart::getSubTotal()}}</span></li>
							<?php
							$cartConditions = Cart::getConditions();
							?>
							@foreach($cartConditions as $condition)
							<li>Thuế 
								<span>
									{{$condition->getValue()}}
								</span>
							</li>
							<li>Phí vận chuyển <span>Free</span></li>
							<li>Thành tiền 
								<span>
									<?php
										$value = $condition->getValue();
										$tax = explode('%',$value);
										$total = Cart::getTotal()+($tax[0]*100);
										echo $total;
									?>	
								</span>
							</li>
							@endforeach
						</ul>
					
							<!-- <a class="btn btn-default update" href="">Cập nhật</a> -->
							<?php
									$customer_id = Session::get('customer_id');
									if($customer_id!=null){

									
								?>
									<a class="btn btn-default check_out" href="{{URL::to('/checkout')}}">Thanh toán</a>
								<?php
									}else{
									?>
									<a class="btn btn-default check_out" href="{{URL::to('/login-checkout')}}">Thanh toán</a>
								<?php
									}
								?>
						
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->
@endsection