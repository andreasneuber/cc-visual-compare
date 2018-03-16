<?php


/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method \Codeception\Lib\Friend haveFriend($name, $actorClass = NULL)
 *
 * @SuppressWarnings(PHPMD)
*/
class AcceptanceTester extends \Codeception\Actor
{
    use _generated\AcceptanceTesterActions;

   /**
    * Define custom actions here
    */

   public function url_2_image_name( $url , $debug=false ){

       $arr = explode( "://" , trim( $url) );

       if( $debug ){ print_r( $arr ); }

       if(substr( $arr[1] , -1) == '/') {
           $arr[1] = substr( $arr[1], 0, -1);
       }

       return $image_name = str_replace( '/' , '_' , $arr[1] );
   }

   public function create_now_folder( $I ){
       $now = date("Y-m-d_H:i:s");
       $I->runShellCommand( 'mkdir shots/' . $now );
       return $now;
   }

   public function create_sub_dirs_name_array(){
       return $dirs = array_filter( glob('shots/*' ), 'is_dir' );
   }

   public function prepare_failing_test_data( $file , $similarity_level ){
       return array( 'level' => $similarity_level , 'url' => 'http://' . substr( $file , 0, -4 ) );
   }

   public function output_failing_test_data_in_console( $failing_test_data ){
       echo "\n";
       echo "\n";
       echo '====================================================================================================';
       echo "\n";

       foreach( $failing_test_data as $filename => $value ){
           echo 'File: '. $filename .' -> ' . $value['level'];
           echo "\n";
       }

       echo "\n";
       echo "\n";
       echo '====================================================================================================';
       echo "\n";

   }

   public function create_test_report( $failed , $failing_test_data ){

        $myfile = fopen("TEST_RESULTS.html", "w") or die("Unable to open file!");

        $txt = "<html><head><title>TEST - RESULTS</title></head><body>" . "\n";
        fwrite($myfile, $txt);

        if( $failed ){
            $txt = "<h1 style='color: red;'>Test failed</h1>";
            fwrite($myfile, $txt);

            foreach( $failing_test_data as $filename => $value ){
                $txt = "<div>" . 'File: '. $filename .' -> ' . $value['level'] . " | <a href='" . $value['url'] . "'>" . $value['url']. "</a></div>";
                fwrite($myfile, $txt);
            }
        }
        else {
            $txt = "<h1 style='color: green;'>Test failed</h1>";
            fwrite($myfile, $txt);
        }

        $txt = "</body></html>" . "\n";
        fwrite($myfile, $txt);

        fclose($myfile);
    }
}
