<?php

	class Memos
	{
		public function __construct()
		{

		}

		public function getActiveMemos()
		{
			$memoArray = array();

			$db = MySqlDatabase::getInstance();
			$con = $db->getConnection();

			$stmt = $con->prepare("SELECT * FROM memo WHERE status = ? ORDER BY deadline");
			$status = 'active';
			$stmt->bind_param('s', $status);
			$stmt->execute();

			$stmt->bind_result($memoID, $dateCreated, $deadline, $title, $description, $status, $priority);

			$arrayCount = 0;
			while($stmt->fetch()) {
				$memoArray[$arrayCount]['ID'] = $memoID;
				$memoArray[$arrayCount]['date_created'] = $dateCreated;
				$memoArray[$arrayCount]['deadline'] = $deadline;
				$memoArray[$arrayCount]['title'] = $title;
				$memoArray[$arrayCount]['description'] = $description;
				$memoArray[$arrayCount]['status'] = $status;
				$memoArray[$arrayCount]['priority'] = $priority;

				++$arrayCount;
			}

			$stmt->close();

			return $memoArray;
		}

        public function getActiveMemosForToday($memos)
        {
            $highPriority = array();
            $mediumPriority = array();
            $lowPriority = array();

            foreach ($memos as $memo) {
                if($memo['deadline'] != date('Y-m-d')) {
                    unset($memo);
                    continue;
                }

                // Order memos by high/medium/low priority
                if ($memo['priority'] == 'high') {
                    array_push($highPriority, $memo);
                } elseif ($memo['priority'] == 'normal') {
                    array_push($mediumPriority, $memo);
                } elseif ($memo['priority'] == 'low') {
                    array_push($lowPriority, $memo);
                }
            }

            $memos = array_merge($highPriority, $mediumPriority, $lowPriority);

            return $memos;

        }

        public function getActiveMemosForTomorrow($memos)
        {
            $highPriority = array();
            $mediumPriority = array();
            $lowPriority = array();

            foreach ($memos as $memo) {
                if($memo['deadline'] != date('Y-m-d', strtotime('+ 1 day'))) {
                    unset($memo);
                    continue;
                }

                // Order memos by high/medium/low priority
                if ($memo['priority'] == 'high') {
                    array_push($highPriority, $memo);
                } elseif ($memo['priority'] == 'medium') {
                    array_push($mediumPriority, $memo);
                } elseif ($memo['priority'] == 'low') {
                    array_push($lowPriority, $memo);
                }
            }

            $memos = array_merge($highPriority, $mediumPriority, $lowPriority);

            return $memos;
        }

        public function extractIndividualMemoDetails($memos, $ID)
        {
            foreach($memos as $memo) {
                if ($memo['ID'] == $ID) {
                    $individualMemo = $memo;
                    break;
                }
            }

            if (!empty($individualMemo)) {
                return $individualMemo;
            } else {
                return false;
            }
        }

	}


?>
