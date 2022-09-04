//wizard
const wizardContents = document.querySelectorAll('.wizard-content')
const wizardSteps = document.querySelectorAll('.steps li')
const wizardStepsSpan = document.querySelectorAll('.steps li span')

$('.wizard-content').hide()
wizardContents[0].style.display = 'block';

function changeWizard(index) {
    $('.wizard-content').hide()
    $('.steps li').removeClass('active')
    $('.steps li span').removeClass('active')
    wizardContents[index].style.display = 'block';
    wizardSteps[index].classList.add('active');
    $(wizardContents[index]).show();
    wizardStepsSpan[index].classList.add('active');
}

//

$('.change-name').click(function () {
    $('.wizard-content').hide()
    $('.steps li').removeClass('active')
    $('.steps li span').removeClass('active')
    wizardContents[0].style.display = 'block';
    wizardSteps[0].classList.add('active');
    $(wizardContents[0]).show();
    wizardStepsSpan[0].classList.add('active');
})


//images
$('form').on('change', 'input[type="file"]', function () {

    if (this.files && this.files[0]) {

        this.nextElementSibling.src = URL.createObjectURL(this.files[0]);


        if ($(this).next().is('img')) {
            $(this).next().next().show();
            var newImgHtml = "<div class=\"main-pic\"> <input type=\"file\" name=\"pic[]\" id=\"product-pic-2\"/> <img src=\"./public/media/uploadImage.jpg\"> <a class=\"btn btn-outline-danger btn-floating\"> <i class=\"ti-trash\"></i> </a> </div>";
            if ($(this).parent().parent().hasClass('upload-image')) {
                $(this).parent().parent().append(newImgHtml)
            }


        } else {
            $(this).next().show();
            $(this).next().next().hide();
            $(this).next().next().next().show();

        }
    }
    $('body').click()

});

//delete images
$('form').on('click', '.main-pic a', function () {
    if ($(this).parent().parent().hasClass('upload-image')) {
        $(this).parent().remove()
    }
    this.previousElementSibling.src = './public/media/uploadImage.jpg';
    $(this).hide()
})

//delete video
$('form').on('click', '.upload-video a', function () {
    console.log($(this))
    $(this).parent().children().eq(1).hide();
    $(this).parent().children().eq(2).show();
    $(this).hide()
})

//counter
$('.count-product a').click(function () {
    let count = Number($(this).parent().children().eq(1).val());

    if (this.textContent == '+') {
        count++;
        this.nextElementSibling.value = count;
    } else {
        count > 0 ? this.previousElementSibling.value = (count - 1) : ''

    }
})


//new brand
$('#newBrand').click(function () {
    if ($('.brands-list option:selected').val() == -1) {

    } else {
        $('.brands-list').val('-1');
        $(".brands-list").select2().select2('val', '-1');
        // $('.alert-modal').text('شما نام برند را انتخاب کرده اید.')
        // $(".alert-modal").show().delay(5000).fadeOut();
    }
    $('#addBrand').show()
    $('#addBrand input').val('')

})
$('.brands-list').change(function () {
    if ($('.brands-list option:selected').val() != 0) {
        $('#addBrand').hide()
        $('#addBrand input').val('')
    }
})


//Random
$('.btn-onlineShopping').hide()
$('.last-content .modal-btn-product').hide()

// $('.btn-add-product').hide()
$('#onlineShopping').click(function () {

    // $('#onlineShopping').is(':checked') ? ($('#onlineShoppingForm,.online_sale,.offline-part ,.btn-add-product').hide(),
    $('#onlineShopping').is(':checked') ? ($('.online_sale,.offline-part ,.btn-add-product').hide(),
            $('.last-content .modal-btn-product ,.btn-onlineShopping ,.upload-part,.btn-add-product2').show(),

            $('.steps li:last-child').removeClass('onlineShoppingStep'))
        : ($('#onlineShoppingForm ,.online-sale,.offline-part ,.btn-add-product').show(),
            $('.last-content .modal-btn-product ,.btn-onlineShopping ,.upload-part,.btn-add-product2').hide(),
            $('.steps li:last-child').addClass('onlineShoppingStep'))


})

//accordion
let acc = document.getElementsByClassName("fkAccordion");
let i;

for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function () {
        this.classList.toggle("fkActive");
        var panel = this.nextElementSibling;
        if (panel.style.maxHeight) {
            panel.style.maxHeight = null;
            panel.classList.remove('active')
        } else {
            panel.style.maxHeight = panel.scrollHeight + "px";
            panel.classList.add('active')

        }
    });
}

