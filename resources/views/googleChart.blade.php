@extends('master')
@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>laravel google pie chart tutorial example</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <style type="text/css">
        .box{
            width:800px;
            margin:0 auto;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        var analytics = {!! $status !!}
        console.log(analytics)
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable(analytics);
            var options = {
                title : 'Percentage of project based on status'
            };
            var chart = new google.visualization.PieChart(document.getElementById('pie_chart'));
            chart.draw(data, options);
        }
    </script>
</head>
<body>
    <div class="container" style="margin-top: 50px;">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Chart of projects that have been done</h3>
                    </div>
                    <div class="panel-body" align="center">
                        <div id="pie_chart" style="width:750px; height:450px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

@endsection
