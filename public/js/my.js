// Ajax @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
$.ajaxSetup({
    headers:{
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    
}) 
function cartAjaxDataAll(){
    $.ajax({
        type:"GET",
        dataType:"json",
        url:'/cartAjaxDataAll',
        success:function(Response){
            var data = "";
            $.each(Response,function(key,value){
             data = data + "<tr>";
             data = data + "<td class='cart-pic first-row'>"+"<a href='"+"/product/"+value.productId+"'>" +"<img src='/ProductImages/"+value.productImage+"' alt='cart-product'>" + "</a>" + "</td>";
             data = data +  "<td class='cart-pic first-row'>"+"<a href='"+"/product/"+value.productId+"'>"+value.productName+ "</a>" + "</td>";
              data = data +    "<td class='p-price first-row'>"+value.productPrice + "&#2547;"+"</td>"  ;
              data = data +  "<td class='qua-col first-row'>"+ value.   productQuantity+
                             "</td>" ;
              
             data = data + "<td class='total-price first-row'>"+value.productTotalPrice + "&#2547;"+"</td>"
             data = data + "<td onclick='deleteData("+value.id+")' class='close-td first-row'>" + "<i class='ti-close'>" + "</i>" + "</td>"                          
           
             data = data + "</tr>";
            });
            $('tbody').html(data);

        }

    });
}
cartAjaxDataAll();
function cartAjaxTotalPriceAll(){
    $.ajax({
        type:"GET",
        dataType:"json",
        url:'/cartAjaxTotalPriceAll',
        success:function(Response){
            var data = "";
            $.each(Response,function(key,value){
             data = data +  "<li class='cart-total'>" +"Total"+ "<span>"+ value.total  + "&#2547;"+"</span>" + "</li>"
             
            }
            
            );
            $('#totalFinal').html(data);

        }

    });
}
cartAjaxTotalPriceAll();
function  deleteData(id){
 $.ajax({
        type:"POST",
        dataType:"json",
        data:{id:id},
        url:'/cartAjaxDataDelete/'+id,
        success:function(data){
         cartAjaxDataAll();
         cartAjaxTotalPriceAll();
         cartAjaxDataAllIndex();
         cartAjaxTotalPriceAllIndex();
        }
       
        


    });
}
// Index Page Ajax @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
function cartAjaxDataAllIndex(){
    $.ajax({
        type:"GET",
        dataType:"json",
        url:'/cartAjaxDataAll',
        success:function(Response){
            var data = "";
            $.each(Response,function(key,value){
             data = data + "<tr>";
             data = data + "<td class='si-pic'>"+"<a href='"+"/product/"+value.productId+"'>" +"<img style='max-width:70px;' class='img img-fluid' src='/ProductImages/"+value.productImage+"' alt='Product'>"+ "</a>"+"</td>";
             data = data +  "<td class='si-text'>" +
                                                 "<div class='product-selected'>" +
                                                 "<p>"+value.productPrice + "&#2547;"+"</p>" +
                                                     "<h6>" +value.productName+"</h6>" +
                                                 "</div>" +
                                             "</td>";
               data = data +  "<td onclick='deleteData("+value.id+")' class='si-close'>"+
                                                 "<i class='ti-close'>" + "</i>" +
                                             "</td>"
             data = data + "</tr>";
            });
            $('#headerCart').html(data);

        }

    });
}
cartAjaxDataAllIndex();
//    total Price
function cartAjaxTotalPriceAllIndex(){
    $.ajax({
        type:"GET",
        dataType:"json",
        url:'/cartAjaxTotalPriceAll',
        success:function(Response){
            var data = "";
            $.each(Response,function(key,value){
            
             data = data + "<span>"+"total:"+"</span>" +
                                 "<h5>" + value.total  + "&#2547;"+"</h5>";
            }
            
            );
            $('#totalIndex').html(data);

        }

    });
}
cartAjaxTotalPriceAllIndex();

 //    Post Comment
 function allComments(){
    let id = document.getElementById('commentGetProductId').value;
    console.log(id);
    $.ajax({
           type:"GET",
           dataType:"json",
           url:'/showComments/'+id,
           success:function(Response){
               var data = "";
               $.each(Response,function(key,value){
                data = data +  "<h5>"+value.userName + "<span>" +value.created_at+ "</span>" + "</h5>" + "<div class='at-reply'>" +value.userComment+"</div>";
               });
               $('#commentShow').html(data);

           }

       });
              
}
allComments();

function postComment(){       
let name = document.getElementById("commentName").value;
let comment = document.getElementById("commentComment").value;
let productId = document.getElementById("commentProductId").value;
$.ajax({
           type:"POST",
           dataType:"json",
           data:{name:name,comment:comment,productId:productId},
           url:'/comment',
           success:function(Response){
            allComments();
            document.getElementById("commentComment").value = "";
           }
          


       });

}





