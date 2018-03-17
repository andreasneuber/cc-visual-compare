<?php

use Helper\Compare_Images;
use Helper\Report_Creator;

/**
 * Class compare_screenshots_Cest
 *
 * @group compare
 */
class compare_screenshots_Cest {

    private $test_failed = false;

    private $failing_test_data = array();


    public function _before(AcceptanceTester $I){
        // Check if there are 2 folders in dir  shots/  - if 1 or more than 2 - stop script, tell user to either add 1 dir or delete older dirs
        // .. not very graceful and professional but for now should do the trick ..

        $total_dirs  = count( glob('shots/*', GLOB_ONLYDIR ) );
        if( $total_dirs != 2 ){
            $I->fail( 'You need exactly 2 directories under /shots/. Please correct.' );
        }
    }

    public function _after(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
        // Iterate through all files in one of the 2 shots/ dirs, and compare with files in other shots/ dir
        $this->iterate_through_images_and_establish_similarity_levels( $I );

        // Let pass or fail. If fail, explain why
        $this->digest_failing_test_data( $I );
    }


    // helpers
    private function iterate_through_images_and_establish_similarity_levels( AcceptanceTester $I , $debug=false ){

        $compare_images = new Compare_Images();

        $dirs = $I->create_sub_dirs_name_array();


        if ( $handle = opendir( $dirs[0] ) ) {
            while (false !== ($file = readdir($handle))) {
                if ('.' === $file || '..' === $file ) continue;

                $similarity_level = $compare_images->run_compare( $dirs[0] . '/' . $file , $dirs[1] . '/' . $file );

                if( $similarity_level > 0 ){    // 0 => may be too strict, perhaps higher tolerance level needed
                    $this->test_failed                  = true;
                    $this->failing_test_data[ $file ]   = $I->prepare_failing_test_data( $file , $similarity_level );
                }

                echo "-------------------------------------------------------------------" . "\n";
                echo $file . ' => similarity level: ' . $similarity_level;
                echo "\n";
            }
            closedir($handle);
        }

        echo "-------------------------------------------------------------------" . "\n";
    }


    private function digest_failing_test_data( AcceptanceTester $I ){

        $report_creator = new Report_Creator();

        if( $this->test_failed ){

            $report_creator->output_failing_test_data_in_console( $this->failing_test_data );

            $report_creator->create_test_report( $this->test_failed , $this->failing_test_data );

            $I->fail( 'Change in image has been detected. Check details in ' . $report_creator::FILENAME_HTML );
        }

    }

}
