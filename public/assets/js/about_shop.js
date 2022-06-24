    //images
    $('form').on('change', 'input[type="file"]', function(){
        if (this.files && this.files[0]) {

           this.nextElementSibling.src = URL.createObjectURL(this.files[0]);
           

           if($(this).next().is('img')){
               $(this).next().next().show();

               if(wizardContents[2].style.display == 'block'){
                   $('.upload-image').append('<div class="main-pic appended-pic"><input type="file" /><img  src="./public/media/uploadImage.jpg"><a  class="btn btn-outline-danger btn-floating"><i class="ti-trash"></i></a></div>')
               }

           }else{
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
