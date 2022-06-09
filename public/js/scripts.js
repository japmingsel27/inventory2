
function setForm(pid,pname,desc,unit,price){
    $('#epid').val(pid);
    $('#epname').val(pname);
    $('#edesc').val(desc);
    $('#eunit').val(unit);
    $('#eprice').val(price);
}

$('#saveEdit').on('click',function(){
    var pid = $('#epid').val();
    var pname = $('#epname').val();
    var desc = $('#edesc').val();
    var unit = $('#eunit').val();
    var price = $('#eprice').val();

    //jquery ajax structure
    
    $.ajax({
        url: "/products/editProduct",
        type: "POST",
        dataType: "json",
        data: {
            pid:pid,
            pname:pname,
            desc:desc,
            unit:unit,
            price:price,
            _token: $('input[name=_token]').val()
            }, 
        success: function(data){
            alert(data.message);
            if(data.status=='success'){
                $('#tpname').text(pname);
                $('#tdesc').text(desc);
                $('#tunit').text(unit);
                $('#tprice').text(price);
            }
            $('#closeModal').trigger('click');
        }
    });
       
});

function deleteProductCOnf(pid){
    $('#pidfordelete').val(pid);
}

function proceedDelete(){
    pid = $('#pidfordelete').val();
    $.ajax({
        url: "/products/deleteProduct",
        type: "POST",
        dataType: "json",
        data: {
            pid:pid,
            _token: $('input[name=_token]').val()
            },
        success: function(data){
            alert(data.message);
            if(data.status=='success'){
                $('tr#'+pid).remove();
            }
            $('#closeModalConf').trigger('click');
        }
    });
}