$('body').click(function () {
    let panel = document.getElementsByClassName("fkPanel");
    for (i = 0; i < panel.length; i++) {
        if (panel[i].style.maxHeight) {
            panel[i].style.maxHeight = panel[i].scrollHeight + "px";
        }
    }
})
//select way
$('.way').click(function () {
    $('.wizard-btn').show();
    $('.select-way .form-group').hide();
    $('.select-way .form-group input').val('');
    document.getElementById(Array.from(this.classList)[0]).parentElement.style.display = 'block'
})
let new_product = 0;

//select existed product
$('form').on('click', '.product-list tbody  .select_item', function () {
    //fill fields
    const image = this.firstElementChild.firstElementChild.src;
    const name = $(this).children().eq(1).text().trim();
    const code = $(this).children().eq(2).text().trim();
    const barcode = $(this).children().eq(3).text().trim();
    const id = $(this).attr('id')
    $(`input[name='name']`).val(name)
    $(`input[name='barcode']`).val(barcode)
    $(`input[name='code']`).val(code)

    $(`input[name='name']`).prop('disabled', true);
    $(`input[name='barcode']`).prop('disabled', true);
    $(`input[name='code']`).prop('disabled', true);
    //main image
    $('.selected-product-main-pic ').show();
    $('.selected-product-main-pic img').attr('src', image);
    $('.selected-product-main-pic a').attr('href', image);

    changeWizard(2);
    $.ajax({
        url: "ajax/search-product_v1",
        method: "post",
        data: {product_id: id},
        success: function (data) {
            $("#has_category").html("").append(data);
            $("#no_brand").hide();
            $("#has_category").show();
        }
    });
    $.ajax({
        url: "ajax/product_image",
        method: "post",
        data: {product_id: id},
        success: function (data) {
            $(".gallery-product").html("").append(data);
        }
    });

    $('#otherbarcode').hide();
    $('.product-code').show();
    id2 = id.split("_")[1];
    $(`input[name='id']`).attr("value", id2);
    $('#add-barcode').show()


})


// problem in main image
$('.selected-product-main-pic button').click(function () {
    $('.alert-success').text('درخواست شما بررسی خواهد شد.')
    $(".alert-success").show().delay(5000).fadeOut();
})


//add new product
$('.add-new-product').click(function () {
    new_product = 1;
    $('.selected-product-main-pic').hide()
    $('.selected-product-main-pic').next().hide()
    $(`input[name='name']`).val('')
    $(`input[name='barcode']`).val('')
    $(`input[name='code']`).val('')
    $(`input[name='name']`).prop('disabled', false);
    $(`input[name='barcode']`).prop('disabled', false);
    $(`input[name='code']`).prop('disabled', false);
    $('.product-code').hide();
    $('#add-barcode ').hide()
    $('#otherbarcode').show();
    $("#no_brand").show();
    $("#has_category").hide();
    $(`input[name='id']`).attr("value", 0);
    changeWizard(2)


})


//barcode
$('#add-barcode').click(function () {
    $(this).parent().append('<div class="barcode-group"><i class="fa fa-times"></i><input type="text" class="form-control text-left" name="barcode[]" id=""  placeholder="بارکد" ></div>')
})
$('body').on('click', '.barcode-group i', function () {
    $(this).parent().remove();
})


// 
// تنوع

$('input[type=radio][name=randomRadio]').change(function () {
    $('.table-random').hide()

    $('.random-part').hide();
    if (this.value == 'colorRadio') {
        $('.color-part').show();
        $('#onlineShoppingForm').hide()
    } else if (this.value == 'typeRadio') {
        $('.type-part').show();
        $('#onlineShoppingForm').hide()

    } else if (this.value == 'sizeRadio') {
        $('#onlineShoppingForm').hide()
        $('.size-part').show();
    } else if (this.value == 'noneRadio') {
        $('#onlineShoppingForm').show()

        $('.random-part').hide();
    }
});


let colorCounter = 0;
let sizeCounter = 0;
let typeCounter = 0;

