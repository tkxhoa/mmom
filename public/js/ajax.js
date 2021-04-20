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