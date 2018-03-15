<?php if(!isset($login)) {die();} ?>
<?php
if ( !empty($_SERVER['QUERY_STRING']) ) {
    if ($_SERVER['QUERY_STRING'] == 'theming') {
?>
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <span class="card-title"><i class="mdi mdi-format-color-fill left"></i>Theme Layout/Colors</span>
                </div>
                <div class="card-action row">
                 <?php
                    foreach($themes_active as $theme) {
                        echo '<div class="col s6 m4 l3 xl2" style="margin-bottom:6px;">';
                        if ( file_exists('../themes/'.$theme['id'].'/'.$theme['id'].'.png') ) {
                            echo '<p class="col s12">'.$theme['name'].'</p>';
                            echo '<img class="col s12 materialboxed tooltipped" src="../themes/'.$theme['id'].'/'.$theme['id'].'.png" data-tooltip="'.$theme['desc'].'">';
                        } else {
                            echo '<p class="col s12">'.$theme['name'].'</p>';
                            echo '<p class="col s12">'.$theme['desc'].'</p>';
                            echo '<p>No Screenshot Available</p>';
                        }
                        echo '</div>';
                    }
                 ?>
                    <!--
                    <div class="col s6 m4 l3">
                        <p>Theme Name</p>
                        <img class="col s12 materialboxed" width="inherit" src="https://s-media-cache-ak0.pinimg.com/originals/1a/11/29/1a1129f2e5a5d58f5ea214b466cd3ce0.jpg">
                    </div>
                    -->
                    <div class="input-field col s12 tooltipped" data-tooltip="Loading screen layout to use">
                        <p>Layout Choice</p>
                        <select id="theme">
                        <?php
                        foreach($themes_active as $theme) {
                            if ($theme['id'] == $theme) {
                                echo '<option value="'.$theme['id'].'" selected>'.$theme['name'].'</option>';
                            } else {
                                echo '<option value="'.$theme['id'].'">'.$theme['name'].'</option>';
                            }
                        }
                        ?>
                        </select>
                    </div>
                    <div class="input-field col s12 m6 l3">
                        <p>Background Color</p>
                        <input id="color_bg" class="col s12 tooltipped jscolor {width:150, padding:10, shadow:true, borderWidth:0, borderRadius:2, backgroundColor:'rgba(0,0,0,0.5)', insetColor:'transparent'}" data-tooltip="Affects background of the entire page" value="<?php echo substr($color['background'],1); ?>" />
                    </div>
                    <div class="input-field col s12 m6 l3">
                        <p>Text Color</p>
                        <input id="color_text" class="col s12 tooltipped jscolor {width:150, padding:10, shadow:true, borderWidth:0, borderRadius:2, backgroundColor:'rgba(0,0,0,0.5)', insetColor:'transparent'}" data-tooltip="Affects all font colors" value="<?php echo substr($color['text'],1); ?>" />
                    </div>
                    <div class="input-field col s12 m6 l3">
                        <p>Primary Color</p>
                        <input id="color_primary" class="col s12 tooltipped jscolor {width:150, padding:10, shadow:true, borderWidth:0, borderRadius:2, backgroundColor:'rgba(0,0,0,0.5)', insetColor:'transparent'}" data-tooltip="Affects backgrounds of main content" value="<?php echo substr($color['primary'],1); ?>" />
                    </div>
                    <div class="input-field col s12 m6 l3">
                        <p>Secondary Color</p>
                        <input id="color_secondary" class="col s12 tooltipped jscolor {width:150, padding:10, shadow:true, borderWidth:0, borderRadius:2, backgroundColor:'rgba(0,0,0,0.5)', insetColor:'transparent'}" data-tooltip="Affects loading bar, borders, highlights" value="<?php echo substr($color['secondary'],1); ?>" />
                    </div>
                    <div class="input-field col s12" style="margin-bottom: 15px;">
                        <p>Background Type</p>
                        <p>
                            <input type="radio" id="bg_type_default" class="with-gap" name="background_type" onclick="checkBackgroundType()" value="0" <?php if ($user_bg_type == 0) {echo 'checked="checked"';} ?> />
                            <label for="bg_type_default">Default</label>
                        </p>
                        <p>
                            <input type="radio" id="bg_type_color" class="with-gap" name="background_type" onclick="checkBackgroundType()" value="1" <?php if ($user_bg_type == 1) {echo 'checked="checked"';} ?> />
                            <label for="bg_type_color">Color</label>
                        </p>
                        <p>
                            <input type="radio" id="bg_type_image" class="with-gap" name="background_type" onclick="checkBackgroundType()" value="2" <?php if ($user_bg_type == 2) {echo 'checked="checked"';} ?> />
                            <label for="bg_type_image">Image</label>
                        </p>
                    </div>
                    <div class="input-field col s12 <?php if ($user_bg_type != 2) {echo 'plz-hide';} ?>">
                        <input type="text" name="background_image" id="background_image" value="<?php echo $background['image']; ?>" />
                        <label for="background_image">Background Image (imgur links only)</label>
                    </div>
                    <div class="input-field col s12 center">
                        <a class="btn tool" href="#modal_bottom" data-user_type="member" data-post="save_theme">save changes</a>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
    if ($_SERVER['QUERY_STRING'] == 'media') {
?>
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <span class="card-title"><i class="mdi mdi-music left"></i>Music Settings</span>
                </div>
                <div class="card-action row">
                    <div class="input-field col s12" style="margin-bottom: 15px;">
                        <p>Music Type</p>
                        <p>
                            <input type="radio" id="music_type_default" class="with-gap" name="music_type" onclick="checkMusicType()" value="0" <?php if ($user_music_type == 0) {echo 'checked="checked"';} ?> />
                            <label for="music_type_default">Default</label>
                        </p>
                        <p>
                            <input type="radio" id="music_type_yt" class="with-gap" name="music_type" onclick="checkMusicType()" value="1" <?php if ($user_music_type == 1) {echo 'checked="checked"';} ?> />
                            <label for="music_type_yt">Youtube</label>
                        </p>
                    </div>
                    <div class="input-field col s12 m8">
                        <p>Youtube Playlist</p>
                        <input type="text" id="media_yt_playlist" class="tooltipped" data-tooltip="YouTube playlist URL" value="<?php echo "https://www.youtube.com/playlist?list=".$user_ytplaylist; ?>" />
                    </div>
                    <div class="input-field col s12">
                        <p>Volume (set 0 to disable)</p>
                        <p class="range-field">
                            <input type="range" id="media_volume" class="tooltipped" data-tooltip="Volume of any audio that plays" min="0" max="100" value="<?php echo $user_volume; ?>"/>
                        </p>
                    </div>
                    <div class="input-field col s12 center">
                        <a class="btn tool" href="#modal_bottom" data-user_type="member" data-post="save_media">save changes</a>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
    if ($_SERVER['QUERY_STRING'] == 'users') {
        echo '        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <span class="card-title"><i class="mdi mdi-account-multiple left"></i>User List</span>
                </div>
                <div class="card-action row">';
        getUserList();
        echo '</div></div></div>';
    }
?>
<?php
}
else if ( !isset($_SERVER['QUERY_STRING']) || empty($_SERVER['QUERY_STRING']) ) {
?>
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <span class="card-title">Welcome</span>
                    <p>This will be customizable soon.</p>
                </div>
            </div>
        </div>
<?php } ?>
