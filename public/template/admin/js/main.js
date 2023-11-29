$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function removeRow(id, url) {
    if (confirm('Xóa không thể khôi phục lại. Bạn có chắc chắn?')) {
        $.ajax({
            type: 'DELETE',
            dataType: 'JSON',
            data: { id },
            url: url,
            success: function (result) {
                console.log(result);
                if (result.error == false) {
                    alert(result.message);
                    location.reload();
                } else {
                    alert('Xóa lỗi vui lòng thử lại')
                }
            },
            error: function (error) {
                console.log(error);
            }
        });
    }
}
function add_cart(id, url) {
    console.log(id, url);
    $.ajax({
        type: 'POST',
        dataType: 'json',
        data: {
            id: id,
        },
        url: url,
        success: function (result) {
            console.log(result);

            location.reload();
        },
        error: function (error) {
            console.log(error);
        }
    });
}
$(document).ready(function () {
    $('.btn-minus, .btn-plus').on('click', function () {
        var form = $(this).closest('.quantity-form');
        var formData = form.serialize();
        var url = form.attr('action');

        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            success: function (data) {
                // Xử lý kết quả Ajax nếu cần
            },
            error: function (error) {
                console.log(error);
            }
        });
    });
});


// function reloadSection() {
//     var firstName = $('input[name="firstName"]').val();
//     var lastName = $('input[name="lastName"]').val();
//     var email = $('input[name="email"]').val();
//     var phone = $('input[name="phone"]').val();
//     var password = $('input[name="password"]').val();
//     var confirmPassword = $('input[name="confirmPassword"]').val();

//     // Hiển thị biểu tượng reload xoay giữa màn hình
//     $('#reloadSection').html('<i class="fa fa-spinner fa-spin"></i> Đang xác thực...');

//     // Gửi AJAX request để xác thực và cập nhật nội dung
//     $.ajax({
//         type: 'POST',
//         data: {
//             firstName: firstName,
//             lastName: lastName,
//             email: email,
//             phone: phone,
//             password: password,
//             confirmPassword: confirmPassword,
//         },
//         dataType: 'JSON',
//         url: '/send',
//         success: function () {
//             // Xử lý kết quả nếu cần
//             // ...
//         },
//         error: function (error) {
//             console.log(error);
//             // Xử lý lỗi nếu cần
//         }
//     });
// }
//Upsload File
$('#upload').change(function () {
    const form = new FormData();
    form.append('file', $(this)[0].files[0]);
    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        data: form,
        dataType: 'JSON',
        url: '/admin/upload/services',
        success: function (results) {
            if (results.error == false) {
                $('#image_show').html('<a href""><img src="' + results.url + '" target = "_blank" width="200px"></a>');
                $('#thumb').val(results.url);
            } else {
                alert('Upload file lỗi');
            }
        }
    })
})

