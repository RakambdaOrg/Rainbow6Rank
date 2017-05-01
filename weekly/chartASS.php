<?php
	$divName = 'ASS';
	$title = 'Assists';

	$guides = function()
	{
		return json_encode(array());
	};

	$datas = function() use (&$monthRange)
	{
		$datas = array();
		$files = glob('players/*/*.json', GLOB_BRACE);
		foreach($files as $file)
		{
			$timestamp = (explode('.', array_values(array_slice(explode('/', $file), -1))[0])[0] / 1000);
			if(!isset($_GET['all']) && time() - $timestamp > $monthRange)
				continue;
			$player = json_decode(file_get_contents($file), true);
			if(!isset($player['player']['username']) || $player['player']['username'] === '')
				continue;
			$username = $player['player']['username'];
			if(!isset($datas[$username]))
				$datas[$username] = array();
			$datas[$username][$player['player']['updated_at']] = array('stat' => 0, 'timestamp' => $timestamp);
			$datas[$username][$player['player']['updated_at']]['stat'] = $player['player']['stats']['overall']['assists'];
		}
		return json_encode(WeekUtils::groupWeekly($datas, 0));
	};

	include 'graph.php';