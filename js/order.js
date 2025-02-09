(function($){


    initOrder();

    function validateEmail() {
        var email = document.getElementById('email').value;
        var pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!pattern.test(email)) {
            alert('Please enter a valid email address.');
            return false;
        }
        return true;
    }


    $('.commit-btn').click(function(event) {


        var price=$('.checkout-bottom-price').text();
        var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        var email = document.getElementById('email').value;
        var email=$('#email').val();
        var phone=$('#phone').val();
        var address=$('#address').val();
        var payment=$('#payment').val();
        var state=$('#state').val();
        var city=$('#city').val();
        var orderName=$('#name').val();
        var orderRemark=$('#remark').val();
        
        if (orderName == '') { alert("Please enter name"); return false}
        if (email == '') { alert("Please enter email"); return false}
        if (phone == '') { alert("Please enter phone"); return false}
        if (address == '') { alert("Please enter address"); return false}
        if (state == '') { alert("Please enter state"); return false}
        if (city == '') { alert("Please enter city"); return false}
        if (payment == '') { alert("Please enter payment"); return false}
        if (!emailPattern.test(email)) {
            alert("Email wrong format");
            return false;
        }
        if(!orderName){
            alert("Please enter name");
            return false;
        }else{
        
        
        var postUrl="commitOrder.php";
        
        var userId=$.cookie('PHPSESSID');


        if(userId){
            var arrObj=selectAll(userId);
            if(arrObj&&arrObj.length>0){
                var itemsTxt=JSON.stringify(arrObj);
                $.post(postUrl,
                    {
                        items:itemsTxt,
                        amount:price,
                        phone:phone,
                        email:email,
                        address:address,
                        payment:payment,
                        name:orderName,
                        remark:orderRemark,
                        state:state,
                        city:city,
                        totalqty:$("#totalqty").val()
                    },
                    function(data,status,xhr) {

                        if(status=="success"){
                            $res= $.parseJSON(data);
                            if($res.code=="1"){


                                removeAllItem(userId);
                                alert($res.msg);
                                window.location.href="order_detail.php?id="+$res.order_id;

                            }else if($res.code=="0"){
                                alert($res.msg);
                            }
                        }else{
                            alert("Sever error");
                        }
                    });
            }else{
                alert("Already submitted!");
            }
        }


        }
    });



})(jQuery);





function initOrder(){
    var userId=$.cookie('PHPSESSID');

    if(userId){
        var arrObj=selectAll(userId);
        console.log(arrObj);
        if(arrObj&&arrObj.length>0){
            var price3=0;
            var count2=0;
            var htmlTxt="<li class='checkout-tablerow'>"

                +"<div class='cell itemname'><div class='fl'>$photo</div><div class='fl' style='width: 100px'>$name $uprice $unit</div></div>"
                +"<div class='cell itemquantity'>$count</div>"
                +"<div class='cell itemtotal'>$$price</div></li>";
            for(var i=0;i<arrObj.length;i++){
                if (arrObj[i].count <= 0) {
                    continue;
                }
                var itemId=arrObj[i].itemId;
                var name=hexToString(arrObj[i].name);
                var count=arrObj[i].count;
                var price=arrObj[i].price;
                var unit = arrObj[i].unit;
                var uprice = arrObj[i].uprice;
                var photo = "<img src='"+arrObj[i].photo+"' width='50' />";
                var price2=price*count;
                price3+=price2;
                count2+=count;

                var newTxt=htmlTxt.replace("$name",name).replace("$count",count).replace("$price",price2).replace("$uprice",uprice).replace("$photo",photo).replace("$unit",unit);

                $('.checkout-body').append(newTxt);
            }

           var newTxt=htmlTxt.replace("$name","Total").replace("$count",count2).replace("$price",price3).replace("$price",'').replace("$photo",'').replace("$unit",'');
                $('.checkout-body').append(newTxt);

                $("#totalqty").val(count2);
                $(".checkout-bottom-price").text(price3);

        }else{
            window.location.href="index.php";
        }

    }
}

