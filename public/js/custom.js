// My Functions //

function del_cart_product(id) {
    if (confirm('محصول پاک شود؟')) {
        $.get('http://localhost:8000/delCartProduct/' + id, function (data) {
            if (data == 'ok') {
                alert('محصول از سبد پاک شد');
                location.reload();
            }
        });
    }
}

function clearCoupon() {
    if (confirm('کد تخفیف پاک شود؟')) {
        $.ajax({
            url: '/clearCoupon',
            type: 'POST',
            data: {'_token': $('meta[name="csrf-token"]').attr('content') },
            dataType: 'JSON',
            success: function (data) {
                if (data == 1){
                    alert('کد تخفیف پاک شد!');
                    $('td#discount').text('0%');
                    $('small.warn').css('display', 'none');
                    $('a.del_coupon').css('display', 'none');
                    $('input#input-coupon').val('');
                    $('input#input-coupon').removeAttr('disabled');
                    $('#button-coupon').attr('disabled', true);
                }else {
                    alert('خطا در انجام عملیات');
                }
                refreshCart();
            }, error:function (err) {
                console.log(err);
            }
        });
    }
}

function refreshCart() {
    $('.loading').css('display', 'block');
    $.ajax({
        url: '/refreshCart',
        type: 'POST',
        data: {'_token': $('meta[name="csrf-token"]').attr('content') },
        dataType: 'JSON',
        success: function (data) {
            $('td#sum_price').text(data['sumprice']+' تومان');
            $('td#total_price').text(data['total']+' تومان');
            $('.loading').css('display', 'none');
        }, error:function (err) {
            console.log(err);
        }
    });
}

function add_to_compare(id) {
    $.ajax({
        url: '/compare',
        type: 'POST',
        data: { 'productId': id ,'_token': $('meta[name="csrf-token"]').attr('content') },
        dataType: 'JSON',
        success: function (data) {
            console.log(data);
            if (data == 20){
                alert('حداکثر آیتم مجاز در لیست 3 مورد است!');
            }else if(data==10){
                alert('محصول قبلا به لیست مقایسه اضافه شده بود!');
            }else {
                alert('محصول به لیست مقایسه اضافه شد');
                $('span#compareCount').text(data);
            }
        }, error:function (err) {
            console.log(err);
        }
    });

}

function select_state(id) {
    $.ajax({
        url: '/selectCity',
        type: 'POST',
        data: { 'id': id ,'_token': $('meta[name="csrf-token"]').attr('content') },
        dataType: 'JSON',
        success: function (data) {
            var options = [];
            options.push("<option value='0' disabled> ---  لطفا شهر انتخاب کنيد --- </option>")
            for (var i = 0; i < data.length; i++) {
                options.push('<option value="',
                    data[i]['id'], '">',
                    data[i]['city'], '</option>');
            }
            $("#city_list").html(options.join(''));
        }, error:function (err) {
            console.log(err);
        }
    });
}

function remove_profile_pic(id){
    if(confirm("تصویر پاک شود؟")){
        $.ajax({
            url: '/admin/remove_profile_pic',
            type: 'POST',
            data: { 'id': id ,'_token': $('meta[name="csrf-token"]').attr('content') },
            dataType: 'JSON',
            success: function (data) {
                console.log('data= '+data);
                if (data == 1){
                    alert('تصویر پاک شد.');
                    location.reload();
                } else {
                    alert('خطا');
                }
            }, error:function (err) {
                console.log(err);
            }
        });
    }

}

function delete_wishproduct(id) {
    if (confirm('محصول پاک شود؟')) {
        $.ajax({
            url: '/clearWishProduct',
            type: 'POST',
            data: { 'product_id': id , '_token': $('meta[name="csrf-token"]').attr('content') },
            dataType: 'JSON',
            success: function (data) {
                console.log(data);
                if(data == 1){
                    alert('حذف موفق');
                    location.reload();
                }else{
                    alert('خطا در پاک کردن');
                }
            }, error:function (err) {
                console.log(err);
            }
        });
    }

}


/* Video Uploader */
function uploadToServer(){
    var file = document.getElementById('video').files[0];
    var formData = new FormData();
    var httpReq = new XMLHttpRequest();
    var metas = document.getElementsByTagName('meta');

    formData.append('video', file);
    httpReq.upload.addEventListener('progress', progressFunc);
    httpReq.addEventListener('load', loadFunc);
    httpReq.addEventListener('error', errorFunc);
    httpReq.addEventListener('abort', abortFunc);
    httpReq.open('post', 'http://localhost:8000/admin/videos/upload');

    for (i=0; i<metas.length; i++) {
        if (metas[i].getAttribute("name") == "csrf-token") {
            httpReq.setRequestHeader("X-CSRF-Token", metas[i].getAttribute("content"));
        }
    }
    httpReq.send(formData);
}
function progressFunc(event){
    var loaded = (event.loaded)/100;
    var total = (event.total)/100;
    document.getElementById('loaded').innerHTML = "uploaded " + loaded + "Kilobytes of "+
    total;
    var percent = (event.loaded / event.total) *100;
    var p = Math.round(percent);
    document.getElementById('prog').style.width = p + '%';
    document.getElementById('percent').innerHTML = p + "% آپلود شده" ;
    if(p == 100){
        setTimeout(function () {
            alert('Done');
            document.getElementById('prog').style.width = 0 + '%';
            document.getElementById('video').value = '';
        },2000)
    }
}
function loadFunc(event){
    document.getElementById('result').innerHTML = event.target.responseText;
}
function errorFunc(){
    document.getElementById('result').innerHTML = "خطا در آپلود";
}
function abortFunc(){
    document.getElementById('result').innerHTML = "آپلود لغو شد!";
}
function Cancel(){
    location.reload();
}
/* Video Uploader */