//save color
// $('.saveColor').click()
function saveColorFunc() {

    $('.table-type tbody,.table-size tbody').empty();
    $('.table-type ,.table-size').hide();
    $('.table-color').show()
    $('.table-color tbody').append('<tr></tr>')
    $('.table-color tbody tr:last-child').append(`<td>${$('.color-modal').find('select option:selected').text()}</td>`)

    $('.color-modal').find('input').each(function () {
        if ($(this).attr('type') == 'file') {
            var filename = $(this).val().replace(/^.*[\\\/]/, '');
            $('.table-color tbody tr:last-child').append(`<td><input name="color_${colorCounter}[]" value="${filename}"/></td>`)

        } else if ($(this).attr('type') == 'number' || $(this).attr('ref') == '$hexCode') {
        } else {
            $('.table-color tbody tr:last-child').append(`<td><input name="color_${colorCounter}[]" value="${$(this).val()}"/></td>`)
        }
    })

    colorCounter++;

    $('.table-color tbody tr:last-child').append(`<td><button type="button" class="btn btn-danger btn-square btn-uppercase delete-item-from-table"><i class="ti-trash m-r-5"></i> حذف</button></td>`)
    $('.delete-item-from-table').on('click', function () {
        if ($(this).parent().parent().parent().children()[1] == undefined) {
            $(this).parent().parent().parent().parent().parent().hide();

        }
    })

}

//save type
// $('.saveType').click()
function saveTypeFunc() {
    $('.table-size tbody ,.table-color tbody').empty();
    $('.table-color ,.table-size').hide();

    $('.table-type').show()
    $('.table-type tbody').append('<tr></tr>')

    $('.type-modal').find('input').each(function () {
        if ($(this).attr('type') == 'file') {
            var filename = $(this).val().replace(/^.*[\\\/]/, '');

            $('.table-type tbody tr:last-child').append(`<td><input name="type_${typeCounter}[]" value="${filename}"/></td>`)

        } else
            $('.table-type tbody tr:last-child').append(`<td><input name="type_${typeCounter}[]" value="${$(this).val()}"/></td>`)
    })
    $('.table-type tbody tr:last-child').append(`<td><button type="button" class="btn btn-danger btn-square btn-uppercase delete-item-from-table"><i class="ti-trash m-r-5"></i> حذف</button></td>`)
    $('.delete-item-from-table').on('click', function () {
        if ($(this).parent().parent().parent().children()[1] == undefined) {
            $(this).parent().parent().parent().parent().parent().hide();

        }
    })
    typeCounter++;
}

//save size
// $('.saveSize').click()
function saveSizeFunc() {
    $('.table-color tbody ,.table-type tbody').empty();
    $('.table-color ,.table-type').hide();

    $('.table-size').show()
    $('.table-size tbody').append('<tr></tr>')
    $('.table-size tbody  tr:last-child').append(`<td><input name="size_${sizeCounter}[]" value="${$('.size-modal').find('select option:selected').text()}"/></td>`)

    $('.size-modal').find('input').each(function () {

        $('.table-size tbody  tr:last-child').append(`<td><input name="size_${sizeCounter}[]" value="${$(this).val()}"/></td>`)

    })
    sizeCounter++;
    $('.table-size tbody tr:last-child').append(`<td><button type="button" class="btn btn-danger btn-square btn-uppercase delete-item-from-table"><i class="ti-trash m-r-5"></i> حذف</button></td>`)
    $('.delete-item-from-table').on('click', function () {
        if ($(this).parent().parent().parent().children()[1] == undefined) {

            $(this).parent().parent().parent().parent().parent().hide();

        }
    })

}

//delete breadcrumb
$('.table-random').on('click', 'button', function () {
    $(this).parent().parent().remove();
})


//colorPicker
$('.closeColorPicker').click(function () {
    $('.colorpicker').hide()
})
$('.chooseColor').click(function () {
    $('.colorpicker').show()
})

let picker;
let color = '#ffffff';
const defaults = {
    color: color,
    container: document.getElementById('color_picker'),
    onChange: function (color) {
        updateColor(color);
    },
    swatchColors: ['#D1BF91', '#60371E', '#A6341B', '#F9C743', '#C7C8C4'],
};

function initPicker(options) {
    options = Object.assign(defaults, options);
    picker = new EasyLogicColorPicker(options);
}

function updateColor(value) {
    color = value;
    const $color = document.querySelector('.sample__color');
    const $code = document.querySelector('.sample__code');
    $code.innerText = color;

    $('.chooseColor').val(color)
    $color.style.setProperty('--color', color);
}

function onChangeType(e) {
    picker.setType(e.value);
}

window.onload = function () {
    initPicker();
    updateColor(color);
};


//category


var category2 = [];
var category3 = [];
let count = [0, 0, 0]
$('.category-list').hide()
$('.step1').show()

var flag;
category1.forEach((item) => {

    $('.step1 ul').append(`<li data-cat=${item['id']} id=${count[0]}>${item['title']}</li>`)
    count[0]++;
})

