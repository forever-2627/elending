$(function() {
  'use strict'



  var colors = {
    primary        : "#6571ff",
    secondary      : "#7987a1",
    success        : "#05a34a",
    info           : "#66d1d1",
    warning        : "#fbbc06",
    danger         : "#ff3366",
    light          : "#e9ecef",
    dark           : "#060c17",
    muted          : "#7987a1",
    gridBorder     : "rgba(77, 138, 240, .15)",
    bodyColor      : "#b8c3d9",
    cardBg         : "#0c1427"
  }

  var fontFamily = "'Roboto', Helvetica, sans-serif"

  // Monthly Sales Chart
  if($('#monthlySalesChart').length) {
    var options = {
      chart: {
        type: 'bar',
        height: '560',
        parentHeightOffset: 0,
        foreColor: colors.bodyColor,
        background: colors.cardBg,
        toolbar: {
          show: false
        },
      },
      theme: {
        mode: 'light'
      },
      tooltip: {
        theme: 'light'
      },
      colors: [colors.primary],  
      fill: {
        opacity: .9
      } , 
      grid: {
        padding: {
          bottom: -4
        },
        borderColor: colors.gridBorder,
        xaxis: {
          lines: {
            show: true
          }
        }
      },
      series: [{
        name: 'Sales',
        data: [15232,10429,9573,11233,13426,16731,18248,12543,12502,11363,11346,13424]
      }],
      xaxis: {
        type: 'datetime',
        categories: ['01/01/2023','02/01/2023','03/01/2023','04/01/2023','05/01/2023','06/01/2023','07/01/2023', '08/01/2023','09/01/2023','10/01/2023', '11/01/2023', '12/01/2023'],
        axisBorder: {
          color: colors.gridBorder,
        },
        axisTicks: {
          color: colors.gridBorder,
        },
      },
      yaxis: {
        title: {
          text: 'Monthly Loaned Amount',
          style:{
            size: 9,
            color: colors.muted
          }
        },
      },
      legend: {
        show: true,
        position: "top",
        horizontalAlign: 'center',
        fontFamily: fontFamily,
        itemMargin: {
          horizontal: 8,
          vertical: 0
        },
      },
      stroke: {
        width: 0
      },
      dataLabels: {
        enabled: true,
        style: {
          fontSize: '10px',
          fontFamily: fontFamily,
        },
        offsetY: -27
      },
      plotOptions: {
        bar: {
          columnWidth: "50%",
          borderRadius: 4,
          dataLabels: {
            position: 'top',
            orientation: 'vertical',
          }
        },
      },
    }
    
    var apexBarChart = new ApexCharts(document.querySelector("#monthlySalesChart"), options);
    apexBarChart.render();
  }
  // Monthly Sales Chart - END

});