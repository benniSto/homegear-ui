<?php
/* Copyright 2013-2019 Homegear GmbH
 *
 * Smart Home Interface (Shif, homegear-ui) is free software: you can
 * redistribute it and/or modify it under the terms of the GNU Lesser
 * General Public License as published by the Free Software Foundation,
 * either version 3 of the License, or (at your option) any later version.
 * 
 * Shif is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.

 * You should have received a copy of the GNU Lesser General Public
 * License along with Shif.  If not, see
 * <http://www.gnu.org/licenses/>.
*/

  ////////////////////////////////////////////////////////////////////////////////////////////////////////
  // Settings
  ////////////////////////////////////////////////////////////////////////////////////////////////////////
  // Fehlermeldungen im DemoModus unterdrücken, damit die Statusrückgabe angezeigt werden kann
  error_reporting($interfaceData["settings"]["errorReporting"]);

?>

<!DOCTYPE html>
<html lang="de" dir="ltr">
<head>
    <title>Shif - <?php echo $interfaceData["options"]["firstBreadcrumb"]; ?></title>
    <meta charset="UTF-8">
    <meta name="author" content="Homegear GmbH" />
    <meta name="keywords" content="Shif" />
    <meta name="description" content="Shif" />
    <meta name="publisher" content="Homegear GmbH" />
    <meta name="robots" content="noindex, nofollow" />
    <meta name="viewport" id="viewport" content="width=device-width, height=device-height, initial-scale=0.65, minimum-scale = 0.65,  maximum-scale = 0.65, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="application-name" content="Shif">
    <meta name="short_name" content="Shif">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="theme-color" content="#333">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <link rel="manifest" href="manifest.json">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
    <link rel="icon" sizes="36x36" href="media/logo/icon/smarthome36.png">
    <link rel="icon" sizes="48x48" href="media/logo/icon/smarthome48.png">
    <link rel="icon" sizes="72x72" href="media/logo/icon/smarthome72.png">
    <link rel="icon" sizes="96x96" href="media/logo/icon/smarthome96.png">
    <link rel="icon" sizes="144x144" href="media/logo/icon/smarthome144.png">
    <link rel="icon" sizes="128x128" href="media/logo/icon/smarthome128.png">
    <link rel="icon" sizes="192x192" href="media/logo/icon/smarthome192.png">
    <link rel="apple-touch-icon" sizes="128x128" href="media/logo/icon/smarthome128.png">
    <link rel="apple-touch-icon-precomposed" sizes="128x128" href="media/logo/icon/smarthome128.png">
    <link rel="apple-touch-startup-image" href="media/logo/icon/smarthome128.png">
<?php
if (file_exists("style.vendor.css")) {
    echo '    <link href="style.vendor.css" rel="stylesheet" type="text/css">'."\n";
}
else {
    die("Vendor style file is missing!");
}

echo '<style>'."\n";
echo userStyle();
echo'</style>'."\n";

echo '
    <script type="text/javascript">
';

if (class_exists('\Homegear\Homegear')) {
    $hg_interfaceData = homegear_init();
    foreach($interfaceData["i18n"] as $key => $value){
        $hg_interfaceData["i18n"]["languages"][$key]["name"] = $value["settings.user.manage.language.name"];
    }
    echo "var interfaceData = ".json_encode($hg_interfaceData, JSON_PRETTY_PRINT).";"."\n";
    
}
else {
    echo 'console.log("HOMEGEAR PHP API NOT FOUND!");'."\n";
    echo clean_json_to_js()."\n";
}

echo '</script>';
?>
</head>
<body>
  <div id="loadingPage">
    <div class="loadingWrapper">
      <svg version="1.1" id="ani_logo" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="104.9px" height="104.9px" viewBox="0 0 104.9 104.9" enable-background="new 0 0 104.9 104.9" xml:space="preserve">
        <g>
          <polygon points="52.2,44 28.7,64 28.7,103.9 74.6,103.9 74.6,64" />
          <g>
            <path class="ani_logo_stroke ani_logo_stroke_1" fill="none" stroke-width="3" stroke-miterlimit="10" d="M12.4,19.2C22.8,9.1,36.9,2.9,52.5,2.9c15.5,0,29.6,6.2,40,16.2"/>
            <path class="ani_logo_stroke ani_logo_stroke_2" fill="none" stroke-width="3" stroke-miterlimit="10" d="M32.6,39.4c5.2-5.1,12.2-8.2,20.1-8.2c7.7,0,14.6,3,19.8,7.9"/>
            <path class="ani_logo_stroke ani_logo_stroke_3" fill="none" stroke-width="3" stroke-miterlimit="10" d="M22.6,29.3c7.7-7.5,18.3-12.1,29.9-12.1c11.6,0,22.1,4.6,29.8,12"/>
          </g>
        </g>
      </svg>
    </div>
  </div>

  <div id="breadcrumbs_wrapper">
    <div id="breadcrumbs">
      <div id="back" class="inactive" onclick="content(this, {'back':'1'});">
        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" id="svg" x="0" y="0" width="370.81" height="370.81" viewBox="0 0 370.81 370.81" xml:space="preserve" enable-background="new 0 0 370.814 370.814">
          <polygon points="292.92 24.85 268.78 0 77.9 185.4 268.78 370.81 292.92 345.96 127.64 185.4 "/>
        </svg>
      </div><div id="breadcrumbsSub"><div class="breadcrumbsJump" onclick='content(this, {"back":"0"});'></div></div>
    </div>
  </div>

  <div id="inhalt">
    <div id="house" class="content">
      <?php tabs("".i18n("house.tab.rooms")."*;".i18n("house.tab.devices")."", '{"id":"house"}'); ?>
      <div id="houseJS" class="tabWrapper activeTab">
      </div>
      <div class="tabWrapper">
        <shif-all-devices></shif-all-devices>
      </div>
    </div>
    <div id="widgets" class="content"></div>
    <div id="settings" class="content"></div>
    <div id="log" class="content"></div>
  </div>

<?php
  if (file_exists("icons.js")) {
      echo '<script src="icons.js"></script>';
  } 
  else {
      die("App icon file is missing!");
  }

  if (file_exists("script.vendor.js")) {
      echo '<script src="script.vendor.js"></script>';
  } 
  else {
      die("Vendor script file is missing!");
  }

  if (file_exists("script.min.js")) {
      echo '<script src="script.min.js"></script>';
  } 
  elseif (file_exists("script.js")) {
      echo '<script src="script.js"></script>';
  } 
  else {
      die("App script file is missing!");
  }

  if (isset($javascript_options)) {
    echo '<script>'.$javascript_options.'</script>';
  }
?>

</body>
</html>
