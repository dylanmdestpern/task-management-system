<?php

class TM_Task {

	private $tasks;
	private $errorMsg;
	private $debugErrorMsg;

	public function __construct ( $linkID = "", $teamID = "", $filter = "" ) {
		if ( $linkID != "" ) {

		}
	}

	public function getAllTasks ($linkID = "", $teamID = "", $filter = "") {
		/*
			Filters:
		*/

		$tasks = array();

		$tasksQ = "
			SELECT
				t.*
			FROM
				tasks t
			WHERE
				t.teamID = ".mysqli_real_escape_string($linkID, $teamID);


			if ( ! $tasksR = mysqli_query($linkID, $tasksQ) ) {
				$this->errorMsg = "A database error occured. Could not retrieve tasks.";
				$this->debugErrorMsg = mysqli_error($linkID);
				return false;
			}

			while ( $tasksA = mysqli_fetch_assoc($tasksR) ) {
				//Get task assigner
				$assignerTmp = new User;
				if ( ! $assigner = $assignerTmp->getUserInfoArray($linkID, $tasksA['assignerID']) ) {
					$this->errorMsg = $assignerTmp->getErrorMsg();
					$this->debugErrorMsg = $assignerTmp->getDebugErrorMsg();
					return false;
				}

				//Get task category
				if ( ! $taskCat = $this->getTaskCategoryInfo($linkID, $tasksA['categoryID']) ) {
					$this->errorMsg = $this->getErrorMsg();
					$this->debugErrorMsg = $this->getDebugErrorMsg();
					return false;
				}

				//Get status history
				$statusHistory = $this->getTaskStatuses($linkID, $tasksA['id'], false);

				//Get current status
				$status = $this->getTaskStatuses($linkID, $tasksA['id']);

				$tasksA['statusHistory'] = $statusHistory;
				$tasksA['status'] = $status;
				$tasksA['category'] = $taskCat;
				$tasksA['assigner'] = $assigner;
				array_push($tasks, $tasksA);


			}

			return $tasks;

	}

	public function getTaskCategoryInfo ( $linkID, $categoryID ) {
		$catQ = "
		SELECT
			id,
			name,
			description
		FROM
			taskcategories
		WHERE
			id = ".mysqli_real_escape_string($linkID, $categoryID);

		if ( ! $catR = mysqli_query($linkID, $catQ) ) {
			$this->errorMsg = "A database error occured. Could not retrieve tasks category.";
			$this->debugErrorMsg = mysqli_error($linkID);
			return false;
		}

		return mysqli_fetch_assoc($catR);

	}

	public function getTaskStatuses ( $linkID, $taskID, $active = true ) {
		$taskStatuses = array();

		$statusQ = "
		SELECT
			ts.id,
			ts.timeStamp,
			ts.userID AS 'changedBy',
			tes.name,
			tes.description
		FROM
			taskstatuses ts
		LEFT JOIN
			teamstatuses tes
		ON
			ts.statusID = tes.id
		WHERE
			taskID = ".mysqli_real_escape_string($linkID, $taskID)."
		AND
			active = ".mysqli_real_escape_string($linkID, (int)$active);

		if ( ! $statusR = mysqli_query($linkID, $statusQ) ) {
			$this->errorMsg = "A database error occured. Could not retrieve tasks status.";
			$this->debugErrorMsg = mysqli_error($linkID);
			return false;
		}

		if ( mysqli_num_rows($statusR) == 1 ) {
			$taskStatuses = mysqli_fetch_assoc($statusR);
		} else {
			while ( $statusA = mysqli_fetch_assoc($statusR) ) {
				array_push($taskStatuses, $statusA);
			}
		}

		return $taskStatuses;

	}

	public function getErrorMsg () {
		return $this->errorMsg;
	}

	public function getDebugErrorMsg () {
		return $this->debugErrorMsg;
	}

}

?>
