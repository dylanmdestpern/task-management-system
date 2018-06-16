<?php

class Team {

    private $errorMsg;
    private $debugErrorMsg;

    private $teaminfo;

    function __construct ( $linkID = null, $teamID = null ) {
        if ( ! $linkID == null && $teamID == null ) {
            $this->teaminfo = getteaminfoArray($linkID, $teamID);
        }
    }

    function getteaminfo ( $linkID, $teamID ) {

        //SELECT teaminfo.* FROM teaminfo JOIN teamusersON teaminfo.id = teamusers.teamId WHERE teamusers.userId = 1;

        $sql = "SELECT * FROM teaminfo WHERE id = ".mysqli_real_escape_string($linkID, $teamID);
        if ( ! $teaminfoR = mysqli_query($linkID, $sql) ) {
            $this->errorMsg = "A database error occured. Could not retrieve team info. Please contact your administrator.";
            $this->debugErrorMsg = mysqli_error($linkID);
            return false;
        }

        if ( mysqli_num_rows($teaminfoR) < 1 ) {
            $this->errorMsg = "The team does not exist. Please contact your administrator.";
            return false;
        }

        return mysqli_fetch_assoc($teaminfoR);
    }

    function getteaminfoArray ( $linkID, $teamID ) {
        return $this->teaminfo;
    }

    function getUserTeamIds ( $linkID, $userID ) {
        $sql = "SELECT
                    teaminfo.id
                FROM
                    teaminfo
                JOIN
                    teamusers
                ON
                    teaminfo.id = teamusers.teamId
                WHERE
                    teamusers.userId = ".mysqli_real_escape_string($linkID, $userID);

        if ( ! $teamIdsR = mysqli_query($linkID, $sql) ) {
            $this->errorMsg = "A database error occured. Could not retrieve user teams. Please contact your administrator.";
            $this->debugErrorMsg = mysqli_error($linkID);
            return false;
        }

        $returnArray = array();

        while ( $teamIdsA = mysqli_fetch_assoc($teamIdsR) ) {
            array_push($returnArray, $teamIdsA['id']);
        }

        return $returnArray;

    }

	function addTeam (  ) {

	}

	function getTeamUsers ( $linkID, $teamId ) {

	}

	function getUserTeamRole ( $linkID, $teamID, $userID ) {
		$sql = "SELECT
					role
				FROM
					teamusers
				WHERE
					userId = ".mysqli_real_escape_string($linkID, $userID)."
				AND
					teamId = ".mysqli_real_escape_string($linkID, $teamID);

		if ( ! $userTeamRoleR = mysqli_query($linkID, $sql) ) {
			$this->errorMsg = "A database error occured. Could not retrieve user team role. Please contact your administrator";
			$this->debugErrorMsg = mysqli_error($linkID);
			return false;
		}

		if ( mysqli_num_rows($userTeamRoleR) == 0 ) {
			$this->errorMsg = "User role was not found. Please contact a team administrator.";
			$this->debugErrorMsg = "This occors when no a role has been assigned without a teamID.";
			return false;
		} elseif ( mysqli_num_rows($userTeamRoleR) > 1 ) {
			$this->errorMsg = "User role is invalid. Please contact a team administrator.";
			$this->debugErrorMsg = "This occors when more than 1 role has been assigned for a user for a single team.";
			return false;
		}

		return mysqli_fetch_assoc($userTeamRoleR)['role'];

	}

	function getRoleFriendlyName ( $role ) {
		switch ( $role ) {
			case 'owner':
				return "Owner";
				break;
			case "member":
				return "Member";
				break;
			case "admin":
				return "Administrator";
				break;
			default:
				// code...
				break;
		}
	}

    function getErrorMsg () {
        return $this->errorMsg;
    }

    function getDebugErrorMsg () {
        return $this->debugErrorMsg;
    }

}

?>
