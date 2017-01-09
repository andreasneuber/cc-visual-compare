<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo( 'Compare <name of your website> screenshots' );

/////////////////////////////// ENTER WHAT YOU WANT TO COMPARE //////////////////////////////////
$folder1    = 'Dec-27-2016';
$folder2    = 'Dec-28-2016';
/////////////////////////////// ENTER WHAT YOU WANT TO COMPARE //////////////////////////////////

$right_now  = date( "M-d-Y" );

if ($file = fopen("urls.txt", "r")) {
    while(!feof($file)) {
        $url    = fgets($file);
        $photo  = $I->prepare_output_photo_name( $url );
       echo  $command = "compare -compose src {$folder1}/{$photo}.png {$folder2}/{$photo}.png difference/{$right_now}-{$photo}-difference.png";
        $I->runShellCommand( $command );
    }
    fclose($file);
}