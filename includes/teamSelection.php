<?php
if ( ! isset($loggedUserTeamsIds) ) {
    header("Location: index.php");
}
?>
<div class="login-form">

    <h2>Team</h2>
    <hr/>
    <small class="form-text text-muted font-italic">Select a team to work with</small>
    <hr/>
    <form method="get">

        <div class="form-group">
            <label for="teamSelect">Select team</label>
            <select class="form-control" id="teamSelect" name="teamID">
                <?php
                    foreach ( $loggedUserTeamsIds as $loggedUserTeamsId ) {
                        $loggedUserteaminfo = $loggedUserTeamsIdsArray->getteaminfo($linkID, $loggedUserTeamsId);
						$userTeamRole = $loggedUserTeamsIdsArray->getUserTeamRole($linkID, $loggedUserTeamsId, $loggedUser['id']);
                        echo "<option value='".$loggedUserteaminfo['id']."'>".$loggedUserteaminfo['teamName']." (".$loggedUserTeamsIdsArray->getRoleFriendlyName($userTeamRole).")</option>";
                    }
                ?>
            </select>

            <div class="form-group">
            <br />
            <input type="hidden" name="action" value="setSessionTeamID">
            <div style="text-align:right"><button type="submit" class="btn btn-primary">Go</button></div>
            </div>

        </div>

    </form>

</div>
