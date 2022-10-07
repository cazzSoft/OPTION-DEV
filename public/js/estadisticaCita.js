// inicializacion del select
$(document).ready(function() {
   $('.select2').select2();
});

$(function () {
  /* ChartJS
   * -------
   * Here we will create a few charts using ChartJS
   */

  //--------------
  //- AREA CHART -
  //--------------
  var labels_=data_['labels'];
  var dataOnline=data_['dataVirtual'];
  var dataPresencial=data_['dataPrecen'];


  var areaChartData = {
    labels  : labels_,
    datasets: [
      {
        label               : 'Presencial',
        backgroundColor     : '#0FADCE',
        borderColor         : '#0FADCE',
        pointRadius         : true,
        pointColor          : '#0FADCE',
        pointStrokeColor    : '#0FADCE',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(220,220,220,1)',
        data                : dataPresencial
      },
      {
        label               : 'Online',
        backgroundColor     : '#66CFC3',
        borderColor         : '#66CFC3',
        pointRadius          : true,
        pointColor          : '#3b8bba',
        pointStrokeColor    : '#66CFC3',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: '#66CFC3',
        data                : dataOnline
      },
      
    ]
  }

  bar_chart(areaChartData);

  var chart;
  function bar_chart(areaChartData) {
   
      if(areaChartData['labels'].length === 0){
         
          chart.destroy();
      }
      var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
      var stackedBarChartData = $.extend(true, {}, areaChartData)

      var stackedBarChartOptions = {
        responsive              : true,
        maintainAspectRatio     : true,
        scales: {
          xAxes: [{
            stacked: true,
          }],
          yAxes: [{
            stacked: true
          }]
        },
      }

    chart = new Chart(stackedBarChartCanvas, {
        type: 'bar',
        data: stackedBarChartData,
        options: stackedBarChartOptions,
        // options: stackedBarChartOptions
      })   
  }

  // obtener estadistica por año
  $('#año_estadistica').change(function (argument) {
     console.log($('#año_estadistica').val());
     $.get("/estadistica/datos/"+$('#año_estadistica').val(), function (data) {
        console.log(data['labels']);
         labels_=data['labels'];
         dataOnline=data['dataVirtual'];
         dataPresencial=data['dataPrecen'];  
         var areaChartData = {
           labels  : labels_,
           datasets: [
             {
               label               : 'Presencial',
               backgroundColor     : '#0FADCE',
               borderColor         : '#0FADCE',
               pointRadius         : true,
               pointColor          : '#0FADCE',
               pointStrokeColor    : '#0FADCE',
               pointHighlightFill  : '#fff',
               pointHighlightStroke: 'rgba(220,220,220,1)',
               data                : dataPresencial
             },
             {
               label               : 'Online',
               backgroundColor     : '#66CFC3',
               borderColor         : '#66CFC3',
               pointRadius          : true,
               pointColor          : '#3b8bba',
               pointStrokeColor    : '#66CFC3',
               pointHighlightFill  : '#fff',
               pointHighlightStroke: '#66CFC3',
               data                : dataOnline
             },
             
           ]
         }
          chart.destroy();
         bar_chart(areaChartData); 
     });
  });

});

