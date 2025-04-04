 // single bar chart
 var ctx = document.getElementById( "singelBarChart" );
 ctx.height = 150;
 var myChart = new Chart( ctx, {
     type: 'bar',
     data: {
         labels: [ "Sun", "Mon", "Tu", "Wed", "Th", "Fri", "Sat" ],
         datasets: [
             {
                 label: "My First dataset",
                 data: [ 40, 55, 75, 81, 56, 55, 40 ],
                 borderColor: "rgba(0, 123, 255, 0.9)",
                 borderWidth: "0",
                 backgroundColor: "rgba(0, 123, 255, 0.5)"
                         }
                     ]
     },
     options: {
         scales: {
             yAxes: [ {
                 ticks: {
                     beginAtZero: true
                 }
                             } ]
         }
     }
 } );