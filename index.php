<?php

	if(false)
	{
		error_reporting(E_ALL);
		ini_set('display_errors', '1');
	}
	$dev = isset($_GET['dev']);
	$monthRange = isset($_GET['weekly']) ? 31536000 : 2592000;
	$chartDir = isset($_GET['weekly']) ? 'weekly/' : '';

	function getLastCheckDate()
	{
		$date = 0;
		$files = glob('players/last.update', GLOB_BRACE);
		foreach($files as $file)
		{
			$fDate = filemtime($file);
			$date = $date > $fDate ? $date : $fDate;
		}
		return $date === 0 ? 'UNKNOWN' : date("H:i:s", $date);
	}

	function getLastUpdateDate()
	{
		$date = 0;
		$files = glob('players/*/*.json', GLOB_BRACE);
		foreach($files as $file)
		{
			$fDate = filemtime($file);
			$date = $date > $fDate ? $date : $fDate;
		}
		return $date === 0 ? 'UNKNOWN' : date("H:i:s", $date);
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/main.css"/>
    <script type="text/javascript" src="js/libs/jquery/jquery.js"></script>
    <script type="text/javascript" src="js/libs/ElementQueries/ResizeSensor.js"></script>
    <script type="text/javascript" src="js/libs/ElementQueries/ElementQueries.js"></script>
    <script type="text/javascript" src="js/libs/amcharts/amcharts.js"></script>
    <script type="text/javascript" src="js/libs/amcharts/serial.js"></script>
    <script type="text/javascript" src="js/libs/amcharts/themes/light.js"></script>
    <script type="text/javascript" src="js/libs/amcharts/plugins/responsive/responsive.min.js"></script>
    <meta charset="UTF-8">
    <title>Rainbow6 stats</title>
</head>
<body>
<header id="topContainer">
    <div class="leftNav inline">
        <ul>
            <li><a href="https://r6stats.com/" target="_blank">Datas from R6Stats</a></li>
        </ul>
    </div>
    <div class="inline">
        <ul>
            <li class="centerNav"><a href="#">Last update at: <?php echo getLastCheckDate() ?></a></li>
            <li class="centerNav"><a href="#">Last data from: <?php echo getLastUpdateDate(); ?></a></li>
        </ul>
    </div>
    <div class="rightNav inline">
        <ul>
            <li>
		        <?php
			        if(!isset($_GET['weekly']))
			        {
				        ?>
                        <a href="?weekly=1">See weekly data</a>
				        <?php
			        }
			        else
			        {
				        ?>
                        <a href=".">See every data</a>
				        <?php
			        }
		        ?>
            </li>
            <li>
				<?php
					if(!isset($_GET['all']))
					{
						?>
                        <a href="?all=1">See all gathered data</a>
						<?php
					}
					else
					{
						?>
                        <a href=".">See current month data</a>
						<?php
					}
				?>
            </li>
        </ul>
    </div>
</header>
<div class="chartHolder" id="chartHolderRanked5">
    <span class="chartName">Season 5</span>
    <div class="chartDiv" id="chartDivRanked5"></div>
</div>
<hr/>
<div class="chartHolder" id="chartHolderKDR">
    <span class="chartName">Ratio K/D Ranked</span>
    <div class="chartDiv" id="chartDivKDR"></div>
</div>
<hr/>
<div class="chartHolder" id="chartHolderWLRR">
    <span class="chartName">Ratio W/L Ranked</span>
    <div class="chartDiv" id="chartDivWLRR"></div>
</div>
<hr/>
<div class="chartHolder" id="chartHolderKDC">
    <span class="chartName">Ratio K/D Casual</span>
    <div class="chartDiv" id="chartDivKDC"></div>
</div>
<hr/>
<div class="chartHolder" id="chartHolderWLRC">
    <span class="chartName">Ratio W/L Casual</span>
    <div class="chartDiv" id="chartDivWLRC"></div>
</div>
<?php include $chartDir . "chartRanked5.php"; ?>
<?php include $chartDir . "chartKDR.php"; ?>
<?php include $chartDir . "chartWLRR.php"; ?>
<?php include $chartDir . "chartKDC.php"; ?>
<?php include $chartDir . "chartWLRC.php"; ?>
<?php if(isset($_GET['weekly']))include $chartDir . "chartASS.php"; ?>
</body>
</html>