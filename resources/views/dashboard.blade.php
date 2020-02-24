@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

        <title>{{ env('APP_NAME') }}</title>

<meta charset='UTF-8'>
<meta name="robots" content="noindex">
<style>
body {
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
}
#chart-dia {
  width: 800px;
  height: 350px;
}

#chart-mes {
  width: 800px;
  height: 250px;
}

#chart-genero {
  width: 800px;
  height: 450px;
}

#chart-raca {
  width: 800px;
  height: 450px;
}
</style>



</head>
<body>
<script src="https://www.amcharts.com/lib/4/core.js"></script>
<script src="https://www.amcharts.com/lib/4/charts.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>

    <div class="container">
       <div class="row">

            <div class="content">
    @php
    $cadastros = DB::select('select count(*) as qtd, DATE_FORMAT(created_at,"%Y-%m-%d") as dia FROM users GROUP BY dia');
    $meses = DB::select('select count(*) as qtd, DATE_FORMAT(created_at,"%Y-%m") as mes FROM users GROUP BY mes');
    $racas = DB::select('select count(*) as qtd, IF(Raca IS NULL or Raca = "", "Sem definição", Raca) as raca FROM alunos GROUP BY raca');
    $generos = DB::select('select count(*) as qtd, IF(Genero IS NULL or Genero = "", "Sem definição", Genero) as genero FROM alunos GROUP BY genero');
    $alunos = DB::table('alunos')->count();
    $alunos0 = DB::table('alunos')->where('Status', '0')->count();
    $alunos1 = DB::table('alunos')->where('Status', '1')->count();
    $alunosoff = DB::table('alunos')->where('ListaEspera', 'Sim')->count();
    $professores = DB::table('professores')->count();
    $coordenadores = DB::table('coordenadores')->count();
    $nucleos = DB::table('nucleos')->count();
    @endphp


    <div class="row">
    <div class="col">
      <div class="form-group">
        <h1><?php echo $alunos; ?></h1> Alunos
        <p><strong><?php echo $alunos1 ?></strong> Ativos / <strong><?php echo $alunos0 ?></strong> Inativos</p>
      </div>
    </div>

    <div class="col">
      <div class="form-group">
        <h1><?php echo $alunosoff; ?></h1> Lista de espera
      </div>
    </div>

    <div class="col">
      <div class="form-group">
        <h1><?php echo $professores; ?></h1> Professores

      </div>
    </div>
    <div class="col">
      <div class="form-group">
      <h1><?php echo $coordenadores; ?></h1>Coordenadores
      </div>
    </div>
    <div class="col">
      <div class="form-group">
      <h1><?php echo $nucleos; ?></h1>Núcleos
      </div>
    </div>


</div>



<h1>Cadastros por dia</h1>
<div id="chart-dia"></div>
<script>
// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("chart-dia", am4charts.XYChart);

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

chart.exporting.menu = new am4core.ExportMenu();
  </script>


<h1>Por mês</h1>
<div id="chart-mes"></div>

<script>
am4core.useTheme(am4themes_animated);
var chart = am4core.create("chart-mes", am4charts.XYChart);
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

chart.exporting.menu = new am4core.ExportMenu();

</script>




<h1>Por Raça</h1>
<div id="chart-raca"></div>
<script>
am4core.useTheme(am4themes_animated);
var chart = am4core.create("chart-raca", am4charts.PieChart);

var pieSeries = chart.series.push(new am4charts.PieSeries());
pieSeries.dataFields.value = "qtd";
pieSeries.dataFields.category = "raca";

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
            foreach($racas as $raca){
                echo "{'raca':'" . $raca->raca . "','qtd':'" . $raca->qtd . "'},";
            };
            ?>

];
  </script>


<h1>Por Gênero</h1>
<div id="chart-genero"></div>
<script>
am4core.useTheme(am4themes_animated);
var chart = am4core.create("chart-genero", am4charts.PieChart);

var pieSeries = chart.series.push(new am4charts.PieSeries());
pieSeries.dataFields.value = "qtd";
pieSeries.dataFields.category = "genero";

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
                echo "{'genero':'" . $genero->genero . "','qtd':'" . $genero->qtd . "'},";
            };
            ?>
];
  </script>

</div></div></div>


</body>
</html>

@endsection