$('body').on('click', '.step1 li', function () {
console.log('cat',$(this).data('cat'))
    $.ajax({
        url: 'ajax/get_category',
        method: 'post',
        data: {data: $(this).data('cat'), type: 2},
        dataType: "JSON",
        error: function (requestObject, error, errorThrown) {
            console.log(error);
            console.log(errorThrown);
        },
        success: function (data) {
          console.log(data)
            category2 = data;
            category2.forEach((item) => {
                $('.step2 ul').html('').append(`<li data-cat=${item['id']} id=${count[1]}>${item['title']}</li>`)
                count[1]++;
            })
            $('.step1').hide();
            $('.step2').show();
        }
    });
    $('.selected-category ul').append(`<li>${$(this).text().trim()}</li>`)
})

$('body').on('click', '.step2 li', function () {

    $.ajax({
        url: 'ajax/get_category',
        method: 'post',
        data: {data: $(this).data('cat'), type: 3},
        dataType: "JSON",
        error: function (requestObject, error, errorThrown) {
            console.log(error);
            console.log(errorThrown);
        },
        success: function (data) {
            category3 = data;

            category3.forEach((item) => {
                $('.step3 ul').html('').append(`<li data-cat=${item['id']} id=${count[2]}>${item['title']}</li>`)
                count[2]++;
            })
            $('.step2').hide();
            $('.step3').show();
        }
    });
    $('.selected-category ul').append(`<li>${$(this).text().trim()}</li>`)
})


$('body').on('click', '.step3 li', function () {
    // $('.step3').hide();
    // $('.chooseBrand').show();
    if (flag == 0) {
        $('.selected-category ul').append(`<li data-cat=${$(this).data('cat')} >${$(this).text().trim()}</li>`)
        flag = 1;
    }
    $('.saveCategory').prop('disabled', false)
    // $('.saveCategory').click()
    $('.saveCategory').prop('disabled', false);
})


function changeCategoryList(index) {
    if (index != 3) {
        const lists = document.querySelectorAll('.category-list')
        lists[index].style.display = 'none';
        lists[index - 1].style.display = 'block';
        count[index] = 0;
        $(`.step${index + 1} ul`).empty()
    } else {
        // $('.step3').show();
        // $('.chooseBrand').hide();
    }

    switch (index) {

        case 1 :
            $('.selected-category ul').empty()
            $('.saveCategory').prop('disabled', true)

        case 2 :
            $('.selected-category ul').children().eq(2).remove()
            $('.saveCategory').prop('disabled', true)

        case 3 :
            $('.selected-category ul li:last-of-type').remove()
            $('.saveCategory').prop('disabled', false)


        default:
            break;
    }
}


$('.saveCategory').click(function () {
    $('.category-breadcrumb').append('<ul></ul>')
    $('.category-breadcrumb ul:last-child').append(`<button type="button" class="btn btn-danger btn-floating"><i class="ti-trash"></i></button>`)
    let i = 0
    $('.selected-category ul').find('li').each(function () {
        i++
        if (i == 3)
            $('.category-breadcrumb ul:last-child').append(`<li>${$(this).text()}</li><input type="hidden" name="category[]" value="${$(this).data('cat')}"/>`)
        else
            $('.category-breadcrumb ul:last-child').append(`<li>${$(this).text()}</li>`)
    })
    if ($('input[name="brand"]').val().trim() !== '') {
        $('.category-breadcrumb ul:last-child').append(`<li>${$('input[name="brand"]').val()}</li>`)
    }
})

$('.category-breadcrumb').on('click', 'button', function () {
    $(this).parent().remove()
})


$('.category-button').click(function () {
    $('.category-list').hide()
    $('.step1').show();
    flag = 0;
    $('.saveCategory').prop('disabled', true);
    $('input[name="brand"]').val('')
    $('#addBrand').hide();
    $('.selected-category ul').empty()
    $('.chooseBrand').hide();
})


//add feature
$('.add-feature button').click(function () {

    if ($('.add-feature input').val().trim() !== '') {
        $('.add-feature ul:last-child').append(`<li><button type="button" class="btn btn-danger btn-floating"><i class="fa fa-times"></i></button> <input name="feature[]" value="${$('.add-feature input').val()}" /></li>`)
        $('.add-feature input:first-child').val('')
    }


})
//delete feature
$(document).on('click', '.add-feature li button', function () {
    $(this).parent().remove()
})


