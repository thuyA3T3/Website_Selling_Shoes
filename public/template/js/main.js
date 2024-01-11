(function ($) {
    "use strict";

    $(document).ready(function () {
        var editBtn = $('.edit-btn');
        var editForm = $('.edit-form');

        editBtn.click(function (event) {
            event.preventDefault();
            // Hiển thị form chỉnh sửa
            editForm.show();
        });

        // Bắt sự kiện click ngoài form để đóng form
        $(document).mouseup(function (e) {
            if (!editForm.is(e.target) && editForm.has(e.target).length === 0 && !editBtn.is(e.target)) {
                // Nếu click không phải là trên form hoặc nút chỉnh sửa, đóng form
                editForm.hide();
            }
        });
    });
    document.addEventListener('DOMContentLoaded', function () {
        var editShopBtns = document.querySelectorAll('.editShopBtn');

        editShopBtns.forEach(function (editShopBtn) {
            editShopBtn.addEventListener('click', function (event) {
                event.stopPropagation(); // Ngừng sự kiện click được truyền lên để tránh ẩn form ngay lập tức

                var targetId = editShopBtn.getAttribute('data-target');
                var editShopForm = document.getElementById('editShop' + targetId);

                // Thêm hoặc loại bỏ lớp d-none để hiển thị hoặc ẩn biểu mẫu
                editShopForm.classList.toggle('d-none');
            });
        });

        // Xử lý sự kiện click bên ngoài biểu mẫu để ẩn nó
        document.addEventListener('click', function (event) {
            editShopBtns.forEach(function (editShopBtn) {
                var targetId = editShopBtn.getAttribute('data-target');
                var editShopForm = document.getElementById('editShop' + targetId);

                // Kiểm tra xem sự kiện click có xảy ra bên ngoài biểu mẫu không
                var isClickInside = editShopForm.contains(event.target) || editShopBtn.contains(event.target);

                // Nếu không phải click bên trong, ẩn biểu mẫu
                if (!isClickInside) {
                    editShopForm.classList.add('d-none');
                }
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        var editBtn = document.querySelector('.edit-btn');
        var editForm = document.querySelector('.edit-form');

        editBtn.addEventListener('click', function (event) {
            event.preventDefault();
            // Hiển thị form chỉnh sửa
            editForm.style.display = 'block';
        });

        // Bắt sự kiện click ngoài form để đóng form
        document.addEventListener('click', function (event) {
            // Kiểm tra xem sự kiện click có xuất phát từ .edit-form hay không
            if (!editForm.contains(event.target) && event.target !== editBtn) {
                // Nếu click không phải là trên form hoặc nút chỉnh sửa, đóng form
                editForm.style.display = 'none';
            }
        });
    });


    $(document).ready(function () {
        $("#addProductBtn").click(function () {
            $("#addProductForm").toggle();
        });

        $(document).mouseup(function (e) {
            var container = $("#addProductForm");
            if (!container.is(e.target) && container.has(e.target).length === 0) {
                container.hide();
            }
        });
    });

    // Dropdown on mouse hover
    $(document).ready(function () {
        function toggleNavbarMethod() {
            if ($(window).width() > 768) {
                $('.navbar .dropdown').on('mouseover', function () {
                    $('.dropdown-toggle', this).trigger('click');
                }).on('mouseout', function () {
                    $('.dropdown-toggle', this).trigger('click').blur();
                });
            } else {
                $('.navbar .dropdown').off('mouseover').off('mouseout');
            }
        }
        toggleNavbarMethod();
        $(window).resize(toggleNavbarMethod);
    });


    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({ scrollTop: 0 }, 1500, 'easeInOutExpo');
        return false;
    });


    // Header slider
    $('.header-slider').slick({
        autoplay: true,
        dots: true,
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1
    });


    // Product Slider 4 Column
    $('.product-slider-4').slick({
        autoplay: true,
        infinite: true,
        dots: false,
        slidesToShow: 4,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 4,
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                }
            },
        ]
    });


    // Product Slider 3 Column
    $('.product-slider-3').slick({
        autoplay: true,
        infinite: true,
        dots: false,
        slidesToShow: 3,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                }
            },
        ]
    });


    // Product Detail Slider
    $('.product-slider-single').slick({
        infinite: true,
        autoplay: true,
        dots: false,
        fade: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        asNavFor: '.product-slider-single-nav'
    });
    $('.product-slider-single-nav').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        dots: false,
        centerMode: true,
        focusOnSelect: true,
        asNavFor: '.product-slider-single'
    });


    // Brand Slider
    $('.brand-slider').slick({
        speed: 5000,
        autoplay: true,
        autoplaySpeed: 0,
        cssEase: 'linear',
        slidesToShow: 5,
        slidesToScroll: 1,
        infinite: true,
        swipeToSlide: true,
        centerMode: true,
        focusOnSelect: false,
        arrows: false,
        dots: false,
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 4,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 300,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]
    });


    // Review slider
    $('.review-slider').slick({
        autoplay: true,
        dots: false,
        infinite: true,
        slidesToShow: 2,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]
    });


    // Widget slider
    $('.sidebar-slider').slick({
        autoplay: true,
        dots: false,
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1
    });


    // Quantity
    $('.qty button').on('click', function () {
        var $button = $(this);
        var oldValue = $button.parent().find('input').val();
        if ($button.hasClass('btn-plus')) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        $button.parent().find('input').val(newVal);
    });


    // Shipping address show hide
    $('.checkout #shipto').change(function () {
        if ($(this).is(':checked')) {
            $('.checkout .shipping-address').slideDown();
        } else {
            $('.checkout .shipping-address').slideUp();
        }
    });


    // Payment methods show hide
    $('.checkout .payment-method .custom-control-input').change(function () {
        if ($(this).prop('checked')) {
            var checkbox_id = $(this).attr('id');
            $('.checkout .payment-method .payment-content').slideUp();
            $('#' + checkbox_id + '-show').slideDown();
        }
    });
})(jQuery);

