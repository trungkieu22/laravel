@extends('layout')
@section('content_category')
<section id="form"><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-5 col-sm-offset-1">
                <div class="login-form"><!--login form-->
                    @if(session()->has('message'))
                    <div class="alert alert-success">
                        {!! session()->get('message') !!}
                    </div>
                @elseif(session()->has('error'))
                     <div class="alert alert-danger">
                        {!! session()->get('error') !!}
                    </div>
                @endif
                    <h2>Điền email để lấy lại mật khẩu</h2>
                    <form action="{{URL::to('/recover-pass')}}" method="post">
                        {{ csrf_field() }}
                        <div class="field input-field">
                        <input type="text" data-validation="email" data-validation-error-msg="làm ơn điền đúng email"  name="email_account" placeholder="Nhập email" />
                        </div>                    
                       
                       
                        <button type="submit" class="btn btn-default">Gửi</button>
                    </form>
                    
                                  
                    </ul>
                </div><!--/login form-->
            </div>
        </div>
    </div>
</section><!--/form-->
<style>


 


.col-sm-12.clearfix {
    padding-top: 32px;
    padding-left: 66px;
}
a.field.facebook {
    margin: -54px;
    font-size: 17px;
    color: blue;
    border: 1px solid;
    border-radius: 42px;




}
a.field.google {
    margin-left: 76px;
    font-size: 17px;
    border: 1px solid;
    border-radius: 52px;
    color: hotpink;
    
}

</style>
 {{-- hien thi mat khau --}}
<script>
     const forms = document.querySelector(".forms"),
      pwShowHide = document.querySelectorAll(".checkbox"),
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


@endsection