// hosein erfani edited from here to end of this file
let btn_submit = $('#btn-submit');
let goods_barcode = $('#goods-barcode');
let goods_other_barcode = $('#goods-other-barcode');
let goods_name = $('#goods-name');
let goods_code = $('#goods-code');
let goods_categories = $('#goods-categories');
let cat_btn = $('#cat-btn');
let guild = $('#guild'); //select option 'senf'
let select_brand = $('#select_brand'); //select option 'brand'

let add_new_brand = $('#brand-2'); // input
let brand_exists = $('#exist'); // brand already exists
let brand_save = $('#save'); // brand is ok
let add_new_brand_modal = $('#add-new-brand-modal'); // add new brand in modal

let onlineShopping = $('#onlineShopping');//checkbox

let first_period_inventory = $('#first-period-inventory');
let shopping_price = $('#shopping-price');
let price = $('#price');//selling price
let online_price = $('#online_price');
let next_page_btn = $('#next-page-btn');
let addproduct_submit_btn = $('#addproduct-submit-btn');
let product_pic = $('#product-pic');
let product_pic_2 = $('#product-pic-2');


let noneRadio = $('#noneRadio');


// tables
let table_color = $('.table-color')[0]
let table_type = $('.table-type')[0]
let table_size = $('.table-size')[0]

let radio_color = $('#colorRadio');
let radio_type = $('#typeRadio');
let radio_size = $('#sizeRadio');


$('#product-info  input').on('change keyup click', function () {
    inputValidation($(this));
})

function inputValidation(elem) {
    if (elem.prop("disabled") == true) {
        elem.removeClass("is-valid");
        elem.removeClass("is-invalid");
    } else if (elem.val() == "" && elem.attr('id') != "goods-other-barcode" && elem.attr('id') != "goods-barcode"
        && elem.attr('id') != "addcolor_modal_barcode" && elem.attr('id') != "addtype_modal_barcode" && elem.attr('id') != "addsize_modal_barcode") {
        elem.removeClass("is-valid");
        elem.addClass("is-invalid");
    } else {
        if (elem.attr('id') != "goods-other-barcode" && elem.attr('id') != "goods-barcode"
            && elem.attr('id') != "addcolor_modal_barcode" && elem.attr('id') != "addtype_modal_barcode" && elem.attr('id') != "addsize_modal_barcode") {
            elem.addClass("is-valid");
            elem.removeClass("is-invalid");
        }
    }
}

function numberValidation(elem) {
    if (elem.prop("disabled") == true) {
        elem.removeClass("is-valid");
        elem.removeClass("is-invalid");
    } else if (elem.val() == 0) {
        elem.removeClass("is-valid");
        elem.addClass("is-invalid");
    } else {
        elem.addClass("is-valid");
        elem.removeClass("is-invalid");
    }
}

function removeValidation(elems) {
    elems.each(function () {
        $(this).removeClass("is-valid");
        $(this).removeClass("is-invalid");

    })

}


add_new_brand_modal.on('click', catValidation);
goods_categories.on('click', catValidation);


function catValidation() {
    if (goods_categories.children()[0] == undefined) {
        cat_btn.removeClass("is-valid");
        cat_btn.addClass("is-invalid");
    } else {
        cat_btn.addClass("is-valid");
        cat_btn.removeClass("is-invalid");
    }
}

function selectValidation(select) {
    // console.log(select.val())
    if (select.val() == -1) {
        select.removeClass("is-valid");
        select.addClass("is-invalid");
    } else {
        select.addClass("is-valid");
        select.removeClass("is-invalid");
    }
}


guild.on('click', function () {
    selectValidation($(this));
})

next_page_btn.on('click', function (e) {
    e.preventDefault();
    goNext()
})
addproduct_submit_btn.on('click', function (e) {
        e.preventDefault();
        goNext();
    }
)

