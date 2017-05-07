<?php
	require_once __DIR__ . '/../model/GraphSupplier.php';

	class WinLossRankedGraph extends GraphSupplier
	{
		function getPoint($player)
		{
			$point = array('stat' => 0, 'total' => 0);
			$point['stat'] = $player['player']['stats']['ranked']['wins'];
			$point['total'] = $player['player']['stats']['ranked']['losses'];
			return $point;
		}

		function getTitle()
		{
			return 'W/L Ratio Ranked';
		}

		function getID()
		{
			return 'WLR';
		}
	}
