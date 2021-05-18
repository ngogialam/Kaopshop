@extends('master')
@section('content')
    <!DOCTYPE html>
    <html>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <body>
        <div style="background: #f9f9f9; padding: 15px; width: 600px; margin: 0 auto;">
            <hr style="margin-bottom: 50px">
            <div class="a" style="magin-top:50px; margin-bottom: 50px">
                <h3>Thông báo bạn đã đặt hàng thành công !!!! </h3>
                <p> <b>Cảm ơn bạn đã tin tưởng cửa hàng  !!! </b></p>
                
                <button style="witdh:150px; hight: 50px"><h6><a href="{{route('trangchu')}}" style="font-weight:bold">Quay lại trang mua hàng !</a></h6></button>
                <p> :<br></p>
                
                </br>
            </div>
            <hr>
        </div>
    </body>

    </html>

@endsection
