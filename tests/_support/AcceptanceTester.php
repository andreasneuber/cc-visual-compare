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

}
