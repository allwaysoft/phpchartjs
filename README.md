# phpchartjs
使用PHP和Chart.js创建动态数据图
如果我们想可视化统计数据，则图表是最好的表示方式之一。使用图形可以很容易地理解数据。有各种图表库，例如Google Charts，Highcharts，Chart.js等。以前，我们创建了示例代码来使用Highcharts生成图形。让我们创建一个示例，以使用Chart.js库创建图形视图。
 
观看演示
使用Chart.js创建图形视图非常简单。我已经为从数据库检索的动态数据创建了图形输出。我有一个包含学生成绩的MySQL数据库表 tbl_marks 。我读取了标记数据并将其提供给Chart.js函数，以使用标记统计信息创建图形。
图表HTML5画布
从GitHub下载 Chartjs库，并在示例中包含库文件。在登陆HTML页面中，我有一个HTML5 canvas元素来绘制图形输出。
在加载登录页面时，我向PHP发送AJAX请求以从数据库中读取学生成绩。该JSON响应将被解析，并作为参数提供给Chart.js函数以创建图形。
PHP通过其内置函数通过编程为JSON文件处理提供了无限支持。
<!DOCTYPE html>
<html>
<head>
<title>Creating Dynamic Data Graph using PHP and Chart.js</title>
<style type="text/css">
BODY {
    width: 550PX;
}

#chart-container {
    width: 100%;
    height: auto;
}
</style>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/Chart.min.js"></script>


</head>
<body>
    <div id="chart-container">
        <canvas id="graphCanvas"></canvas>
    </div>

    <script>
        $(document).ready(function () {
            showGraph();
        });


        function showGraph()
        {
            {
                $.post("data.php",
                function (data)
                {
                    console.log(data);
                     var name = [];
                    var marks = [];

                    for (var i in data) {
                        name.push(data[i].student_name);
                        marks.push(data[i].marks);
                    }

                    var chartdata = {
                        labels: name,
                        datasets: [
                            {
                                label: 'Student Marks',
                                backgroundColor: '#49e2ff',
                                borderColor: '#46d5f1',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: marks
                            }
                        ]
                    };

                    var graphTarget = $("#graphCanvas");

                    var barGraph = new Chart(graphTarget, {
                        type: 'bar',
                        data: chartdata
                    });
                });
            }
        }
        </script>

</body>
</html>
PHP代码从MySQL数据库读取学生成绩
通过AJAX请求PHP文件data.php来访问数据库以读取学生成绩。读取记录后，它将作为JSON响应返回。代码是
<?php
header('Content-Type: application/json');

require_once('db.php');

$sqlQuery = "SELECT student_id,student_name,marks FROM tbl_marks ORDER BY student_id";

$result = mysqli_query($conn,$sqlQuery);

$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

mysqli_close($conn);

echo json_encode($data);
?>
Chart.js动态数据图输出
此屏幕快照显示了Chart.js图表库使用数据库中的动态数据生成的图形输出。
 
观看演示下载

