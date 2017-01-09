<?php
$I = new AcceptanceTester($scenario);
$I->wantTo( 'Take screenshots of <name of website>' );

$I->runShellCommand( "mkdir ./_workspace" );

if ($file = fopen("urls.txt", "r")) {
    while(!feof($file)) {
        $url = fgets($file);
        $command = $I->generate_gnome_web_photo_cmd( $url );
        $I->runShellCommand( $command );
    }
    fclose($file);
}

// copy workspace folder
$right_now = date( "M-d-Y" );
$copy_cmd = "cp -r ./_workspace ./DestFolder";
$copy_cmd = str_replace( 'DestFolder', $right_now, $copy_cmd );
$I->runShellCommand( $copy_cmd );

// clear workspace
$I->runShellCommand( "rm -rf ./_workspace && rm -rf ./{$right_now}/_workspace" );
