@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm Mã Giảm Giá
                </header>
                <div class="panel-body">
                    <?php
                    $message = session()->get('message');
                    if($message){
                        echo '<span class="chau">' .$message. '</span>';
                        session()->put('message',null);
                    }
                    ?>
                    <div class="position-center">
                        <form role="form" action="{{URL::to('insert-coupon-code')}}" method="POST" >
                                @csrf
                            <div class="form-group">
                            <label for="exampleInputEmail1">Tên Mã Giảm Giá</label>
                            <input type="text" data-validation="length" data-validation-length="min5" data-validation-error-msg="làm ơn điền ít nhất 5 ký tự" name="coupon_name" class="form-control" id="exampleInputEmail1" >
                        </div>
                            <div class="form-group">
                            <label for="exampleInputEmail1" >Ngày Bắt đầu</label>
                            <input autocomplete="off" type="text" data-validation-error-msg="làm ơn điền ngày bắt đầu cho đúng" name="coupon_date_start" data-validation="date" data-validation-format="dd/mm/yyyy" id="start_coupon" class="form-control" >
                        </div>
                            <div class="form-group">
                            <label for="exampleInputEmail1">ngày kết thúc</label>
                            <input autocomplete="off" type="text" data-validation-error-msg="làm ơn điền ngày kết thúc cho đúng" data-validation="date" data-validation-format="dd/mm/yyyy" name="coupon_date_end" id="end_coupon" class="form-control" >
                        </div>
                            <div class="form-group">
                            <label for="exampleInputEmail1"> Mã Giảm Giá</label>
                            <input type="text" data-validation="length" data-validation-length="min5" data-validation-error-msg="làm ơn điền ít nhất 5 ký tự" name="coupon_code" class="form-control" id="exampleInputEmail1" >
                        </div>
                            <div class="form-group">
                            <label for="exampleInputEmail1">Số lượng Mã</label>
                            <input type="text" data-validation="number" data-validation-error-msg="làm ơn điền bằng số" name="coupon_time" class="form-control" id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                            <label  for="exampleInputPassword1">Tính Năng Mã</label>
                            <select name="coupon_condition" class="form-control input-sm m-bot15">
                                <option value="0"> --Chọn-- </option>
                                <option value="1">giảm theo phần %</option>
                                <option value="2">giảm theo tiền</option>
                            </select>                        </div>
                        <div class="form-group">
                            <label  for="exampleInputPassword1">Nhập % hoặc số tiền giảm</label>
                            <input type="text" name="coupon_number"  data-validation-error-msg="làm ơn điền bằng số" data-validation="number" class="form-control" id="exampleInputEmail1">
                        </div>
                
                    
                        <button type="submit" name="add_coupon" class="btn btn-info">Thêm mã</button>
                    </form>
                    </div>

                </div>
            </section>

    </div>
    <style>
        	span.chau {
    color: blueviolet;
    font-size: 17px;
    width: 100%;
    text-align: center;
}
    </style>
    @endsection