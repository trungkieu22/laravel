@extends('layout')
@section('content_category')
<section id="form"><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form"><!--login form-->
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                    @if(session()->has('message'))
                    <div class="alert alert-success">
                        {!! session()->get('message') !!}
                    </div>
                @elseif(session()->has('error'))
                     <div class="alert alert-danger">
                        {!! session()->get('error') !!}
                    </div>
                @endif
                   
                    <h2>Đăng Nhập Ngay</h2>
                    <form action="{{URL::to('/login-customer')}}" method="post">
                        {{ csrf_field() }}
                        <div class="field input-field">
                        <input type="text"   name="email_account" placeholder="Tên Đăng Nhập" />
                        </div>
                        <div class="field input-field">
                        <input type="password" name="password_account"  class="password" placeholder="password" />
                        <i class='bx bx-hide eye-icon'></i>
                        </div>
                        <div class="quen">
                            
                            <span>
                        <a href="{{url('/quen-mat-khau')}}">Quên mật khẩu</a>
                              </span>
                           </div>
                     
                      
                        <button type="submit" class="btn btn-default">Đăng Nhập</button>
                        
                       
                           
                    </form>
                    <div class="line"></div>

                    <div class="media-options">
                        <a href="{{url('login-customer-facebook')}}" class="field facebook">
                            <i class='bx bxl-facebook facebook-icon'></i>
                            <span>Login with Facebook</span>
                        </a>
                    </div>
    
                    <div class="media-options">
                        <a href="{{url('login-customer-google')}}" class="field google">
                            <img style="margin:0px 5px;" width="24px" height="23px" src="{{asset('/g.png')}}"><span class="gg"> 
                                <span>Login with Google</span>
                            </a>
                     
                    </div>
                                        
                    </ul>
                </div><!--/login form-->
            </div>

            <div class="col-sm-1">
                <h2 class="or">Hoặc</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form"><!--sign up form-->
                    <h2>Đăng ký</h2>
                    <form action="{{URL::to('/add-customer')}}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="text" name="customer_name" placeholder="Họ Và Tên" required/>
                        <input type="file" name="customer_picture" placeholder="Họ Và Tên" required/>
                        <input  type="email"name="customer_email"  placeholder="Địa Chỉ email" required/>
                        <input type="password"  name="customer_password" placeholder="Mật Khẩu" required/>
                        <input type="text" name="customer_phone" placeholder="phone" required />
                        <button type="submit" name="signup" class="btn btn-default">Đăng Ký</button>
                    </form>
                </div><!--/sign up form-->
            </div>
        </div>
    </div>
</section><!--/form-->


 {{-- hien thi mat khau --}}
<script>
 const forms = document.querySelector(".forms"),
      pwShowHide = document.querySelectorAll(".eye-icon"),
      links = document.querySelectorAll(".link");

pwShowHide.forEach(eyeIcon => {
    eyeIcon.addEventListener("click", () => {
        let pwFields = eyeIcon.parentElement.parentElement.querySelectorAll(".password");
        
        pwFields.forEach(password => {
            if(password.type === "password"){
                password.type = "text";
                eyeIcon.classList.replace("bx-hide", "bx-show");
                return;
            }
            password.type = "password";
            eyeIcon.classList.replace("bx-show", "bx-hide");
        })
        
    })
})      

links.forEach(link => {
    link.addEventListener("click", e => {
       e.preventDefault(); //preventing form submit
       forms.classList.toggle("show-signup");
    })
})


</script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>

{{-- hiện thị dòng code chú ý   --}}
<script>
$.validate({
    modules : 'security',
    onModulesLoaded : function() {
        var optionalConfig = {
            fontSize: '12pt',
            padding: '4px',
            bad : 'Very bad',
            weak : 'Weak',
            good : 'Good',
            strong : 'Strong'
        };

        $('input[name="customer_password"]').displayPasswordStrength(optionalConfig);
    }
});
</script>

<link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

@endsection