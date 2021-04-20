$('#list_etsy').on('change', function() {
    $('#hidden_shop_name').val(this.value);
    // hidden_csv_shop_name
    $('#hidden_csv_shop_name').val(this.value);
});

// list_fulfilled_flg
$('#list_fulfilled_flg').on('change', function() {
  $('#hidden_fulfilled_flg').val(this.value);
});

// btn_search
$('#btn_search').on('click', function() {
    $('form#form_etsyorder_hidden').submit();
});

// button export orders csv
$('#btn_export_csv').on('click', function() {
    $('form#form_hidden_export_csv_etsy_orders').submit();
});

//list_periods
$('#list_periods').on('change', function() {
    $('#hidden_period').val(this.value);
    // form_etsysummary_hidden
    $('form#form_etsysummary_hidden').submit();
});

//list_paypal
$('#list_paypal').on('change', function() {
    $('#hidden_paypal').val(this.value);
});

$('#btn_pp_tran_search').on('click', function() {
    $('form#form_paypal_transaction_hidden').submit();
});


$(function(){
    $(".wrapper1").scroll(function(){
        $(".wrapper2")
            .scrollLeft($(".wrapper1").scrollLeft());
    });
    $(".wrapper2").scroll(function(){
        $(".wrapper1")
            .scrollLeft($(".wrapper2").scrollLeft());
    });
});


function copy_text_fun(copy_txt) {
    //getting text from P tag
    var copyText = document.getElementById(copy_txt);  
    // creating textarea of html
    var input = document.createElement("textarea");
    //adding p tag text to textarea 
    input.value = copyText.textContent;
    document.body.appendChild(input);
    input.select();
    document.execCommand("Copy");
    // removing textarea after copy
    input.remove();
    alert("Copied!!!");
}

var editing_value = '';
$(document).ready(function() {
    $('.text-editting').click(function () {
        var dad = $(this);
        dad.find('label').hide();
        dad.find('input[type="text"]').show().focus();
        editing_value = dad.find('input[type="text"]').val();
    });
    
    $('.text-editting>input[type=text]').focusout(function() {
        var dad = $(this).parent();
        $(this).hide();

        var label = dad.find('label');
        var label_for = label.attr("for");
        var label_for_parts = label_for.split("-");
        var product_id = label_for_parts[0];
        var update_field = label_for_parts[1];

        if (editing_value != $(this).val()) {//edited
            var update_value = $(this).val();
            $(label).html(update_value);

            $.ajax({
				url: "/product/update",
				type: "POST",
				data: {
					id: product_id,
                    field: update_field,
					value: update_value
				},
				cache: false,
				success: function(dataResult){
					var dataResult = JSON.parse(dataResult);
					if(dataResult.statusCode==200){
						$('#success').html('Data added successfully !'); 						
					}
					else if(dataResult.statusCode==201){
					   alert("Error occured !");
					}
					
				}
			});
        }
        label.show();
        
    });
});