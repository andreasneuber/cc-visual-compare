<?php

/**
 * Class make_screenshots_Cest
 *
 * @group make
 */
class make_screenshots_Cest {


    public function _before(AcceptanceTester $I)
    {
    }

    public function _after(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {

        if ( $file = fopen("urls.txt", "r" )  or die('Could not open urls.txt file') ) {

            $now_folder = $I->create_now_folder( $I );

            while( !feof($file) ) {

                $url = fgets($file);
                $I->amOnUrl( rtrim( $url ) );
                $I->wait_for_document_ready();

                $image_name = $I->url_2_image_name( $url );
                $I->makeScreenshot( $image_name );

                $cmd = 'cp tests/_output/debug/' . $image_name .'.png  ' . 'shots/' . $now_folder . '/' . $image_name . '.png';
                $I->runShellCommand( $cmd );
            }
            fclose($file);
        }
    }
}
