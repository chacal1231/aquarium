<script type="text/javascript" src="http://static.fusioncharts.com/code/latest/fusioncharts.js"></script>
<?php
$Date = date ('Y-m-d');
#Temperature query
$TempQuery = mysqli_query($link,"SELECT TMP,hour from minutedata ORDER BY hour DESC");
$TMP = mysqli_fetch_row($TempQuery);

#Waterflow query
$WaterQuery = mysqli_query($link,"SELECT WFR,hour FROM minutedata ORDER BY hour DESC");
$WFR = mysqli_fetch_row($WaterQuery);

#OilFlow query
$OilQuery = mysqli_query($link,"SELECT OFR,hour FROM minutedata ORDER BY hour DESC");
$OFR = mysqli_fetch_row($OilQuery);

#GasFlow query
$GasQuery = mysqli_query($link,"SELECT GFR,hour FROM minutedata ORDER BY hour DESC");
$GFR = mysqli_fetch_row($GasQuery);
?>

<div class="row">
    <div class="col-md-3">
        <div class="mini-stat clearfix">
            <font size="1"><b>Process Temp</b></font>
            <span class="mini-stat-icon green"><i class="fa fa-thermometer-half"></i></span>
            <div class="mini-stat-info">
               <button type="button" class="btn btn-danger btn-xs"><?=$TMP[0]?> °C</button><font size="2"></font><br>
                </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="mini-stat clearfix">
            <font size="1"><b>WaterFlow</b></font>
            <span class="mini-stat-icon tar"><i class="fa fa-shower"></i></span>
            <div class="mini-stat-info">
                <button type="button" class="btn btn-info btn-xs"><?=$WFR[0]?> </button><font size="2"> (Sm3/d)</font><br>
             
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="mini-stat clearfix">
            <font size="1"><b>OilFlow</b></font> 
            <span class="mini-stat-icon pink"><i class="fa fa-tint"></i></span>
            <div class="mini-stat-info">
            <button type="button" class="btn btn-info btn-xs"><?=$OFR[0]?></button><font size="2"> (Sm3/d)</font><br>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="mini-stat clearfix">
            <font size="1"><b>GasFlow</b></font>
            <span class="mini-stat-icon green"><i class="fa fa-soundcloud"></i></span>
            <div class="mini-stat-info">
                <button type="button" class="btn btn-info btn-xs"><?=$GFR[0]?></button><font size="2"> (Sm3/d)</font>
                <br>
            </div>
        </div>
    </div>
</div>
 <div class="row">
    <div class="col-sm-6">
        <section class="panel">
            <header class="panel-heading">
               Process Temperature
            </header>
            <div class="panel-body"> 
                <div class="table-responsive">
                    <table class="display table table-bordered table-striped">
                    <!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function () {
                var dataLength = 0;
                var data = [];
                var updateInterval = 500;
                updateChart();
                function updateChart() {
                    $.getJSON("pages/jsonchar.php", function (result) {
                        if (dataLength !== result.length) {
                            for (var i = dataLength; i < result.length; i++) {
                                data.push({
                                    label: (result[i].valorx),
                                    y: parseFloat(result[i].valory)
                                });
                            }
                            dataLength = result.length;
                            chart.render();

                        }
                    });
                }
                var chart = new CanvasJS.Chart("chart", {
                    zoomEnabled: true,
                    title: {
                        text: "Process Temperature"
                    },
                    axisX: {
                        title: "chart updates every " + 60 + " secs"
                    },
                    axisY: {
                        title: "Temperature",

                        suffix: " °C",

                    },
                    data: [{type: "line",
                            toolTipContent: "{label} : {y} °C",
                             lineColor: "red", 
                            dataPoints: data}],
                });
                setInterval(function () {
                    updateChart()
                }, updateInterval);

                //Chart 2

                var dataLength2 = 0;
                var data2 = [];
                var updateInterval2 = 500;
                updateChart2();
                function updateChart2() {
                    $.getJSON("pages/jsoncharoil.php", function (result2) {
                        if (dataLength2 !== result2.length) {
                            for (var i = dataLength2; i < result2.length; i++) {
                                data2.push({
                                    label: (result2[i].valorx),
                                    y: parseFloat(result2[i].valory)
                                });
                            }
                            dataLength2 = result2.length;
                            chart2.render();
                        }
                    });
                }
                var chart2 = new CanvasJS.Chart("chart2", {
                    zoomEnabled: true,
                    title: {
                        text: "Oil Flow Rate"
                    },
                    axisX: {
                        title: "chart updates every " + 60 + " secs"
                    },
                    axisY: {
                        title: "Sm3/d",

                        suffix: " Sm3/d",

                    },
                    data: [{type: "line",
                             toolTipContent: "{label} : {y} Sm3/d",
                             lineColor: "red", 

                            dataPoints: data2}],
                });
                setInterval(function () {
                    updateChart2()
                }, updateInterval);


}
</script>
</head>
<body>
<div id="chart" style="height: 370px; max-width: 920px; margin: 0px auto;""></div>
<script src="backend/js/canvasjs.min.js"></script>
</body>
</html>     
                    </table>
                </div>
            </div>
        </section>
    </div>

        <div class="col-sm-6">
        <section class="panel">
            <header class="panel-heading">
                Oil Flow rate 
            </header>
            <div class="panel-body"> 
                <div class="table-responsive">
                    <div id="chart2" style="height: 370px; max-width: 920px; margin: 0px auto;""></div>
                    <script src="backend/js/canvasjs.min.js"></script>
                    </table>
                    </div>
                    </div>
                    </section>
                    </div>
                    </div>