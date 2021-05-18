@extends('master')
@section('content')
    <div class="inner-header">
        <div class="container">
            <div class="pull-left">
                <h6 class="inner-title">Đăng kí</h6>
            </div>
            <div class="pull-right">
                <div class="beta-breadcrumb">
                    <a href="index.html">Home</a> / <span>Đăng kí</span>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="container">
        <div id="content">

            <form action="{{ route('signin') }}" method="post" class="beta-form-checkout">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="row">
                    <div class="col-sm-3"></div>
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $err)
                                {{ $err }}
                            @endforeach
                        </div>
                    @endif
                    @if (Session::has('thanhcong'))
                        <div class="alert alert-success" style="font-weight:bold">{{ Session::get('thanhcong') }}</div>
                    @endif
                    <div class="col-sm-6">
                        <h4>Đăng kí</h4>
                        <div class="space20">&nbsp;</div>


                        <div class="form-block">
                            <label for="email">Email address*</label>
                            <input type="email" name="email" id="email" required>
                        </div>

                        <div class="form-block">
                            <label for="your_last_name">Fullname*</label>
                            <input type="text" id="full_name" name="full_name" required>
                        </div>

                        <div class="form-block">
                            <label for="adress">Address*</label>
                            <input type="text" id="address" name="address" placeholder="Street Address" required>
                        </div>


                        <div class="form-block">
                            <label for="phone">Phone*</label>
                            <input type="text" id="phone" name="phone" required>
                        </div>
                        <div class="form-block">
                            <label for="phone">Password*</label>
                            <input type="password" id="password" name="password" required>
                        </div>
                        <div class="form-block">
                            <label for="phone">Re password*</label>
                            <input type="password" id="re_password" name="re_password" required>
                        </div>
                        <div class="form-block">
                            <button type="submit" onclick="myFunction()" class="btn btn-primary">Register</button>
                        </div>
                    </div>
                    <div class="col-sm-3"></div>
                </div>
            </form>
            {{-- <script>
                function myFunction() {
                    alert("Bạn đã đăng ký thành công!");
                }

            </script> --}}
            <script type="text/javascript">
                function isEmail(inputEmail) {
                    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                    return regex.test(inputEmail);
                }

                function validatePassword(inputPassword) {
                    return inputPassword.length > 4;
                }

                $(document).ready(function() {
                    $('#email').change(function() {
                        var email = $(this).val().trim();
                        // alert(`email = ${JSON.stringify(email)}`)
                        if (!isEmail(email)) {
                            //Error ?
                            $(".emailError").html("Email khong dung");
                        } else {
                            $(".emailError").html("");
                        }
                    });
                    $('#password').change(function() {
                        var password = $(this).val();
                        if (!validatePassword(password)) {
                            $(".passwordError").html("Password hon 5 ki tu");
                        } else {
                            $(".passwordError").html("");
                        }
                    });
                });

            </script>
        </div> <!-- #content -->
    </div> <!-- .container -->
@endsection
