<?php

	namespace R6
	{
		require_once __DIR__ . '/RankedSeasonGraph.php';

		class RankedSeason6Graph extends RankedSeasonGraph
		{
			private $endDate = 1504051200;

			private $ranks = array('Gold ✦' => array('from' => 3100, 'to' => 3300), 'Gold II' => array('from' => 2900, 'to' => 3100), 'Gold III' => array('from' => 2700, 'to' => 2900), 'Gold IV' => array('from' => 2500, 'to' => 2700), 'Silver ✦' => array('from' => 2400, 'to' => 2500), 'Silver II' => array('from' => 2300, 'to' => 2400), 'Silver III' => array('from' => 2200, 'to' => 2300), 'Silver IV' => array('from' => 2100, 'to' => 2200), 'Bronze ✦' => array('from' => 2000, 'to' => 2100), 'Bronze II' => array('from' => 1900, 'to' => 2000), 'Bronze III' => array('from' => 1800, 'to' => 1900), 'Bronze IV' => array('from' => 1700, 'to' => 1800), 'Copper ✦' => array('from' => 1600, 'to' => 1700), 'Copper II' => array('from' => 1500, 'to' => 1600), 'Copper III' => array('from' => 1400, 'to' => 1500));

			function getSeasonID()
			{
				return '6';
			}

			function getRanks()
			{
				return $this->ranks;
			}

			function getEndDate()
			{
				return $this->endDate;
			}
		}
	}