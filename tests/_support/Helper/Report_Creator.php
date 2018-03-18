<?php
namespace Helper;


class Report_Creator {

    const FILENAME_HTML = 'TEST_RESULTS.html';
    const TITLE_HTML = 'TEST - RESULTS';

    const LINEBREAK_CHAR = "\n";
    const SEPERATOR_LINE_CHAR = '=';


    public function __construct(){
    }


    public function output_failing_test_data_in_console( $failing_test_data ){

        $this->echo_linebreak( 2 );
        $this->echo_linebreak();
        $this->echo_separator_line();
        $this->echo_linebreak();

        foreach( $failing_test_data as $filename => $value ){
            echo 'File: '. $filename .' -> ' . $value['level'];
            $this->echo_linebreak();
        }

        $this->echo_linebreak( 2 );
        $this->echo_separator_line();
        $this->echo_linebreak();
    }


    public function create_test_report( $failed , $failing_test_data=null ){

        $myfile = fopen(self::FILENAME_HTML , "w" ) or die( "Unable to open " . self::FILENAME_HTML );

        $txt = "<html><head><title>" . self::TITLE_HTML . "</title></head><body>" . "\n";
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
            $txt = "<h1 style='color: green;'>Test passed</h1>";
            fwrite($myfile, $txt);
        }

        $txt = "</body></html>" . "\n";
        fwrite($myfile, $txt);

        fclose( $myfile );
    }


    // Helpers for the helper

    private function echo_linebreak( $number_linebreaks=1 ){

        for( $counter = 0; $counter < $number_linebreaks; $counter++ ){
            echo self::LINEBREAK_CHAR;
        }

    }

    private function add_linebreak(){
        return self::LINEBREAK_CHAR;
    }

    private function echo_separator_line( $num_separator_chars=100 ){

        for( $counter = 0 , $separator_line = self::SEPERATOR_LINE_CHAR; $counter < $num_separator_chars; $counter++ ){
            $separator_line .= self::SEPERATOR_LINE_CHAR;
        }
        echo $separator_line;
    }
}
