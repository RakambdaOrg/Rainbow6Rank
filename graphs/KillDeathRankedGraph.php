<?php
	require_once dirname(__FILE__) . '/model/GraphSupplier.php';

	class KillDeathRankedGraph extends GraphSupplier
	{
		function getPoint($player)
		{
			$point = array('stat' => 0, 'total' => 0);
			$point['stat'] = $player['player']['stats']['ranked']['kills'];
			$point['total'] = $player['player']['stats']['ranked']['deaths'];
			return $point;
		}

		function getTitle()
		{
			return 'K/D Ratio Ranked';
		}

		function getID()
		{
			return 'KDR';
		}
	}