function goNext() {


    let inputs = $('#product-id input');

    // inputValidation(goods_other_barcode);
    inputValidation(goods_name);

    inputValidation(shopping_price);
    inputValidation(price);
    inputValidation(online_price);
    // numberValidation(first_period_inventory);

    if (goods_categories.children()[0] == undefined) {
        cat_btn.removeClass("is-valid");
        cat_btn.addClass("is-invalid");
    }

    selectValidation(guild)


    // if (goods_other_barcode.val() == "" && goods_code.val() == "") {
    //     toastr.error("لطفا بارکد ایران را در مشخصات محصول وارد کنید", "خطا")
    //
    // } else {

    if (goods_name.val() == "" && !goods_name.prop("disabled")) {
        toastr.error("لطفا نام محصول را در مشخصات محصول وارد کنید", "خطا")

    } else {
        if (goods_categories.children()[0] == undefined && new_product == 0) {
            toastr.error("لطفا حداقل یک دسته بندی از  قسمت دسته بندی انتخاب کنید", "خطا")
        } else {
            if (guild.val() == -1 && !goods_barcode.prop('disabled')) {
                toastr.error("لطفا صنف را از  قسمت دسته بندی انتخاب کنید", "خطا")
            } else {
                if (select_brand.val() == -1 && add_new_brand.val() == '' && !goods_barcode.prop("disabled")) {
                    toastr.error("لطفا یک برند را از  قسمت دسته بندی انتخاب کنید و یا یک برند به ثبت برسانید", "خطا")
                } else {
                    if (!(brand_save.is(':visible')) && !(brand_exists.is(':visible')) && add_new_brand.val() != "" && !goods_barcode.prop("disabled")) {
                        toastr.warning("لطفا دکمه چک را بزنید", "خطا")
                    } else if (brand_exists.is(':visible') && add_new_brand.val() != "" && !goods_barcode.prop("disabled")) {
                        toastr.error("این برند موجود است", "خطا")

                    } else {
//radio
                        if (radio_color.prop('checked') && $('.table-color tbody').children().length == 0) {
                            toastr.error("حداقل یک مورد رنگ تعریف کنید", "خطا")
                        } else {

                            if (radio_type.prop('checked') && $('.table-type tbody').children().length == 0) {
                                toastr.error("حداقل یک مورد طرح تعریف کنید", "خطا")
                            } else {

                                if (radio_size.prop('checked') && $('.table-size tbody').children().length == 0) {
                                    toastr.error("حداقل یک مورد سایز تعریف کنید", "خطا")
                                } else {


                                    // if (first_period_inventory.val() == 0 && noneRadio.prop('checked')) {
                                    //     toastr.error("موجودی اول دوره باید بالاتر از صفر باشد", "خطا")
                                    //
                                    // } else {
                                    if (shopping_price.val() == '' && noneRadio.prop('checked')) {
                                        toastr.error("قیمت خرید را وارد کنید در بخش موجودی اول دوره", "خطا")

                                    } else {
                                        if (price.val() == '' && noneRadio.prop('checked')) {
                                            toastr.error("قیمت فروش را وارد کنید در بخش موجودی اول دوره", "خطا")

                                        } else {
                                            if (online_price.val() == '' && onlineShopping.prop('checked') && noneRadio.prop('checked')) {
                                                toastr.error("قیمت فروش انلاین را وارد کنید در بخش موجودی اول دوره", "خطا")

                                            } else {
                                                // if (product_pic.val() == "" && onlineShopping.prop('checked')) {
                                                //     toastr.error("لطفا عکس محصول را وارد کنید", "خطا")
                                                // } else
                                                if (product_pic_2.val() == "" && onlineShopping.prop('checked')) {
                                                    toastr.error("لطفا عکس محصول را وارد کنید", "خطا")
                                                } else {

                                                    if (onlineShopping.prop('checked')) {
                                                        changeWizard(3)

                                                    } else {
                                                        console.log('done')
                                                        btn_submit.click();

                                                    }
                                                }
                                            }
                                        }
                                    }
                                    // }


                                }

                            }

                        }
                    }
                }
            }
            // }

        }
    }
}


//add color modal validaion
let addcolor_modal_btn = $('#addcolor-modal-btn');

let addcolor_modal_barcode = $('#addcolor_modal_barcode');
let addcolor_modal_color = $('#addcolor_modal_color');
let addcolor_modal_colorname = $('#addcolor_modal_colorname');
let addcolor_modal_colorimg = $('#addcolor_modal_colorimg');
let addcolor_modal_buyingprice = $('#addcolor_modal_buyingprice');
let addcolor_modal_sellingprice = $('#color_price');
let addcolor_modal_onlinesellingprice = $('#color_online_price');
let addcolor_modal_inventory = $('#addcolor_modal_inventory');
let addcolor_img = $('#addcolor-img');

