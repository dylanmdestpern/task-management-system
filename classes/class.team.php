<?php

class Team {
    
    private $errorMsg;
    private $debugErrorMsg;
    
    private $teamInfo;
    
    function __construct ( $linkID = null, $teamID = null ) {
        if ( ! $linkID == null && $teamID == null ) {
            $this->teamInfo = getTeamInfoArray($linkID, $teamID);
        }
    }
    
    function getTeamInfo ( $linkID, $teamID ) {
        
        //SELECT teaminfo.* FROM teaminfo JOIN teamusers ON teaminfo.id = teamusers.teamId WHERE teamusers.userId = 1;
        
        $sql = "SELECT * FROM teaminfo WHERE id = ".mysqli_real_escape_string($linkID, $teamID);
        if ( ! $teamInfoR = mysqli_query($linkID, $sql) ) {
            $this->errorMsg = "A database error occured. Could not retrieve team info. Please contact your administrator.";
            $this->debugErrorMsg = mysqli_error($linkID);
            return false;
        }
        
        if ( mysqli_num_rows($teamInfoR) < 1 ) {
            $this->errorMsg = "The team does not exist. Please contact your administrator.";
            return false;
        }
        
        return mysqli_fetch_assoc($teamInfoR);
    }
    
    function getTeamInfoArray ( $linkID, $teamID ) {
        return $this->teamInfo;
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
    
    function getErrorMsg () {
        return $this->errorMsg;
    }
    
    function getDebugErrorMsg () {
        return $this->debugErrorMsg;
    }
    
}

?>