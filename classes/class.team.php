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
        
        //SELECT teaminfo.* FROM teaminfo JOIN teamusers ON teaminfo.id = teamusers.teamId WHERE teamusers.userId = 1;
        
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
    
    function getErrorMsg () {
        return $this->errorMsg;
    }
    
    function getDebugErrorMsg () {
        return $this->debugErrorMsg;
    }
    
}

?>