addcolor_modal_btn.on('click', function (e) {
    e.preventDefault();

    inputValidation(addcolor_modal_color);
    inputValidation(addcolor_modal_colorname);
    inputValidation(addcolor_modal_colorimg);
    inputValidation(addcolor_modal_buyingprice);
    inputValidation(addcolor_modal_sellingprice);
    inputValidation(addcolor_modal_onlinesellingprice);
    numberValidation(addcolor_modal_inventory);

    // toastr.error("", "خطا")


    if (addcolor_modal_color.val() == '') {
        toastr.error("لطفا رنگ را وارد کنید", "خطا")

    } else {
        if (addcolor_modal_colorname.val() == '') {
            toastr.error("لطفا اسم رنگ را وارد کنید", "خطا")

        } else {
            if (addcolor_modal_colorimg.val() == '') {
                toastr.error("لطفا تصویر رنگ را وارد کنید", "خطا")

            } else {
                if (addcolor_modal_buyingprice.val() == '') {
                    toastr.error("لطفا قیمت خرید را وارد کنید", "خطا")

                } else {
                    if (addcolor_modal_sellingprice.val() == '') {
                        toastr.error("لطفا قیمت فروش را وارد کنید", "خطا")

                    } else {
                        if (addcolor_modal_onlinesellingprice.val() == '' && onlineShopping.prop('checked')) {
                            toastr.error("لطفا قیمت فروش انلاین را وارد کنید", "خطا")

                        } else {
                            if (addcolor_modal_inventory.val() == 0) {
                                toastr.error("موجودی باید بالای صفر باشد", "خطا")
                            } else {


                                saveColorFunc($());
                                document.querySelector('.color-modal .close').click()
                                // $("#color-modal .close").click()
                                // $('.modal-backdrop').remove();
                            }

                        }

                    }
                }
            }
        }
    }


})

$('#btn-addcolor').on('click', function () {
    addcolor_modal_barcode.val('');
    addcolor_modal_color.val('#efefef');
    addcolor_modal_colorname.val('');
    addcolor_modal_colorimg.val('');
    addcolor_modal_buyingprice.val('');
    addcolor_modal_sellingprice.val('');
    addcolor_modal_onlinesellingprice.val('');
    addcolor_modal_inventory.val();
    addcolor_img.attr('src', './public/media/uploadImage.jpg');
    $('.btn-outline-danger.btn-floating').hide();
    removeValidation($('#color-modal  input'));
})
$('#first-period-sec input[type=text]:not([readonly])').on('change keyup click', function () {
    inputValidation($(this));
})
first_period_inventory.on('change keyup click ', function () {
    numberValidation($(this));
})
$('.first-period-plus-minus').on('click', function () {
    numberValidation(first_period_inventory);
})
addcolor_modal_colorimg.on('change keyup click', function () {
    inputValidation($(this));
})
$('#color-modal  input[type="text"]').on('change keyup click', function () {
    inputValidation($(this));
})
$('.addcolor-plus-minus').on('click', function () {
    numberValidation(addcolor_modal_inventory);
})
addcolor_modal_inventory.on('change keyup click', function () {
    numberValidation($(this));
})


//add type modal validaion
let addtype_modal_btn = $('#addtype-modal-btn');

let addtype_modal_barcode = $('#addtype_modal_barcode');
let addtype_modal_typename = $('#addtype_modal_typename');
let addtype_modal_typeimg = $('#addtype_modal_typeimg');
let addtype_modal_buyingprice = $('#addtype_modal_buyingprice');
let addtype_modal_sellingprice = $('#theme_price');
let addtype_modal_inventory = $('#addtype_modal_inventory');
let addtype_modal_onlinesellingprice = $('#theme_online_price');
let addtype_img = $('#addtype-img');

addtype_modal_btn.on('click', function (e) {
    e.preventDefault();


    inputValidation(addtype_modal_typename);
    inputValidation(addtype_modal_typeimg);
    inputValidation(addtype_modal_buyingprice);
    inputValidation(addtype_modal_sellingprice);
    inputValidation(addtype_modal_onlinesellingprice);
    numberValidation(addtype_modal_inventory);


    if (addtype_modal_typename.val() == '') {
        toastr.error("لطفا نام طرح را وارد کنید", "خطا")

    } else {
        if (addtype_modal_typeimg.val() == '') {
            toastr.error("لطفا تصویر طرح را وارد کنید", "خطا")

        } else {
            if (addtype_modal_buyingprice.val() == '') {
                toastr.error("لطفا قیمت خرید را وارد کنید", "خطا")

            } else {
                if (addtype_modal_sellingprice.val() == '') {
                    toastr.error("لطفا قیمت فروش را وارد کنید", "خطا")

                } else {
                    if (addtype_modal_onlinesellingprice.val() == '' && onlineShopping.prop('checked')) {
                        toastr.error("لطفا قیمت فروش انلاین را وارد کنید", "خطا")

                    } else {
                        if (addtype_modal_inventory.val() == 0) {
                            toastr.error("موجودی باید بالای صفر باشد", "خطا")
                        } else {

                            saveTypeFunc();
                            document.querySelector('.type-modal .close').click()
                            // $("#type-modal .close").click()
                            // $('.modal-backdrop').remove();
                        }

                    }

                }
            }
        }

    }


})

