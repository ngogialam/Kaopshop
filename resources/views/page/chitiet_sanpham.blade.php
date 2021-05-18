@extends('master')
@section('content')

    <div class="inner-header">
        <div class="container">
            <div class="pull-left">
                <h6 class="inner-title">Sản Phẩm {{ $sanpham->name }}</h6>
            </div>
            <div class="pull-right">
                <div class="beta-breadcrumb font-large">
                    <a href="{{ route('trangchu') }}">Trang chủ</a> / <span>Thông Tin Chi Tiết Sản Phẩm</span>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="container">
        <div id="content">
            <div class="row">
                <div class="col-sm-9">

                    <div class="row">
                        <div class="col-sm-4">
                            <img src="source/image/product/{{ $sanpham->image }}" width="300px" height="200px" alt="">
                        </div>
                        <div class="col-sm-8">
                            <div class="single-item-body">
                                <p class="single-item-title" ><h3>{{ $sanpham->name }}</h3></p>
                                <p class="single-item-price">
                                    @if ($sanpham->promotion_price == 0)
                                        <span class="flash-sale">{{ number_format($sanpham->unit_price) }} đồng</span>
                                    @else
                                        <span class="flash-del">{{ number_format($sanpham->unit_price) }} đồng</span>
                                        <span class="flash-sale">{{ number_format($sanpham->promotion_price) }} đồng</span>
                                    @endif
                                </p>
                            </div>

                            <div class="clearfix"></div>
                            <div class="space20">&nbsp;</div>

                            <div class="single-item-desc">
								<p>{{$sanpham->description}}</p>
                            </div>
                            <div class="space20">&nbsp;</div>

                            <p>Options:</p>
                            <div class="single-item-options">
                                <select class="wc-select" name="size">
                                    <option>Size</option>
                                    <option value="XS">XS</option>
                                    <option value="S">S</option>
                                    <option value="M">M</option>
                                    <option value="L">L</option>
                                    <option value="XL">XL</option>
                                </select>
                                <select class="wc-select" name="color">
                                    <option>Color</option>
                                    <option value="Red">Red</option>
                                    <option value="Green">Green</option>
                                    <option value="Yellow">Yellow</option>
                                    <option value="Black">Black</option>
                                    <option value="White">White</option>
                                </select>
                                <select class="wc-select" name="color">
                                    <option> Số Lượng</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                                <a class="add-to-cart" href="{{route('themgiohang',$sanpham->id)}}"><i class="fa fa-shopping-cart"></i></a>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>

                    <div class="space40">&nbsp;</div>
                    <div class="woocommerce-tabs">
                        <ul class="tabs">
                            <li><a href="#tab-description">Mô tả</a></li>
                            <li><a href="#tab-reviews">Reviews (0)</a></li>
                        </ul>

                        <div class="panel" id="tab-description">
                            <p>{{$sanpham->description}}</p>
                            <p>Consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et
                                dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum
                                exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi
                                consequaturuis autem vel eum iure reprehenderit qui in ea voluptate velit es quam nihil
                                molestiae consequr, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur? </p>
                        </div>
                        <div class="panel" id="tab-reviews">
                            <p>No Reviews</p>
                        </div>
                    </div>
                    <div class="space50">&nbsp;</div>
                    <div class="beta-products-list">
                        <h4>Sản Phẩm Tương Tự</h4>

                        <div class="row">
                            @foreach ($sp_tuongtu as $sptt)                 
                            <div class="col-sm-4">
                                <div class="single-item">
                                    @if($sptt->promotion_price!=0)
                                        <div class="ribbon-wrapper">
                                            <div class="ribbon sale">Sale</div>
                                        </div>
                                        @endif
                                    <div class="single-item-header">
                                        <a href="{{route('chitietsanpham',$sptt->id)}}"><img src="source/image/product/{{$sptt->image}}" height="150px" alt=""></a>
                                    </div>
                                    <div class="single-item-body">
                                        <p class="single-item-title">{{$sptt->name}}</p>
                                        <p class="single-item-price" style="font-size: 18px">
                                            @if($sptt->promotion_price==0)
                                                    <span class="flash-del">{{ number_format($sptt->unit_price) }} đồng</span>
                                                    
                                                    @else
                                                    <span class="flash-del">{{ number_format($sptt->unit_price) }} đồng</span>
                                                    <span class="flash-sale">{{ number_format($sptt->promotion_price) }} đồng</span>
                                                    @endif
                                        </p>
                                    </div>
                                    <div class="single-item-caption">
                                        <a class="add-to-cart pull-left" href="{{route('themgiohang',$sptt->id)}}"><i
                                                class="fa fa-shopping-cart"></i></a>
                                        <a class="beta-btn primary" href="product.html">Details <i
                                                class="fa fa-chevron-right"></i></a>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="row" style="width: 100px">{{$sp_tuongtu->links()}}</div>
                    </div> <!-- .beta-products-list -->
                </div>
                <div class="col-sm-3 aside">
                    <div class="widget">
                        <h3 class="widget-title">Sản Phẩm khác</h3>
                        <div class="widget-body">
                            @foreach ($sp_tuongtu as $sptt)  
                            <div class="beta-sales beta-lists">
                                <div class="media beta-sales-item">
                                    <a class="pull-left" href="{{route('chitietsanpham',$sptt->id)}}"><img
                                            src="source/image/product/{{ $sptt->image }}" alt=""></a>
                                    <div class="media-body">
                                        {{ $sptt->name }} </br>
                                        <span class="beta-sales-price" style="font-size: 12px">{{ number_format($sptt->unit_price) }} đồng</span>
                                    </div>
                                </div>
                              
                            </div>
                            @endforeach
                        </div>
                    </div> <!-- best sellers widget -->
                    <div class="widget">
                        <h3 class="widget-title">New Products</h3>
                        <div class="widget-body">
                            <div class="beta-sales beta-lists">
                                @foreach ($sp_tuongtu as $sptt)  
                            <div class="beta-sales beta-lists">
                                <div class="media beta-sales-item">
                                    <a class="pull-left" href="{{route('chitietsanpham',$sptt->id)}}"><img
                                            src="source/image/product/{{ $sptt->image }}" alt=""></a>
                                    <div class="media-body">
                                        {{ $sptt->name }} </br>
                                        <span class="beta-sales-price" style="font-size: 12px">{{ number_format($sptt->unit_price) }} đồng</span>
                                    </div>
                                </div>
                              
                            </div>
                            @endforeach
                            </div>
                        </div>
                    </div> <!-- best sellers widget -->
                </div>
            </div>
        </div> <!-- #content -->
    </div> <!-- .container -->

@endsection
