<?php
namespace Helper;


class Compare_Images {


    public function __construct(){
    }


    /**
     * Returns array with mime type and if its jpg or png. Returns false if it isn't jpg or png
     *
     * @param $filename
     * @return array|bool $return;
     */
    private function get_mime_type( $filename ){

        $mime   = getimagesize( $filename );
        $return = array($mime[0],$mime[1]);

        switch ($mime['mime'])
        {
            case 'image/jpeg':
                $return[] = 'jpg';
                return $return;
            case 'image/png':
                $return[] = 'png';
                return $return;
            default:
                return false;
        }
    }

    /**
     * Returns image resource or false if its not jpg or png
     *
     * @param $i
     * @return bool|resource
     */
    private function create_image( $i ){

        $mime = $this->get_mime_type( $i );

        if($mime[2] == 'jpg')
        {
            return imagecreatefromjpeg ($i);
        }
        else if ($mime[2] == 'png')
        {
            return imagecreatefrompng ($i);
        }
        else
        {
            return false;
        }
    }

    /**
     * Resizes the image to a 8x8 square and returns as image resource
     *
     * @param $i
     * @param $source
     * @return resource
     */
    private function resize_image( $source ){

        $mime                   = $this->get_mime_type( $source );
        $d_img_link_resource    = imagecreatetruecolor(8, 8);

        $source = $this->create_image( $source );

        imagecopyresized( $d_img_link_resource, $source, 0, 0, 0, 0, 8, 8, $mime[0], $mime[1] );

        return $d_img_link_resource;
    }

    /**
     * Returns the mean value of the colors and the list of all pixel's colors
     *
     * @param $i
     * @return array
     */
    private function get_color_mean_value( $i ){
        $colorList = array();
        $colorSum = 0;
        for($a = 0;$a<8;$a++) {

            for($b = 0;$b<8;$b++) {
                $rgb = imagecolorat($i, $a, $b);
                $colorList[] = $rgb & 0xFF;
                $colorSum += $rgb & 0xFF;
            }

        }

        return array($colorSum/64,$colorList);
    }

    /**
     * Returns array with 1 and zeros. If a color is bigger than the mean value of colors it is 1
     *
     * @param $color_mean
     * @return array
     */
    private function get_bits( $color_mean ){

        $bits = array();

        foreach( $color_mean[1] as $color){
            $bits[]= ($color>=$color_mean[0])?1:0;
        }

        return $bits;
    }

    /**
     * Returns the hammering distance based on bit value of two provided images
     *
     * @param $image_1
     * @param $image_2
     * @return bool|int $hammering_distance
     */
    public function run_compare( $image_1 , $image_2 ){
        $i1 = $this->create_image( $image_1 );
        $i2 = $this->create_image( $image_2 );

        if(!$i1 || !$i2){
            return false;
        }

        $i1 = $this->resize_image( $image_1 );
        $i2 = $this->resize_image( $image_2 );

        imagefilter( $i1, IMG_FILTER_GRAYSCALE );
        imagefilter( $i2, IMG_FILTER_GRAYSCALE );

        $color_mean_1   = $this->get_color_mean_value( $i1 );
        $color_mean_2   = $this->get_color_mean_value( $i2 );
        $bits1          = $this->get_bits( $color_mean_1 );
        $bits2          = $this->get_bits( $color_mean_2 );

        $hammering_distance = 0;

        for( $a = 0; $a<64; $a++ ){
            if($bits1[$a] != $bits2[$a]){
                $hammering_distance++;
            }
        }

        return $hammering_distance;
    }
}
