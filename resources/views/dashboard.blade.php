<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

        <title>{{ env('APP_NAME') }}</title>

<meta charset='UTF-8'>
<meta name="robots" content="noindex">
<style class="INLINE_PEN_STYLESHEET_ID">
body {
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
}


#chartdiv {
  width: 800px;
  height: 350px;
}

#chart-genero {
  width: 800px;
  height: 450px;
}

#chartdiv2 {
  width: 800px;
  height: 250px;
	padding-top:50px
}

    </style>



</head>
<body>
<script src="https://www.amcharts.com/lib/4/core.js"></script>
<script src="https://www.amcharts.com/lib/4/charts.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>


        <div class="flex-center position-ref full-height" style="margin-left: 150px">

            <div class="content">
                <div class="title m-b-md">
                    {{ env('APP_NAME') }}
                </div>


    @php
    $cadastros = DB::select('select count(*) as qtd, DATE_FORMAT(created_at,"%Y-%m-%d") as dia FROM users GROUP BY dia');
    $generos = DB::select('select count(*) as qtd, IF(Raca IS NULL or Raca = "", "Sem definição", Raca) as raca FROM alunos GROUP BY raca');
    $meses = DB::select('select count(*) as qtd, DATE_FORMAT(created_at,"%Y-%m") as mes FROM users GROUP BY mes');
    @endphp


<h1>Dias de alunos fizeram seus cadastros</h1>
<div id="chartdiv"></div>
<script id="INLINE_PEN_JS_ID">
// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("chartdiv", am4charts.XYChart);

// Add data
chart.data = [
            <?php
            foreach($cadastros as $cadastro){
		echo "{'date':'" . $cadastro->dia . "','value':'" . $cadastro->qtd . "'},";
            };
            ?>

];


// Set input format for the dates
chart.dateFormatter.inputDateFormat = "yyyy-MM-dd";

// Create axes
var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

// Create series
var series = chart.series.push(new am4charts.LineSeries());
series.dataFields.valueY = "value";
series.dataFields.dateX = "date";
series.tooltipText = "{value}";
series.strokeWidth = 2;
series.minBulletDistance = 15;

// Drop-shaped tooltips
series.tooltip.background.cornerRadius = 20;
series.tooltip.background.strokeOpacity = 0;
series.tooltip.pointerOrientation = "vertical";
series.tooltip.label.minWidth = 40;
series.tooltip.label.minHeight = 40;
series.tooltip.label.textAlign = "middle";
series.tooltip.label.textValign = "middle";

// Make bullets grow on hover
var bullet = series.bullets.push(new am4charts.CircleBullet());
bullet.circle.strokeWidth = 2;
bullet.circle.radius = 4;
bullet.circle.fill = am4core.color("#fff");

var bullethover = bullet.states.create("hover");
bullethover.properties.scale = 1.3;

// Make a panning cursor
chart.cursor = new am4charts.XYCursor();
chart.cursor.behavior = "panXY";
chart.cursor.xAxis = dateAxis;
chart.cursor.snapToSeries = series;

// Create vertical scrollbar and place it before the value axis
chart.scrollbarY = new am4core.Scrollbar();
chart.scrollbarY.parent = chart.leftAxesContainer;
chart.scrollbarY.toBack();

// Create a horizontal scrollbar with previe and place it underneath the date axis
chart.scrollbarX = new am4charts.XYChartScrollbar();
chart.scrollbarX.series.push(series);
chart.scrollbarX.parent = chart.bottomAxesContainer;

dateAxis.start = 0.79;
dateAxis.keepSelection = true;
  </script>


<h1>Por Raça</h1>
<div id="chart-genero"></div>
<script id="INLINE_PEN_JS_ID">
am4core.useTheme(am4themes_animated);
var chart = am4core.create("chart-genero", am4charts.PieChart);

var pieSeries = chart.series.push(new am4charts.PieSeries());
pieSeries.dataFields.value = "litres";
pieSeries.dataFields.category = "country";

chart.innerRadius = am4core.percent(30);

// Put a thick white border around each Slice
pieSeries.slices.template.stroke = am4core.color("#fff");
pieSeries.slices.template.strokeWidth = 2;
pieSeries.slices.template.strokeOpacity = 1;
pieSeries.slices.template
.cursorOverStyle = [
{
  "property": "cursor",
  "value": "pointer" }];

//chart.legend = new am4charts.Legend();
chart.exporting.menu = new am4core.ExportMenu();

chart.data = [
            <?php
            foreach($generos as $genero){
                echo "{'country':'" . $genero->raca . "','litres':'" . $genero->qtd . "'},";
            };
            ?>

];
  </script>

<h1>Por mês</h1>
<div id="chartdiv2"></div>

<script>
      am4core.useTheme(am4themes_animated);
      var chart = am4core.create("chart-mes", am4charts.XYChart);
      // Add data
	chart.data = [
            <?php
            foreach($meses as $mes){
                echo "{'year':'" . $mes->mes . "','value':'" . $mes->qtd . "'},";
            };
            ?>
	];

//      chart.dateFormatter.inputDateFormat = "yyyy-MM";

      var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
      categoryAxis.dataFields.category = "year";
      categoryAxis.renderer.minGridDistance = 30;

      /* Create value axis */
      var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

      /* Create series */
      var columnSeries = chart.series.push(new am4charts.ColumnSeries());
      columnSeries.name = "Income";
      columnSeries.dataFields.valueY = "value";
      columnSeries.dataFields.categoryX = "year";

      var labelBullet = columnSeries.bullets.push(new am4charts.LabelBullet());
      labelBullet.label.text = "{value}";
      labelBullet.label.dy = -20;

    }
  });
  </script>



<!-- Chart code -->
<script>
am4core.useTheme(am4themes_animated);
var chart = am4core.create("chartdiv2", am4charts.XYChart);
chart.data = [
            <?php
            foreach($meses as $mes){ 
                echo "{'year':'" . $mes->mes . "','value':'" . $mes->qtd . "'},";
            };
            ?>

];

var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "year";
categoryAxis.renderer.grid.template.location = 0;
categoryAxis.renderer.minGridDistance = 30;

var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

var series = chart.series.push(new am4charts.ColumnSeries());
series.dataFields.valueY = "value";
series.dataFields.categoryX = "year";
series.name = "Visits";
series.columns.template.tooltipText = "{categoryX}: [bold]{valueY}[/]";
series.columns.template.fillOpacity = .8;

var columnTemplate = series.columns.template;
columnTemplate.strokeWidth = 2;
columnTemplate.strokeOpacity = 1;


</script>

</body>
</html>
