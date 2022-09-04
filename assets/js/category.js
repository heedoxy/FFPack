//category

// const category1 = [  'دسته شماره سه' ,'دسته شماره دو' , 'دسته شماره یک','دسته 4' , 'دسته 3' ,'دسته 1' , 'دسته 2']
// const category2 = ['دسته8 ' , 'دسته7' ,'دسته شماره شش' , 'دسته 5']
// const category3 = ['دسته 9 ' , 'دسته 10' ,'دسته 11' , 'دسته 12']
const category1 = [ 'کتاب، لوازم تحریر، هنر']
const category2 = ['لوازم التحریر']
const category3 = ['نوشت افزار']
 
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
 
 