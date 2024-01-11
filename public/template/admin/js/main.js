$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function removeRow(id, url) {
    if (confirm('Xóa không thể khôi phục lại. Bạn có chắc chắn?')) {
        console.log(id);
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
function handleKhoaClick(button) {
    var customerId = $(button).data('customer-id');
    // Thực hiện Ajax để gửi dữ liệu và chuyển hướng
    $.ajax({
        url: '/admin/customer/lock/' + customerId, // Thay đổi đường dẫn route theo yêu cầu của bạn
        type: 'POST',
        success: function (response) {
            // Xử lý phản hồi nếu cần thiết
            console.log(response);
            location.reload();

        },
        error: function (error) {
            // Xử lý lỗi nếu cần thiết
            console.log(error);
        }
    });
}
function handleConfirmClick(button) {
    var customerId = $(button).data('customer-id');
    var confirm = $(button).data('confirm');
    // Thực hiện Ajax để gửi dữ liệu và chuyển hướng
    console.log(confirm);
    console.log(customerId);
    $.ajax({
        url: '/admin/customer/confirm/' + customerId, // Thay đổi đường dẫn route theo yêu cầu của bạn
        type: 'GET',
        data: { confirm: confirm.toString() },
        success: function (response) {
            // Xử lý phản hồi nếu cần thiết
            console.log(response);
            location.reload();
        },
        error: function (error) {
            // Xử lý lỗi nếu cần thiết
            console.log(error);
        }
    });
}

function handleSelect(id, select) {
    $.ajax({
        url: '/pending',
        type: 'POST', // Thêm dòng này để chỉ định phương thức POST
        data: { id: id, select: select }, // Thêm dòng này nếu bạn muốn truyền dữ liệu
        success: function (response) {
            // Xử lý phản hồi nếu cần thiết
            console.log(response);
            location.reload();
        },
        error: function (error) {
            // Xử lý lỗi nếu cần thiết
            console.log(error);
        }
    });
}
document.addEventListener('DOMContentLoaded', function () {
    const stars = document.querySelectorAll('.rating input');
    const starReview = document.getElementById('starReview');
    stars.forEach(star => {
        star.addEventListener('change', function () {
            const rating = this.value;
            highlightStars(rating);
            starReview.value = rating;
        });

        star.addEventListener('mouseover', function () {
            const hoverValue = this.value;
            highlightStars(hoverValue);
        });

        star.addEventListener('mouseout', function () {
            resetStars();
        });
    });

    function highlightStars(value) {
        stars.forEach(star => {
            if (star.value <= value) {
                star.nextElementSibling.style.color = 'orange';
            } else {
                star.nextElementSibling.style.color = '#ccc';
            }
        });
    }

    function resetStars() {
        stars.forEach(star => {
            star.nextElementSibling.style.color = '#ccc';
        });
    }
});



// function reloadSection() {
//     var firstName = $('input[name="firstName"]').val();
//     var lastName = $('input[name="lastName"]').val();
//     var email = $('input[name="email"]').val();
//     var phone = $('input[name="phone"]').val();
//     var password = $('input[name="password"]').val();
//     var confirmPassword = $('input[name="confirmPassword"]').val();

//     // Hiển thị biểu tượng reload xoay giữa màn hình
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
        url: '/upload/services',
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

$('.upload1').change(function () {
    const index = $(this).data('index'); // Lấy giá trị của data-index

    const form = new FormData();
    form.append('file', $(this)[0].files[0]);

    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        data: form,
        dataType: 'JSON',
        url: '/upload/services',
        success: function (results) {
            if (results.error == false) {
                // Sử dụng giá trị của index trong mã JavaScript
                $('.image_show' + index).html('<a href=""><img src="' + results.url + '" target = "_blank" width="200px"></a>');
                $('.thumb' + index).val(results.url);
            } else {
                alert('Upload file lỗi');
            }
        }
    })
});




$(document).ready(function () {
    // Bắt sự kiện click trên tất cả các liên kết .nav-link
    $('#dashboard-nav').trigger('click');
    $('.nav-link').on('click', function () {
        // Lấy id của tab content tương ứng
        var tabContentId = $(this).attr('href');
        var tabContent = $(tabContentId);

        // Chèn tab content vào đầu của .col-md-9
        $('.col-md-9').prepend(tabContent);
    });

    // Trigger sự kiện click cho #dashboard-nav khi trang được tải

});
$(document).ready(function () {
    // Sự kiện click cho tab
    $('#myTabs .inactive-tab').on('click', function () {
        // Loại bỏ lớp đã chọn từ tất cả các tab
        $('#myTabs .inactive-tab').removeClass('selected-tab');

        // Thêm lớp đã chọn cho tab hiện tại
        $(this).addClass('selected-tab');
    });
});

document.addEventListener('DOMContentLoaded', function () {
    // Lấy tất cả các nút Xem có class "view-status-btn"
    var viewStatusButtons = document.querySelectorAll('.view-status-btn');

    // Duyệt qua mỗi nút Xem và thêm sự kiện click
    viewStatusButtons.forEach(function (button) {
        button.addEventListener('click', function (event) {
            // Lấy giá trị data-target từ nút Xem để xác định div cần hiển thị/ẩn
            var targetIndex = button.getAttribute('data-target');
            var orderStatus = document.getElementById('orderStatus' + targetIndex);

            // Hiển thị hoặc ẩn div orderStatus khi click vào nút Xem
            orderStatus.style.display = (orderStatus.style.display === 'none' || orderStatus.style.display === '') ? 'block' : 'none';

            // Ngăn sự kiện click từ nút Xem lan toả đến document
            event.stopPropagation();
        });
    });

    // Thêm sự kiện click vào document để đóng orderStatus khi click bên ngoài nó
    document.addEventListener('click', function (event) {
        viewStatusButtons.forEach(function (button) {
            var targetIndex = button.getAttribute('data-target');
            var orderStatus = document.getElementById('orderStatus' + targetIndex);

            if (event.target !== button && event.target !== orderStatus) {
                orderStatus.style.display = 'none';
            }
        });
    });
});
document.addEventListener('DOMContentLoaded', function () {
    // Kiểm tra hash fragment trong URL
    var hash = window.location.hash;

    if (hash === '#reviews') {
        // Nếu có hash fragment là #reviews, kích hoạt thẻ a
        var reviewsTab = document.getElementById('reviews-tab');

        if (reviewsTab) {
            reviewsTab.click();
        }
    }
});


function redirectToReviews(id) {
    window.location.href = '/product/' + id + '#reviews';
}