// My Functions //
$(document).ready(function () {
    // $.ajaxSetup({
    //     headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     }
    // });
    //



    $('#rand_pass').click(function () {
        var str = [];
        var str1 = 'abcdefghijklmmnopqrstuwxyz';
        var str2 = '1234567890';
        var str3 = '!@#$%^&*';
        var ss1 = shuffle(str1);
        ss1 = ss1.substr(0,4)
        var ss2 = shuffle(str2);
        ss2 = ss2.substr(0,2)
        var ss3 = shuffle(str3);
        ss3 = ss3.substr(0,2)
        str = ss1+ss2+ss3;
        function shuffle(string) {
            var parts = string.split('');
            for (var i = parts.length; i > 0;) {
                var random = parseInt(Math.random() * i);
                var temp = parts[--i];
                parts[i] = parts[random];
                parts[random] = temp;
            }
            return parts.join('');
        }
        str = shuffle(str);
        $('#reg_password').val(str);
        $('#reg_passwordconfirm').val(str);

    })

    $('#reveal_pass').mousedown(function (e) {
        e.preventDefault();
        $('input#reg_password').attr('type', 'text');
    })
    $('#reveal_pass').mouseup(function (e) {
        e.preventDefault();
        $('input#reg_password').attr('type', 'password');
    })




    // register form validation //
    $('#reg_name').focusout( function () {
        $('.invalid_name').css('display', 'none');
        var val = $(this).val();
        if(val == ''){


            $('#reg_name_err').text('نام را پر کنید!').css('display', 'block');
            $(this).css('border-color', 'darkred');
        }else{
            resetError('#reg_name_err', '#reg_name');
        }
    })

    $('#reg_lname').focusout( function () {
        $('.invalid_lname').css('display', 'none');
        var val = $(this).val();
        if(val == ''){
            $('#reg_lname_err').text('نام خانوادگی را پر کنید!').css('display', 'block');
            $(this).css('border-color', 'darkred');
        }else{
            resetError('#reg_lname_err', '#reg_lname');
        }
    })

    $('#reg_email').on('input', function () {
        $('.invalid_email').css('display', 'none');

        var val = $(this).val();
        if(val == ''){
            $('#reg_email_err1').text('ایمیل را پر کنید!').css('display', 'block');
            $(this).css('border-color', 'darkred');
        }else{
            resetError('#reg_email_err1', '#reg_email');
        }
        var regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if(! regex.test(val)){
            $('#reg_email_err2').text('ایمیل معتبر نیست!').css('display', 'block');
            $(this).css('border-color', 'darkred');
        }else{
            resetError('#reg_email_err2', '#reg_email');
        }
    });

    $('#reg_phone').on( 'input',function () {
        $('.invalid_phone').css('display', 'none');

        var val = $(this).val();
        if(val.length != 11){
            $('#reg_phone_err1').text('تعداد ارقام باید 11 باشد!').css('display', 'block');
            $(this).css('border-color', 'darkred');
        }else{
            resetError('#reg_phone_err1', '#reg_phone');
        }
        var fd = val.substr(0,1);
        if (fd != 0){
            $('#reg_phone_err2').text('شماره باید با 0 شروع شود!').css('display', 'block');
            $(this).css('border-color', 'darkred');
        }else {
            resetError('#reg_phone_err2', '#reg_phone');
        }
    })

    $('#reg_username').focusout( function () {
        $('.invalid_username').css('display', 'none');

        var val = $(this).val();
        if(val == ''){
            $('#reg_username_err').text('نام کاربری را پر کنید!').css('display', 'block');
            $(this).css('border-color', 'darkred');
        }else{
            resetError('#reg_username_err', '#reg_username');
        }
    })

    $('#reg_password').on('input', function () {
        $('.invalid_password').css('display', 'none');

        var val = $(this).val();
        if(val == ''){
            $('#reg_password_err1').text('پسورد را پر کنید!').css('display', 'block');
            $(this).css('border-color', 'darkred');
        }else{
            resetError('#reg_password_err1', '#reg_password');
        }
        if(val.length < 6){
            $('#reg_password_err2').text('حداقل طول پسورد باید 6 باشد!').css('display', 'block');
            $(this).css('border-color', 'darkred');
        }else{
            resetError('#reg_password_err2', '#reg_password');
        }
        var regex2 = /^(?=.*[0-9])(?=.*[a-zA-Z])(?=.*[!,@,#,$,&,*])([a-zA-Z0-9!,@,#,$,&,*]+)$/;
        if(! regex2.test(val)){
            $('#reg_password_err3').text('فرمت پسورد معتبر نیست!').css('display', 'block');
            $(this).css('border-color', 'darkred');
        }else{
            resetError('#reg_password_err3', '#reg_password');
        }

        // powerPass //
        var power = 0;
        var char1 = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        var char2 = "0123456789";
        var char3 = "!@#$&*";
        for (var i = 0; i < val.length; i++) {
            var n1 = char1.indexOf(val[i]);
            if (n1 > 0) {
                power++;
                break;
            }
        }
        for (var i = 0; i < val.length; i++) {
            var n2 = char2.indexOf(val[i]);
            if (n2 > 0) {
                power++;
                break;
            }
        }
        for (var i = 0; i < val.length; i++) {
            var n3 = char3.indexOf(val[i]);
            if (n3 > 0) {
                power++;
                break;
            }
        }
        if (val.length < 6) {
            power--;
        }


        console.log(power);

        switch (power) {
            case 0:
            $('div.powerpass').find('span').text('');
            $('div.powerpass').css({
                'background-color': '#C91F37',
                'width': '0'
            })
            break;
            case 1:
            $('div.powerpass').find('span').text('رمز عبور: ضعيف');
            $('div.powerpass').css({
                'background-color': '#DC3023',
                'width': '33%'
            })
            break;
            case 2:
            $('div.powerpass').find('span').text('رمز عبور: متوسط');
            $('div.powerpass').css({
                'background-color': '#FFA400',
                'width': '66%'
            })
            break;
            case 3:
            $('div.powerpass').find('span').text('رمز عبور: قوي');
            $('div.powerpass').css({
                'background-color': '#26C281',
                'width': '100%'
            })
            break;
        }
        // powerPass //
    });

    $('#reg_passwordconfirm').on('input', function () {
        var val = $(this).val();
        var pass = $('#reg_password').val();
        if(val != pass){
            $('#reg_passwordconfirm_err').text('پسوردها مشابه نیستند!').css('display', 'block');
            $(this).css('border-color', 'darkred');
        }else{
            resetError('#reg_passwordconfirm_err', '#reg_passwordconfirm');
        }
    })

    $('#reg_country').focusout( function () {
        $('.invalid_country').css('display', 'none');
        $('.invalid_zone').css('display', 'none');

        var val = $(this).val();
        if(val == null){
            $('#reg_country_err').text('استان را انتخاب کنید!').css('display', 'block');
            $(this).css('border-color', 'darkred');
        }else{
            resetError('#reg_country_err', '#reg_country');
        }
    })

    $('input#agree').change(function (event) {
        var checked = $('input#agree').prop('checked');
        if (checked == true) {
            $('button#reg_submit').attr('disabled', false);
        } else {
            $('button#reg_submit').attr('disabled', true);
        }
    });



    function resetError(input_id, parent_id){
        $(input_id).text('').css('display', 'none');
        $(parent_id).css('border-color', '#ccc');
    }

    // register form validation //


    $('input#confirm_agree').change(function () {
        var stat = $(this).prop('checked');
        if (stat == true) {
            $('input#button-confirm').attr('disabled', false);
        } else {
            $('input#button-confirm').attr('disabled', true);
        }

    });

    $('#editProfile :input').change(function () {
        $('#editProfile_submit').attr('disabled', false);
    });
    $('#frm_videoEdit :input').change(function () {
        $('#editVideo').attr('disabled', false);
    });
    $('#frm_catEdit :input').change(function () {
        $('#editCat').attr('disabled', false);
    });
    $('#frm_slideEdit :input').change(function () {
        $('#editSlide').attr('disabled', false);
    });



    $('.edit_video_modal').click(function () {
        var url = $(this).data('url');
        var id = $(this).data('id');
        var name = $(this).data('name');
        var status = $(this).data('status');
        $('#videoID').val(id);
        $('#video_name').val(name);
        $('.video_status').each(function (index, el) {
            $(this).removeAttr('selected');
            if(status == $(this).val()){
                $(this).attr('selected','selected');
            }
        });

    })


    $('#editVideo').click(function () {
        var video_id = $('#videoID').val();
        var video_name = $('#video_name').val();
        var video_status = $('#status_select').val();

        $.ajax({
            url: '/admin/videos/update',
            type: 'POST',
            data: { 'video_id': video_id ,'name': video_name ,'status': video_status ,
            '_token': $('meta[name="csrf-token"]').attr('content') },
            dataType: 'JSON',
            success: function (data) {
                if (data == 1){
                    alert('ویرایش انجام شد.');
                    location.reload();
                } else {
                    $('small#errors').text(data['name'][0]);
                    $('button.edit').text('ویرایش').css('opacity', '1');
                }
                console.log(data);
            }, error:function (err) {
                console.log(err);
            }
        });
    })



    // Multi checkbox //
    $('.master_chk').change(function () {
        var status = $(this).prop('checked');
        if (status == true){
            $('.slave_chk').prop('checked', true);
        }else{
            $('.slave_chk').prop('checked', false);
        }
    })
    $('.slave_chk').change(function () {
        var status = $(this).prop('checked');
        if (status == false){
            $('.master_chk').prop('checked', false);
        }
        $count = 0;
        $.each($('.slave_chk'), function () {
            if($(this).prop('checked') == false){
                $count++;
            }
        });
        if($count == 0){
            $('.master_chk').prop('checked', true);
        }
    })
    // Multi checkbox //


    $('.sidenav').sidenav({
        edge: 'right',
        preventScrolling: false
    });
    $('.count').each(function () {
        $(this).prop('Counter',0).animate({
            Counter: $(this).text()
        }, {
            duration: 3000,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now));
            }
        });
    });




    var selected_action = '';
    $('#cat_ops').change(function () {
        var value = $(this).val();
        if (value == 1){
            $('.do_action').attr('disabled',false);
            selected_action = 'delete';
        }
    });
    $('.do_action').click(function (e) {
        e.preventDefault();
        var dataId=[];
        var count = $('input#counter').val();
        for (i=1; i<=count; i++){
            var checked_status = $('#catChk'+i).prop('checked');
            if(checked_status == true){
                dataId.push($('#catChk'+i).data('id'));
            }
        }

        if(dataId.length == 0){
            alert('هیچ آیتمی انتخاب نشده است');
        }else{
            $(this).find('i').css('display', 'inline-block').addClass('fa-spin');
            var data_to_send = JSON.stringify(dataId);
            $.ajax({
                url: '/admin/cat_bulk_delete',
                type: 'POST',
                data: { ids: data_to_send , '_token': $('meta[name="csrf-token"]').attr('content') },
                dataType: 'JSON',
                success: function (data) {
                    console.log(data);
                    if (data == 1){
                        location.reload();
                    }else {
                        alert('خطا در عملیات!');
                        $('.do_action').find('i').css('display', 'none').removeClass('fa-spin');
                    }
                }, error:function (err) {
                    console.log(err);
                }
            });

        }

    });

    $('input#filter_name').keyup(function (e) {
        var len = $(this).val().length;
        var word = $(this).val();
        if (len > 2){
            $.get('http://localhost:8000/Ajax_search/' + word, function (data) {
                var items = [];
                var i = 0;
                for (i = 0; i < data.length; i++) {
                    items.push("'" + data[i] + "'");
                }
                $('input#filter_name').my_autocomplete({ 'source': items });
            }, 'json');
        }
    });

    $('[data-toggle="popover"]').popover();

    $('#button-coupon').click(function () {
        $(this).find('i').addClass('fa fa-circle-o-notch fa-spin mx-2');
        var code_name = $('input#input-coupon').val();
        $.ajax({
            url: '/discount_check',
            type: 'POST',
            data: {'code': code_name, '_token': $('meta[name="csrf-token"]').attr('content') },
            dataType: 'JSON',
            success: function (data) {
                if (data == 0){
                    alert('کد وارد شده معتبر نیست!');
                    $('#button-coupon').find('i').removeClass('fa fa-circle-o-notch fa-spin mx-2');
                }else {
                    $('#button-coupon').find('i').removeClass('fa fa-circle-o-notch fa-spin mx-2');
                    $('td#discount').text(data + '%');
                    $('small.warn').css('display', 'block');
                    $('a.del_coupon').css('display', 'block');
                    $('#button-coupon').attr('disabled', true);
                    $('input#input-coupon').attr('disabled', true);
                }
                refreshCart();
            }, error:function (err) {
                console.log(err);
            }
        });
    });


    $('.delivery_method').change(function () {
        $('.loadingPanel').css('display', 'flex');

        $('html, body').animate({
            scrollTop: 0
        }, 'slow');


        var value = $(this).val();
        $.ajax({
            url: '/delivery_method',
            type: 'POST',
            data: {'send_method': value, '_token': $('meta[name="csrf-token"]').attr('content') },
            dataType: 'JSON',
            success: function (data) {
                console.log('data: ' + data);
                switch (data){
                    case 0:
                    $('td#delivery_price').text('0 تومان');
                    break;
                    case 1:
                    $('td#delivery_price').text('8 تومان');
                    break;
                    case 2:
                    $('td#delivery_price').text('15 تومان');
                    break;
                }
                refreshCart();
            }, error:function (err) {
                console.log(err);
            },complete: function () {
                $('.loadingPanel').css('display', 'none');
            }
        });
    })



    $('input#input-coupon').keyup(function () {
        if ($(this).val() != '') {
            $('#button-coupon').attr('disabled', false);
        } else {
            $('#button-coupon').attr('disabled', true);
        }
    })



    var initStatus = $('input#radio_login').attr('checked');
    if (initStatus == 'checked') {
        $('div#panel_user').css('display', 'block');
        $('div#panel_reg').css('display', 'none');
        $('div#panel_login').css('display', 'none');
    } else {
        $('div#panel_user').css('display', 'none');
        $('div#panel_reg').css('display', 'none');
        $('div#panel_login').css('display', 'none');
    }


    $('input#radio_login').click(function () {
        $('div#panel_login').css('display', 'block');
        $('div#panel_user').css('display', 'none');
        $('div#panel_reg').css('display', 'none');
    })
    $('input#radio_reg').click(function () {
        $('div#panel_login').css('display', 'none');
        $('div#panel_reg').css('display', 'block');
        $('div#panel_user').css('display', 'none');
    })
    $('input#radio_guest').click(function () {
        $('div#panel_login').css('display', 'none');
        $('div#panel_user').css('display', 'none');
        $('div#panel_reg').css('display', 'none');
    })


    $('.addToCart').click(function () {
        var id = $(this).attr('id');
        $(this).text('افزودن به سبد ...').prop('disabled', true);
        var count = $('input#input-quantity').val();
        var color_id = $('#sel_color').val();
        $.ajax({
            url: '/addToCart',
            type: 'POST',
            data: {'id': id, 'count': count, 'color_id': color_id,
            '_token': $('meta[name="csrf-token"]').attr('content') },
            dataType: 'JSON',
            success: function (data) {
                console.log('data: ' + data);
                if (data == 0) {
                    alert('محصول قبلا اضافه شده');
                    $('.addToCart').text('افزودن به سبد').attr('disabled', false);
                } else {
                    location.reload();
                }
            }, error:function (err) {
                console.log(err);
            }
        });
    });


    setTimeout(function () {
        $('div#reviewAlert').slideUp(300);
    }, 5000);


    $('div#DataTables_Table_0_filter').find('input').attr('placeholder', 'جستجو...')
    .addClass('form-control');





    $('button.submit').click(function () {
        $(this).removeClass('submit').addClass('submitted');
        $(this).find('i').removeClass('fa fa-check mx-3').addClass('fa fa-refresh fa-spin');
    });


    $('button.edit').click(function () {
        $(this).text('در حال ویرایش ...').css('opacity', '0.5');
    });


    $('a.cat-del').click(function () {
        var url = $(this).attr('data-url');
        $("form#cat_modal_frm").attr('action', url);
    });
    $('a.color-del').click(function () {
        var url = $(this).attr('data-url');
        $("form#color_modal_frm").attr('action', url);
    });
    $('a.product-del').click(function () {
        var url = $(this).attr('data-url');
        $("form#product_modal_frm").attr('action', url);
    });
    $('a.brand-del').click(function () {
        var url = $(this).attr('data-url');
        $("form#brand_modal_frm").attr('action', url);
    });
    $('a.discount-del').click(function () {
        var url = $(this).attr('data-url');
        $("form#discount_modal_frm").attr('action', url);
    });
    $('a.video-del').click(function () {
        var url = $(this).attr('data-url');
        $("form#video_modal_frm").attr('action', url);
    });
    $('a.slider-del').click(function () {
        var url = $(this).attr('data-url');
        $("form#slider_modal_frm").attr('action', url);
    });


    setTimeout(function () {
        var dis = $('div.alert-success').css('display');
        if (dis == 'block') {
            $('div.alert').fadeOut(1000);
        }
    }, 2000);

    $('input.color_picker').change(function () {
        var color = $(this).val();
        $('label.color_label').text('کد رنگ:' + '  ' + color);
    });

    $('a.del_brand_pic').click(function () {
        var id = $(this).attr('id');
        if (confirm('تصویر پاک شود؟')) {
            $.get('http://localhost:8000/admin/del_brand_pic/' + id, function (data) {
                location.reload();
            });
        }
    });

    $('form#reviewFrm').find('input[type=range]').change(function () {
        var value = $(this).val();
        $('form#reviewFrm').find('span.text-warning').text(value + ' ');
    });


    // Elevate Zoom for Product Page image
    $("#zoom_01").elevateZoom({
        gallery: 'gallery_01',
        cursor: 'pointer',
        galleryActiveClass: 'active',
        imageCrossfade: true,
        zoomWindowFadeIn: 500,
        zoomWindowFadeOut: 500,
        zoomWindowPosition: 11,
        lensFadeIn: 500,
        lensFadeOut: 500,
        loadingIcon: 'image/progress.gif'
    });
    //////pass the images to swipebox
    $("#zoom_01").bind("click", function (e) {
        var ez = $('#zoom_01').data('elevateZoom');
        $.swipebox(ez.getGalleryList());
        return false;
    });


    $('button#cap').click(function () {
        $.ajax({
            type: "GET",
            url: "captcha",
            success: function (response) {
                $('img#captcha').attr('src', response);
            },
            error: function (err) {
                console.log(err);
            }
        });
    });

    $('a.accept_review').click(function () {
        var id = $(this).attr('id');
        if (confirm('نظر تایید شود؟')) {
            $.get('http://localhost:8000/accept_review/' + id, function (data) {
                location.reload();
            });
        }
    });
    $('a.reject_review').click(function () {
        var id = $(this).attr('id');
        if (confirm('نظر رد شود؟')) {
            $.get('http://localhost:8000/reject_review/' + id, function (data) {
                location.reload();
            });
        }
    });

    $('button.addFav').click(function () {
        var productId = $(this).attr('id');
        $.ajax({
            type: "GET",
            url: "http://localhost:8000/addFavotite/" + productId,
            success: function (response) {
                alert(JSON.parse(response));
                location.reload();
            },
            error: function (err) {
                console.log(err);
            }
        });
    });


    $('a[data-toggle=modal]').click(function (event) {
        $('.modal-dialog').animate({
            top: '0'
        }, 300);
    });
    $('button[data-dismiss=modal]').click(function (event) {
        $('.modal-dialog').css('top', '-500px');
    });


    // Specifications //
    $('a.editSpec').click(function () {
        var id = $(this).attr('id');
        $('form#editSpec').css('display', 'block');
        $('form#addSpec').css('display', 'none');

        $('input#title').focus();
        $.get('http://localhost:8000/admin/specs/' + id + '/edit', function (response) {
            $('input#title').val(response['title']);
            $('input#spec1').val(response['spec1']);
            $('input#spec2').val(response['spec2']);
            $('input#spec3').val(response['spec3']);
            $('input#spec_id').val(response['spec_id']);
            $('input#product_id').val(response['product_id']);
            $('textarea#desc1').text(response['desc1']);
            $('textarea#desc2').text(response['desc2']);
            $('textarea#desc3').text(response['desc3']);
            $('form#editSpec').attr("action", "http://localhost:8000/admin/specs/" + response['spec_id']);
        }, 'json');
    });

    $('a.deleteSpec').click(function () {
        var id = $(this).attr('id');
        if (confirm('ویژگی پاک شود؟')) {
            $.get('http://localhost:8000/admin/deleteSpecification/' + id, function (data) {
                location.reload();
                alert(JSON.parse(data));
            });
        }
    });

    $('a#cancel_editfrm').click(function () {
        $('form#editSpec').css('display', 'none');
        $('form#addSpec').css('display', 'block');
        $('form#addSpec').find('input').val('');
        $('form#addSpec').find('textarea').val('');
    });



});