$('#btn-addtype').on('click', function () {
    addtype_modal_barcode.val('');
    addtype_modal_typename.val('');
    addtype_modal_typeimg.val('');
    addtype_modal_buyingprice.val('');
    addtype_modal_sellingprice.val('');
    addtype_modal_onlinesellingprice.val('');
    addtype_modal_inventory.val();
    addtype_img.attr('src', './public/media/uploadImage.jpg');
    $('.btn-outline-danger.btn-floating').hide();
    removeValidation($('#type-modal  input'));

})

$('#type-modal  input[type="text"]').on('change keyup click', function () {
    inputValidation($(this));
})
$('.addtype-plus-minus').on('click', function () {
    numberValidation(addtype_modal_inventory);
})
addtype_modal_inventory.on('change keyup click', function () {
    numberValidation($(this));
})

//add size modal validaion
let addsize_modal_btn = $('#addsize-modal-btn');

let addsize_modal_barcode = $('#addsize_modal_barcode');
let addsize_modal_size = $('#addsize_modal_size');//select
let addsize_modal_buyingprice = $('#addsize_modal_buyingprice');
let addsize_modal_sellingprice = $('#size_price');
let addsize_modal_onlinesellingprice = $('#size_online_price');
let addsize_modal_inventory = $('#addsize_modal_inventory');

addsize_modal_btn.on('click', function (e) {
    e.preventDefault();


    selectValidation(addsize_modal_size);
    inputValidation(addsize_modal_buyingprice);
    inputValidation(addsize_modal_sellingprice);
    inputValidation(addsize_modal_onlinesellingprice);

    numberValidation(addsize_modal_inventory);


    if (addsize_modal_size.val() == '-1') {
        toastr.error("لطفا سایز را وارد کنید", "خطا")

    } else {
        if (addsize_modal_buyingprice.val() == '') {
            toastr.error("لطفا قیمت خرید را وارد کنید", "خطا")

        } else {
            if (addsize_modal_sellingprice.val() == '') {
                toastr.error("لطفا قیمت فروش را وارد کنید", "خطا")

            } else {
                if (addsize_modal_onlinesellingprice.val() == '' && onlineShopping.prop('checked')) {
                    toastr.error("لطفا قیمت فروش انلاین را وارد کنید", "خطا")

                } else {
                    if (addsize_modal_inventory.val() == 0) {
                        toastr.error("موجودی باید بالای صفر باشد", "خطا")
                    } else {

                        saveSizeFunc();
                        document.querySelector('.size-modal .close').click()
                        // $("#size-modal .close").click()
                        // $('.modal-backdrop').remove();
                    }

                }

            }

        }

    }


})

$('#btn-addsize').on('click', function () {
    addsize_modal_barcode.val('');
    addsize_modal_size.val('-1');
    addsize_modal_buyingprice.val('');
    addsize_modal_sellingprice.val('');
    addsize_modal_onlinesellingprice.val('');
    addsize_modal_inventory.val();
    removeValidation($('#size-modal  input'));
    removeValidation($('#size-modal  select'));
})

$('#size-modal  input[type="text"]').on('change keyup click', function () {
    inputValidation($(this));
})

addsize_modal_inventory.on('change keyup click', function () {
    numberValidation($(this));
})

$('.addsize-plus-minus').on('click', function () {
    numberValidation(addsize_modal_inventory);
})

$('#size-modal  select').on('change keyup click', function () {
    selectValidation($(this));
})


let final_submit_btn = $('#final-submit-btn');
let discription = $('#discription');
let properties = $('#properties');
let properties_ul = $('#properties-ul');
discription.on('change keyup click', function () {
    inputValidation($(this));
})


final_submit_btn.on('click', function (e) {
    // e.preventDefault();
    inputValidation(discription)
    // inputValidation(properties)
    if (properties_ul.children()[0] == undefined) {
        properties.removeClass("is-valid");
        properties.addClass("is-invalid");
    } else {
        properties.addClass("is-valid");
        properties.removeClass("is-invalid");
    }

    if (discription.val() == "") {
        toastr.error("لطفا توضیحات محصول را وارد کنید", "خطا")

    } else {
        if (properties_ul.children()[0] == undefined) {
            toastr.error("لطفا ویژگی های محصول را وارد کنید", "خطا")

        } else {
            btn_submit.click();
        }
    }
})


