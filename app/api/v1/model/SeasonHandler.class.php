<?php

	namespace R6
	{
		include_once __DIR__ . "/DBConnection.class.php";

		class SeasonHandler
		{
			/**
			 * DBHandler constructor.
			 */
			public function __construct()
			{
			}

			private function getPlayerUID($player)
			{
				$prepared = DBConnection::getConnection()->prepare("SELECT UID FROM R6_Player WHERE Username=:username");
				$prepared->execute(array(':username' => $player));
				$result = $prepared->fetch();
				if($result)
				{
					return $result['UID'];
				}
				return "ERROR";
			}

			public function getPlayers($range, $sid)
			{
				$players = array();
				$prepared = DBConnection::getConnection()->prepare("SELECT DISTINCT Username FROM R6_Stats_Season LEFT JOIN R6_Player ON R6_Stats_Season.UID = R6_Player.UID WHERE DataDate >= DATE_SUB(NOW(), INTERVAL :days DAY) AND SeasonNumber=:sid");
				$prepared->execute(array(":sid" => $sid, ':days' => $range));
				$result = $prepared->fetchAll();
				foreach($result as $key => $row)
				{
					$players[] = $row['Username'];
				}
				return $players;
			}

			public function getRank($range, $sid, $player)
			{
				$data = array();
				$prepared = DBConnection::getConnection()->prepare("SELECT DataDate, Rating, Mean, StandardDeviation, RankName, Wins, Losses, Abandons FROM R6_Stats_Season  LEFT JOIN R6_Season_Ranks ON R6_Season_Ranks.Season = R6_Stats_Season.SeasonNumber INNER JOIN R6_Ranks ON R6_Ranks.RankID = R6_Season_Ranks.RankID AND R6_Stats_Season.Rank = R6_Ranks.Rank WHERE UID=:uid AND SeasonNumber=:sid AND DataDate >= DATE_SUB(NOW(), INTERVAL :days DAY)");
				$prepared->execute(array(":uid" => $this->getPlayerUID($player), ':sid' => $sid, ':days' => $range));
				$result = $prepared->fetchAll();
				foreach($result as $key => $row)
				{
					$data[] = array('date' => $row['DataDate'], 'value' => $row['Rating'], 'mean' => $row['Mean'], 'stdev' => $row['StandardDeviation'], 'rank' => $row['RankName'], 'wins' => $row['Wins'], 'losses' => $row['Losses'], 'abandons' => $row['Abandons']);
				}
				return $data;
			}
		}
	}
