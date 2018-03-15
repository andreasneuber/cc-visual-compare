<?php


class compare_screenshots_Cest {


    public function _before(AcceptanceTester $I)
    {
    }

    public function _after(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
        // Whats supposed happening here?

        // 1) Check if there are 2 different folders in dir  shots/ at all

        // 2) Figure out which one of these 2 folders is older

        // 3) If more than 2 dirs, delete old dirs and just keep 2 newest ones

        // 4) Iterate through files of older folder and compare with each file in newer folder, using a "file similarity" method

        /*
        if ($file = fopen("urls.txt", "r")) {

            while( !feof($file) ) {

                $url = fgets( $file );

            }
            fclose($file);
        }
        */
    }
}
