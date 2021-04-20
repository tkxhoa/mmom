// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Bar Chart Example hidden_arr_shop_names, hidden_arr_shop_items_total, hidden_arr_shop_qty_total
var arr_shop_names = document.getElementById("hidden_arr_shop_names").value.split(",");
var arr_shop_items_total = document.getElementById("hidden_arr_shop_items_total").value.split(",");
var arr_shop_qty_total = document.getElementById("hidden_arr_shop_qty_total").value.split(",");

// Pie Chart Revenue
var ctxRevenue = document.getElementById("myPieChartRevenue");
var myPieChartRevenue = new Chart(ctxRevenue, {
  type: 'doughnut',
  data: {
    labels: arr_shop_names,//["Direct", "Referral", "Social"],
    datasets: [{
      data: arr_shop_items_total, //[55, 30, 15],
      backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#008080', '#48D1CC', '#66CDAA', '#2E8B57',
        '#3CB371', '#8FBC8F', '#9ACD32', '#FF8C00', '#FF4500', '#FF7F50', '#DC143C', '#E9967A'],
      hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});


// Pie Chart Sold
var ctxSold = document.getElementById("myPieChartSold");
var myPieChartSold = new Chart(ctxSold, {
  type: 'doughnut',
  data: {
    labels: arr_shop_names,//["Direct", "Referral", "Social"],
    datasets: [{
      data: arr_shop_qty_total, //[55, 30, 15],
      backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#008080', '#48D1CC', '#66CDAA', '#2E8B57',
        '#3CB371', '#8FBC8F', '#9ACD32', '#FF8C00', '#FF4500', '#FF7F50', '#DC143C', '#E9967A'],
      hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});
