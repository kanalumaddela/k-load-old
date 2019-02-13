<?php if(!isset($login)) {die();} ?>
<?php if ($_SERVER['QUERY_STRING'] == 'admin') { ?>
        <div class="col s12 m6 l4">
            <div class="card">
                <div class="card-content">
                    <span class="card-title"><i class="mdi mdi-database left"></i>MySQL Tools</span>
                    <p>You should only need to run these once.</p>
                </div>
                <div class="card-action row">
                    <a class="col s12 waves-effect waves-light btn tooltipped tool" href="#modal_bottom" data-user_type="admin" data-post="test_conn" data-tooltip="Tests connection the MySQL Server">test connection</a>
                    <a class="col s12 waves-effect waves-light btn tooltipped tool" href="#modal_bottom" data-user_type="admin" data-post="create_db" data-tooltip="Creates the needed tables">create database</a>
                    <a class="col s12 waves-effect waves-light btn tooltipped tool" href="#modal_bottom" data-user_type="admin" data-post="create_tables" data-tooltip="Creates the needed tables">create tables</a>
                    <a class="col s12 waves-effect waves-light btn tooltipped tool" href="#modal_bottom" data-user_type="admin" data-post="wipe_tables" data-tooltip="Drops/deletes the tables">wipe tables</a>
                </div>
            </div>
        </div>
        <div class="col s12 m6 l8">
            <div class="card">
                <div class="card-content">
                    <span class="card-title"><i class="mdi mdi-bank left"></i>Banning</span>
                    <p>Prevent certain users from customizing the loading screen.</p>
                </div>
                <div class="card-action row">
                    <div class="input-field col s12">
                        <input id="steamid1" class="col s12 l8" type="text" class="validate">
                        <label for="steamid1">Enter a steamid (STEAM:ID)</label>
                        <a class="col s12 l3 waves-effect waves-light btn tooltipped tool" href="#modal_bottom" data-user_type="admin" data-post="ban_user" data-bantype="ban" data-tooltip="Bans the user">ban user</a>
                    </div>
                    <div class="input-field col s12">
                        <input id="steamid2" class="col s12 l8" type="text" class="validate">
                        <label for="steamid2">Enter a steamid (STEAM:ID)</label>
                        <a class="col s12 l3 waves-effect waves-light btn tooltipped tool" href="#modal_bottom" data-user_type="admin" data-post="unban_user" data-bantype="unban" data-tooltip="Unbans the user">unban user</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s12 m3 clearfix">
            <div class="card">
                <div class="card-content">
                    <span class="card-title"><i class="mdi mdi-tool left"></i>Tools</span>
                    <p>Small tools to make minor changes. Some of these don't include any feedback.</p>
                </div>
                <div class="card-action row">
                    <a class="col s12 waves-effect waves-light btn tooltipped" onclick="fixbasepath()" data-tooltip="Fixes basepath.txt if you've moved the location of the loading screen">fix basepath.txt</a>
                </div>
            </div>
        </div>
<?php } else if ($_SERVER['QUERY_STRING'] == 'logs') { ?>
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <span class="card-title"><i class="mdi mdi-format-align-left left"></i>Error Logs</span>
                    <p>Will show any mysql errors that have occurred.</p>
                </div>
                <div class="card-action row">
                    <a class="col s12 m3 waves-effect waves-light btn tooltipped tool" href="#modal_bottom" data-user_type="admin" data-post="wipe_logs" data-tooltip="Clear the error log">wipe logs</a>
                    <pre id="logs" class="col s12"><?php if ( !empty(file_get_contents("../".$error_log_file)) ) { echo file_get_contents("../".$error_log_file); } else {echo 'There are no logs.';} ?></pre>
                </div>
            </div>
        </div>
<?php } ?>