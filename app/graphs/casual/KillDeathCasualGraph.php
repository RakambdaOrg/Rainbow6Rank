<?php

	namespace R6
	{
		require_once __DIR__ . '/../../model/GraphSupplier.php';

		class KillDeathCasualGraph extends GraphSupplier
		{
			function getPoint($player)
			{
				$point = array('stat' => 0, 'total' => 0);
				$point['stat'] = $player['player']['stats']['casual']['kills'];
				$point['total'] = $player['player']['stats']['casual']['deaths'];
				return $point;
			}

			function getTitle()
			{
				return 'K/D Ratio Casual';
			}

			function getID()
			{
				return 'KDC';
			}

			function getAdditionalBalloon()
			{
				return array('stat' => 'Kills: ', 'total' => 'Deaths: ');
			}
		}
	}