(function ($) {
    "use strict";


    /*----------------------------
     Slideshow
     ------------------------------ */
     $('.slideshow').owlCarousel({
        items: 6,
        autoPlay: 15000,
        singleItem: true,
        navigation: true,
        navigationText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>'],
        pagination: true
    });

    /*---------------------------------------------------
     Banner Slider (with Fade in Fade Out effect)
     ----------------------------------------------------- */
     $('.banner').owlCarousel({
        items: 6,
        autoPlay: 15000,
        singleItem: true,
        navigation: false,
        pagination: false,
        transitionStyle: 'fade'
    });

    /*---------------------------------------------------
     Product Slider (with owl-carousel)
     ----------------------------------------------------- */
     $(".owl-carousel.product_carousel, .owl-carousel.latest_category_carousel, .owl-carousel.latest_brands_carousel, .owl-carousel.related_pro").owlCarousel({
        itemsCustom: [
        [320, 1],
        [600, 2],
        [768, 3],
        [992, 5],
        [1199, 5]
        ],
        lazyLoad: true,
        navigation: true,
        navigationText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        scrollPerPage: true
    });

    /*---------------------------------------------------
     Product Carousel Slider with Tab
     ----------------------------------------------------- */
     $("#latest_category .owl-carousel.latest_category_tabs").owlCarousel({
        itemsCustom: [
        [320, 1],
        [600, 2],
        [768, 3],
        [992, 5],
        [1199, 5]
        ],
        lazyLoad: true,
        navigation: true,
        navigationText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        scrollPerPage: true,
    });
     $("#latest_category .tab_content").addClass("deactive");
     $("#latest_category .tab_content:first").show();
    //Default Action
    $("#latest_category ul#sub-cat li:first").addClass("active").show(); //Activate first tab
    //On Click Event
    $("#latest_category ul#sub-cat li").on("click", function () {
        $("#latest_category ul#sub-cat li").removeClass("active"); //Remove any "active" class
        $(this).addClass("active"); //Add "active" class to selected tab
        $("#latest_category .tab_content").hide();
        var activeTab = $(this).find("a").attr("href"); //Find the rel attribute value to identify the active tab + content
        $(activeTab).fadeIn(); //Fade in the active content
        return false;
    });

    /*---------------------------------------------------
     Brand Slider (Default Owl Carousel)
     ----------------------------------------------------- */
     $('#carousel').owlCarousel({
        items: 6,
        autoPlay: 15000,
        lazyLoad: true,
        navigation: true,
        navigationText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        pagination: true
    });

    /*---------------------------------------------------
     Product Tab Carousel Slider(Featured,Latest,specila,etc..)
     ----------------------------------------------------- */
     $("#product-tab .product_carousel_tab").owlCarousel({
        itemsCustom: [
        [320, 1],
        [600, 2],
        [768, 3],
        [992, 5],
        [1199, 5]
        ],
        lazyLoad: true,
        navigation: true,
        navigationText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        scrollPerPage: true
    });
     $("#product-tab .tab_content").addClass("deactive");
     $("#product-tab .tab_content:first").show();
    //Default Action
    $("ul#tabs li:first").addClass("active").show(); //Activate first tab
    //On Click Event
    $("ul#tabs li").on("click", function () {
        $("ul#tabs li").removeClass("active"); //Remove any "active" class
        $(this).addClass("active"); //Add "active" class to selected tab
        $("#product-tab .tab_content").hide();
        var activeTab = $(this).find("a").attr("href"); //Find the rel attribute value to identify the active tab + content
        $(activeTab).fadeIn(); //Fade in the active content
        return false;
    });

    /*---------------------------------------------------
     Categories Accordion
     ----------------------------------------------------- */
    // $('#cat_accordion').cutomAccordion({
    //     saveState: false,
    //     autoExpand: true
    // });

    /*---------------------------------------------------
     Main Menu
     ----------------------------------------------------- */
     $('#menu .nav > li > .dropdown-menu').each(function () {
        var menu = $('#menu').offset();
        var dropdown = $(this).parent().offset();

        var i = (dropdown.left + $(this).outerWidth()) - (menu.left + $('#menu').outerWidth());

        if (i > 0) {
            $(this).css('margin-left', '-' + (i + 5) + 'px');
        }
    });

     var $screensize = $(window).width();
     $('#menu .nav > li, #header .links > ul > li').on("mouseover", function () {

        if ($screensize > 991) {
            $(this).find('> .dropdown-menu').stop(true, true).slideDown('fast');
        }
        $(this).bind('mouseleave', function () {

            if ($screensize > 991) {
                $(this).find('> .dropdown-menu').stop(true, true).css('display', 'none');
            }
        });
    });
     $('#menu .nav > li div > ul > li').on("mouseover", function () {
        if ($screensize > 991) {
            $(this).find('> div').css('display', 'block');
        }
        $(this).bind('mouseleave', function () {
            if ($screensize > 991) {
                $(this).find('> div').css('display', 'none');
            }
        });
    });
     $('#menu .nav > li > .dropdown-menu').closest("li").addClass('sub');

    // Clearfix for sub Menu column
    $(document).ready(function () {
        $screensize = $(window).width();
        if ($screensize > 1199) {
            $('#menu .nav > li.mega-menu > div > .column:nth-child(6n)').after('<div class="clearfix visible-lg-block"></div>');
        }
        if ($screensize < 1199) {
            $('#menu .nav > li.mega-menu > div > .column:nth-child(4n)').after('<div class="clearfix visible-lg-block visible-md-block"></div>');
        }
    });
    $(window).resize(function () {
        $screensize = $(window).width();
        if ($screensize > 1199) {
            $("#menu .nav > li.mega-menu > div .clearfix.visible-lg-block").remove();
            $('#menu .nav > li.mega-menu > div > .column:nth-child(6n)').after('<div class="clearfix visible-lg-block"></div>');
        }
        if ($screensize < 1199) {
            $("#menu .nav > li.mega-menu > div .clearfix.visible-lg-block").remove();
            $('#menu .nav > li.mega-menu > div > .column:nth-child(4n)').after('<div class="clearfix visible-lg-block visible-md-block"></div>');
        }
    });

    // Clearfix for Brand Menu column
    $(document).ready(function () {
        $screensize = $(window).width();
        if ($screensize > 1199) {
            $('#menu .nav > li.menu_brands > div > div:nth-child(12n)').after('<div class="clearfix visible-lg-block"></div>');
        }
        if ($screensize < 1199) {
            $('#menu .nav > li.menu_brands > div > div:nth-child(6n)').after('<div class="clearfix visible-lg-block visible-md-block"></div>');
        }
        if ($screensize < 991) {
            $("#menu .nav > li.menu_brands > div > .clearfix.visible-lg-block").remove();
            $('#menu .nav > li.menu_brands > div > div:nth-child(4n)').after('<div class="clearfix visible-lg-block visible-sm-block"></div>');
            $('#menu .nav > li.menu_brands > div > div:last-child').after('<div class="clearfix visible-lg-block visible-sm-block"></div>');
        }
        if ($screensize < 767) {
            $("#menu .nav > li.menu_brands > div > .clearfix.visible-lg-block").remove();
            $('#menu .nav > li.menu_brands > div > div:nth-child(2n)').after('<div class="clearfix visible-lg-block visible-xs-block"></div>');
            $('#menu .nav > li.menu_brands > div > div:last-child').after('<div class="clearfix visible-lg-block visible-xs-block"></div>');
        }
    });
    $(window).resize(function () {
        $screensize = $(window).width();
        if ($screensize > 1199) {
            $("#menu .nav > li.menu_brands > div > .clearfix.visible-lg-block").remove();
            $('#menu .nav > li.menu_brands > div > div:nth-child(12n)').after('<div class="clearfix visible-lg-block"></div>');
        }
        if ($screensize < 1199) {
            $("#menu .nav > li.menu_brands > div > .clearfix.visible-lg-block").remove();
            $('#menu .nav > li.menu_brands > div > div:nth-child(6n)').after('<div class="clearfix visible-lg-block visible-md-block"></div>');
        }
        if ($screensize < 991) {
            $("#menu .nav > li.menu_brands > div > .clearfix.visible-lg-block").remove();
            $('#menu .nav > li.menu_brands > div > div:nth-child(4n)').after('<div class="clearfix visible-lg-block visible-sm-block"></div>');
            $('#menu .nav > li.menu_brands > div > div:last-child').after('<div class="clearfix visible-lg-block visible-sm-block"></div>');
        }
        if ($screensize < 767) {
            $("#menu .nav > li.menu_brands > div > .clearfix.visible-lg-block").remove();
            $('#menu .nav > li.menu_brands > div > div:nth-child(4n)').after('<div class="clearfix visible-lg-block visible-xs-block"></div>');
            $('#menu .nav > li.menu_brands > div > div:last-child').after('<div class="clearfix visible-lg-block visible-xs-block"></div>');
        }
    });

    /*---------------------------------------------------
     Language and Currency Dropdowns
     ----------------------------------------------------- */
     $('#currency, #language, #my_account', '#user_dd' ,'#admin_dd').hover(function () {
        $(this).find('ul').stop(true, true).slideDown('fast');
    }, function () {
        $(this).find('ul').stop(true, true).css('display', 'none');
    });

    /*---------------------------------------------------
     Mobile Main Menu
     ----------------------------------------------------- */
     $('#menu .navbar-header > span').on("click", function () {
        $(this).toggleClass("active");
        $("#menu .navbar-collapse").slideToggle('medium');
        return false;
    });

    //mobile sub menu plus/mines button
    $('#menu .nav > li > div > .column > div, .submenu, #menu .nav > li .dropdown-menu').before('<span class="submore"></span>');

    //mobile sub menu click function
    $('span.submore').on("click", function () {
        $(this).next().slideToggle('fast');
        $(this).toggleClass('plus');
        return false;
    });
    //mobile top link click
    $('.drop-icon').on("click", function () {
        $('#header .htop').find('.left-top').slideToggle('fast');
        return false;
    });

    /*---------------------------------------------------
     Increase and Decrease Button Quantity for Product Page
     ----------------------------------------------------- */
     $(".qtyBtn").on("click", function () {
        if ($(this).hasClass("plus")) {
            var qty = $(".qty #input-quantity").val();
            qty++;
            $(".qty #input-quantity").val(qty);
        } else {
            var qty = $(".qty #input-quantity").val();
            qty--;
            if (qty > 0) {
                $(".qty #input-quantity").val(qty);
            }
        }
        return false;
    });

    /*---------------------------------------------------
     Product List
     ----------------------------------------------------- */
     $('#list-view').on("click", function () {
        $(".products-category > .clearfix.visible-lg-block").remove();
        $('#content .product-layout').attr('class', 'product-layout product-list col-xs-12');
        localStorage.setItem('display', 'list');
        $('.btn-group').find('#list-view').addClass('selected');
        $('.btn-group').find('#grid-view').removeClass('selected');
        return false;
    });

    /*---------------------------------------------------
     Product Grid
     ----------------------------------------------------- */
     $(document).on('click', '#grid-view', function (e) {
        $('#content .product-layout').attr('class', 'product-layout product-grid col-lg-3 col-md-3 col-sm-4 col-xs-12');

        $screensize = $(window).width();
        if ($screensize > 1199) {
            $(".products-category > .clearfix").remove();
            $('.product-grid:nth-child(4n)').after('<span class="clearfix visible-lg-block"></span>');
        }
        if ($screensize < 1199) {
            $(".products-category > .clearfix").remove();
            $('.product-grid:nth-child(4n)').after('<span class="clearfix visible-lg-block visible-md-block"></span>');
        }
        if ($screensize < 991) {
            $(".products-category > .clearfix").remove();
            $('.product-grid:nth-child(3n)').after('<span class="clearfix visible-lg-block visible-sm-block"></span>');
        }
        $(window).resize(function () {
            $screensize = $(window).width();
            if ($screensize > 1199) {
                $(".products-category > .clearfix").remove();
                $('.product-grid:nth-child(4n)').after('<span class="clearfix visible-lg-block"></span>');
            }
            if ($screensize < 1199) {
                $(".products-category > .clearfix").remove();
                $('.product-grid:nth-child(4n)').after('<span class="clearfix visible-lg-block visible-md-block"></span>');
            }
            if ($screensize < 991) {
                $(".products-category > .clearfix").remove();
                $('.product-grid:nth-child(3n)').after('<span class="clearfix visible-lg-block visible-sm-block"></span>');
            }
            if ($screensize < 767) {
                $(".products-category > .clearfix").remove();
            }
        });
        localStorage.setItem('display', 'grid');
        $('.btn-group').find('#grid-view').addClass('selected');
        $('.btn-group').find('#list-view').removeClass('selected');
    });
     if (localStorage.getItem('display') == 'list') {
        $('#list-view').trigger('click');
    } else {
        $('#grid-view').trigger('click');
    }

    /*---------------------------------------------------
     tooltips
     ----------------------------------------------------- */
     $('[data-toggle=\'tooltip\']').tooltip({
        container: 'body'
    });

    /*---------------------------------------------------
     Scroll to top
     ----------------------------------------------------- */
     $(function () {
        $(window).scroll(function () {
            if ($(this).scrollTop() > 150) {
                $('#back-top').fadeIn();
            } else {
                $('#back-top').fadeOut();
            }
        });
    });
     $('#back-top').on("click", function () {
        $('html, body').animate({
            scrollTop: 0
        }, 'slow');
        return false;
    });

    /*---------------------------------------------------
     Facebook Side Block
     ----------------------------------------------------- */
     $(function () {
        $("#facebook.fb-left").hover(function () {
            $(this).stop(true, false).animate({
                left: "0"
            }, 800, 'easeOutQuint');
        },
        function () {
            $(this).stop(true, false).animate({
                left: "-241px"
            }, 800, 'easeInQuint');
        }, 1000);
    });
     $(function () {
        $("#facebook.fb-right").hover(function () {
            $(this).stop(true, false).animate({
                right: "0"
            }, 800, 'easeOutQuint');
        },
        function () {
            $(this).stop(true, false).animate({
                right: "-241px"
            }, 800, 'easeInQuint');
        }, 1000);
    });

    /*---------------------------------------------------
     Twitter Side Block
     ----------------------------------------------------- */
     $(function () {
        $("#twitter_footer.twit-left").hover(function () {
            $(this).stop(true, false).animate({
                left: "0"
            }, 800, 'easeOutQuint');
        },
        function () {
            $(this).stop(true, false).animate({
                left: "-215px"
            }, 800, 'easeInQuint');
        }, 1000);
    });
     $(function () {
        $("#twitter_footer.twit-right").hover(function () {
            $(this).stop(true, false).animate({
                right: "0"
            }, 800, 'easeOutQuint');
        },
        function () {
            $(this).stop(true, false).animate({
                right: "-215px"
            }, 800, 'easeInQuint');
        }, 1000);
    });

    /*---------------------------------------------------
     Video Side Block
     ----------------------------------------------------- */
     $(function () {
        $("#video_box.vb-left").hover(function () {
            $(this).stop(true, false).animate({
                left: "0"
            }, 800, 'easeOutQuint');
        },
        function () {
            $(this).stop(true, false).animate({
                left: "-566px"
            }, 800, 'easeInQuint');
        }, 1000);
    });
     $(function () {
        $("#video_box.vb-right").hover(function () {
            $(this).stop(true, false).animate({
                right: "0"
            }, 800, 'easeOutQuint');
        },
        function () {
            $(this).stop(true, false).animate({
                right: "-566px"
            }, 800, 'easeInQuint');
        }, 1000);
    });

    /*---------------------------------------------------
     Custom Side Block
     ----------------------------------------------------- */
     $(function () {
        $('#custom_side_block.custom_side_block_left').hover(function () {
            $(this).stop(true, false).animate({
                left: '0'
            }, 800, 'easeOutQuint');
        },
        function () {
            $(this).stop(true, false).animate({
                left: '-215px'
            }, 800, 'easeInQuint');
        }, 1000);
    });
     $(function () {
        $("#custom_side_block.custom_side_block_right").hover(function () {
            $(this).stop(true, false).animate({
                right: "0"
            }, 800, 'easeOutQuint');
        },
        function () {
            $(this).stop(true, false).animate({
                right: "-215px"
            }, 800, 'easeInQuint');
        }, 1000);
    });

 })(jQuery);
