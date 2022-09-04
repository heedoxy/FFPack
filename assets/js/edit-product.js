
    
    //wizard
    const wizardContents = document.querySelectorAll('.wizard-content')
    const wizardSteps = document.querySelectorAll('.steps li')
    const wizardStepsSpan = document.querySelectorAll('.steps li span')

    $('.wizard-content').hide()
    wizardContents[0].style.display = 'block';

    function changeWizard(index){
        $('.wizard-content').hide()
        $('.steps li').removeClass('active')
        $('.steps li span').removeClass('active') 
        wizardContents[index].style.display = 'block';
        wizardSteps[index].classList.add('active');
        $(wizardContents[index]).show();
        wizardStepsSpan[index].classList.add('active');
    }
    // 

    $('.change-name').click(function(){
        $('.wizard-content').hide()
        $('.steps li').removeClass('active')
        $('.steps li span').removeClass('active') 
        wizardContents[0].style.display = 'block';
        wizardSteps[0].classList.add('active');
        $(wizardContents[0]).show();
        wizardStepsSpan[0].classList.add('active');
    })




    // hosein erfani edited
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
    $('form').on('click' ,'.main-pic a' ,function(){
        if($(this).parent().parent().hasClass('upload-image')){
            $(this).parent().remove()
        }
        this.previousElementSibling.src = './public/media/uploadImage.jpg';
        $(this).hide()
    })

    //delete video
    $('form').on('click' ,'.upload-video a' ,function(){
        console.log($(this))
        $(this).parent().children().eq(1).hide();
        $(this).parent().children().eq(2).show();
        $(this).hide()
    })

    //counter
    $('.count-product a').click(function(){
        let count = Number($(this).parent().children().eq(1).val());

        if(this.textContent == '+'){
            count++;
            this.nextElementSibling.value=count;
        }else{
            count>0 ?  this.previousElementSibling.value=(count-1) : ''

        }
    })



    //new brand
    $('#newBrand').click(function(){
        if( $('.brands-list option:selected').val() == -1){
           
        }else{
            $('.brands-list').val('-1');
            $(".brands-list").select2().select2('val','-1');
            // $('.alert-modal').text('شما نام برند را انتخاب کرده اید.')
            // $(".alert-modal").show().delay(5000).fadeOut();
        }
        $('#addBrand').show()
        $('#addBrand input').val('')
        
    })
    $('.brands-list').change(function(){
        if($('.brands-list option:selected').val() != 0){
            $('#addBrand').hide()
            $('#addBrand input').val('')    
        }
    })



    // hosein erfani edited
    //Random
    $('.btn-onlineShopping').hide()
    $('.last-content .modal-btn-product').hide()


    $('#onlineShopping').is(':checked') ? ($('#onlineShoppingForm,.online_sale,.offline-part ,.btn-add-product').hide(),
    $('.last-content .modal-btn-product ,.btn-onlineShopping ,.upload-part,.btn-add-product2').show(),

     $('.steps li:last-child').removeClass('onlineShoppingStep'))
     : ($('#onlineShoppingForm ,.online-sale,.offline-part ,.btn-add-product').show(),
     $('.last-content .modal-btn-product ,.btn-onlineShopping ,.upload-part,.btn-add-product2').hide(),
     $('.steps li:last-child').addClass('onlineShoppingStep'))


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
      acc[i].addEventListener("click", function() {
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

    $('body').click(function(){
        let panel = document.getElementsByClassName("fkPanel");
        for (i = 0; i < panel.length; i++) {
            if (panel[i].style.maxHeight) {
                panel[i].style.maxHeight = panel[i].scrollHeight + "px";
            } 
           }
    })
    //select way
    $('.way').click(function(){
        $('.wizard-btn').show();
        $('.select-way .form-group').hide();
        $('.select-way .form-group input').val('');
        document.getElementById(Array.from(this.classList)[0]).parentElement.style.display='block'    
    })


    //select existed product 
    $('form').on('click' ,'.product-list tbody tr',function(){
        //fill fields
        const image = this.firstElementChild.firstElementChild.src;
        const name = $(this).children().eq(1).text().trim();
        const code = $(this).children().eq(2).text().trim();
        const barcode = $(this).children().eq(3).text().trim();
        $(`input[name='name']`).val(name)
        $(`input[name='barcode']`).val(barcode)
        $(`input[name='code']`).val(code)
        
        $(`input[name='name']`).prop('disabled', true);
        $(`input[name='barcode']`).prop('disabled', true);
        $(`input[name='code']`).prop('disabled', true);

        //main image
        $('.selected-product-main-pic ').show();
        $('.selected-product-main-pic img').attr('src' ,image);
        $('.selected-product-main-pic a').attr('href' ,image);


        changeWizard(2)
        $('.product-code').hide();
        $('#add-barcode').hide()

        
    })  



    // problem in main image
    $('.selected-product-main-pic button').click(function(){
        $('.alert-success').text('درخواست شما بررسی خواهد شد.')
        $(".alert-success").show().delay(5000).fadeOut();
    })


    


    //add new product
    $('.add-new-product').click(function(){
        $('.selected-product-main-pic').hide()
        $('.selected-product-main-pic').next().hide()
        $(`input[name='name']`).val('')
        $(`input[name='barcode']`).val('')
        $(`input[name='code']`).val('')
        $(`input[name='name']`).prop('disabled', false);
        $(`input[name='barcode']`).prop('disabled', false);
        $(`input[name='code']`).prop('disabled', false);
        $('.product-code').show();
        $('#add-barcode ').show()
        changeWizard(2)

        
    })



    //barcode
    $('#add-barcode').click(function(){
        $(this).parent().append('<div class="barcode-group"><i class="fa fa-times"></i><input type="text" class="form-control text-left" name="barcode[]" id=""  placeholder="بارکد" ></div>')
    })
    $('body').on('click' , '.barcode-group i',function(){
        $(this).parent().remove();
    })
 
    
// 


//category

const category1 = [  'دسته شماره سه' ,'دسته شماره دو' , 'دسته شماره یک','دسته 4' , 'دسته 3' ,'دسته 1' , 'دسته 2']
const category2 = ['دسته8 ' , 'دسته7' ,'دسته شماره شش' , 'دسته 5']
const category3 = ['دسته 9 ' , 'دسته 10' ,'دسته 11' , 'دسته 12']
 
let count = [0 ,0 ,0]
$('.category-list').hide()
$('.step1').show()
category1.forEach((item)=>{
    
    $('.step1 ul').append(`<li id=${count[0]}>${item}</li>`)
    count[0]++;
})

$('body').on('click' , '.step1 li' , function(){
    $('.step1').hide();
    $('.step2').show();
    $('.selected-category ul').append(`<li>${$(this).text().trim()}</li>`)
    category2.forEach((item)=>{
        $('.step2 ul').append(`<li id=${count[1]}>${item}</li>`)
        count[1]++;
    })  
})

$('body').on('click' , '.step2 li' , function(){

    $('.step2').hide();
    $('.step3').show();
    $('.selected-category ul').append(`<li>${$(this).text().trim()}</li>`)
    category3.forEach((item)=>{
        $('.step3 ul').append(`<li id=${count[2]}>${item}</li>`)
        count[2]++;

    })
    
})

$('body').on('click' , '.step3 li' , function(){
    // $('.step3').hide();
    // $('.chooseBrand').show();
    $('.selected-category ul').append(`<li>${$(this).text().trim()}</li>`)
    $('.saveCategory').prop('disabled' ,false)
    // $('.saveCategory').click()
})



function changeCategoryList(index){
    if(index != 3){
        const lists = document.querySelectorAll('.category-list')
        lists[index].style.display ='none';
        lists[index-1].style.display ='block';
        count[index] = 0;
        $(`.step${index+1} ul`).empty()
    }else{
        // $('.step3').show();
        // $('.chooseBrand').hide();
    }

    switch (index) {
        
        case 1 : 
             $('.selected-category ul').empty()
             $('.saveCategory').prop('disabled' ,true)

        case 2 : 
             $('.selected-category ul').children().eq(2).remove()
             $('.saveCategory').prop('disabled' ,true)

        case 3 : 
             $('.selected-category ul li:last-of-type').remove()
             $('.saveCategory').prop('disabled' ,false)


        default:
            break;
    }
}


$('.saveCategory').click(function(){
    $('.category-breadcrumb').append('<ul></ul>')
    $('.category-breadcrumb ul:last-child').append(`<button type="button" class="btn btn-danger btn-floating"><i class="ti-trash"></i></button>`)

    $('.selected-category ul').find('li').each(function(){
        $('.category-breadcrumb ul:last-child').append(`<li>${$(this).text()}</li>`)
    })
    if($('input[name="brand"]').val().trim() !== ''){
        $('.category-breadcrumb ul:last-child').append(`<li>${$('input[name="brand"]').val()}</li>`)
    }
})

$('.category-breadcrumb').on('click' ,'button' ,function(){
    $(this).parent().remove()
})


$('.category-button').click(function(){
    $('.category-list').hide()
    $('.step1').show();
    $('input[name="brand"]').val('')
    $('#addBrand').hide();
    $('.selected-category ul').empty()
    $('.chooseBrand').hide();
})




//add feature
$('.add-feature button' ).click(function(){
     
    if($('.add-feature input').val().trim() !== ''){
        $('.add-feature ul:last-child').append(`<li><button type="button" class="btn btn-danger btn-floating"><i class="fa fa-times"></i></button> <input name="feature[]" value="${$('.add-feature input').val()}" /></li>`)
        $('.add-feature input:first-child').val('')
    }

  
})
//delete feature
$(document).on('click','.add-feature li button',function(){
    $(this).parent().remove()
})