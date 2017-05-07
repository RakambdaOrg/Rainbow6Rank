<?php
	require_once 'GraphUtils.php';

	$divName = 'WLRR';
	$title = 'W/L Ratio Ranked';

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
			if(!isset($datas[$username]))
				$datas[$username] = array();
			$datas[$username][$player['player']['updated_at']] = array('stat' => 0, 'total' => 0, 'timestamp' => $timestamp);
			$datas[$username][$player['player']['updated_at']]['stat'] = $player['player']['stats']['ranked']['wins'];
			$datas[$username][$player['player']['updated_at']]['total'] = $player['player']['stats']['ranked']['losses'];
		}
		return json_encode(GraphUtils::process($datas));
	};

	include 'graph.php';