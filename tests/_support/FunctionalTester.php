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
class FunctionalTester extends \Codeception\Actor
{
    use _generated\FunctionalTesterActions;

   /**
    * Define custom actions here
    */

    public function create_sub_dirs_name_array(){
        return $dirs = array_filter( glob('shots/*' ), 'is_dir' );
    }

    public function prepare_failing_test_data( $file , $similarity_level ){
        return array( 'level' => $similarity_level , 'url' => 'http://' . substr( $file , 0, -4 ) );
    }

}
