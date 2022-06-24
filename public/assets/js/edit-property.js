$(document).ready(function(){
    let e;
       $(".closeColorPicker").click(function(){
        $(".colorpicker").hide()}),$(".chooseColor").click(function(){
            $(".colorpicker").show()
        });
        let t="#ffffff";
        const i={color:t,container:document.getElementById("color_picker"),onChange:function(e){n(e)},swatchColors:["#D1BF91","#60371E","#A6341B","#F9C743","#C7C8C4"]};
        function n(e){
            let=e;
            const i=document.querySelector(".sample__color");
            document.querySelector(".sample__code").innerText=t,$(".chooseColor").val(t),i.style.setProperty("--color",t)
        }
        window.onload=function(){
            var o;
            o=Object.assign(i,o),e=new EasyLogicColorPicker(o),n(t)
        }
        ,$("form").on("change",'input[type="file"]',function(){
            this.files&&this.files[0]&&(this.nextElementSibling.src=URL.createObjectURL(this.files[0])
            ,$(this).next().is("img")?($(this).next().next().show()
            ,"block"==wizardContents[2].style.display&&$(".upload-image").append('<div class="main-pic appended-pic"><input type="file" /><img  src="./public/media/uploadImage.jpg"><a  class="btn btn-outline-danger btn-floating"><i class="ti-trash"></i></a></div>')):($(this).next().show(),$(this).next().next().hide(),$(this).next().next().next().show())),$("body").click()})
            ,$("form").on("click",".main-pic a",function(){$(this).parent().parent().hasClass("upload-image")&&$(this).parent().remove()
            ,this.previousElementSibling.src="./public/media/uploadImage.jpg",$(this).hide()
        }),$(".count-product a").click(function(){let e=Number($(this).parent().children().eq(1).val());
    "+"==this.textContent?(e++,this.nextElementSibling.value=e):e>0&&(this.previousElementSibling.value=e-1)})});