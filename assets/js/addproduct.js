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







