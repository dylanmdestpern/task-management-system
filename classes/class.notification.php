<?php

class notification{

	private $errorMsg;
    private $debugErrorMsg;

	public function __construct() {
	}

	function getUserUnreadNotificationCount ( $linkID, $userID ) {
		$notifCountQ = "
		SELECT
			count(*) AS notifCount
		FROM
			notifications
		WHERE
			userID = ".mysqli_real_escape_string($linkID, $userID)."
		AND
			notifRead = 0
		AND
			notifSeen = 0";

		if ( ! $notifCountR = mysqli_query($linkID, $notifCountQ) ) {
			$this->errorMsg = "A database error occured. Could not retrieve notification count.";
			$this->debugErrorMsg = mysqli_error($linkID);
			return false;
		}

		return mysqli_fetch_assoc($notifCountR)['notifCount'];
	}

	function getUserNotifications ( $linkID, $userID, $page ) {
		$notifQ = "
		SELECT
			*
		FROM
			notifications
		WHERE
			userID = ".mysqli_real_escape_string($linkID, $userID)."
		AND
			notifRead = 0
		AND
			notifSeen = 0";

		if ( ! $notifR = mysqli_query($linkID, $notifQ) ) {
			$this->errorMsg = "A database error occured. Could not retrieve notifications";
			$this->debugErrorMsg = mysqli_error($linkID);
			return false;
		}

		if ( mysqli_num_rows($notifR) == 0 ) {
			return true;
		}

		$notifArray = array();
		while ( $notifA = mysqli_fetch_assoc($notifR) ) {
			array_push($notifArray, $notifA);
		}

		return $notifArray;
	}

	function getErrorMsg () {
		return $this->errorMsg;
	}

	function getDebugErrorMsg () {
		return $this->debugErrorMsg;
	}

}

?>
