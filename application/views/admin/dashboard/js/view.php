<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var opt_aaa = {
            title: 'Kriteria 1',
            legend: {
                position: 'bottom'
            },
        };

        var aaa = google.visualization.arrayToDataTable([
            ['m', 'Buruk', 'Normal', 'Baik'],
            ['0', 1, 0, 0],
            ['10', 1, 0, 0],
            ['30', 0, 1, 0],
            ['50', 0, 0, 1],
            ['60', 0, 0, 1]
        ]);

        var chart_aaa = new google.visualization.LineChart(document.getElementById('curve_chart_aaa'));

        chart_aaa.draw(aaa, opt_aaa);




        var opt_bbb = {
            title: 'Kriteria 2',
            legend: {
                position: 'bottom'
            },
        };

        var bbb = google.visualization.arrayToDataTable([
            ['x', 'Sedikit', 'Banyak'],
            ['0', 1, 0],
            ['40', 1, 0],
            ['80', 0, 1],
            ['120', 0, 1],
        ]);

        var chart_bbb = new google.visualization.LineChart(document.getElementById('curve_chart_bbb'));

        chart_bbb.draw(bbb, opt_bbb);
    }
</script>