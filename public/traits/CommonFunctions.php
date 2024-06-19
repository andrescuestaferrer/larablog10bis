<?php
namespace Public\traits ;
use \Exception;

trait CommonFunctions {

  private function showToastr($message, $type){
    return $this->dispatch('showToastr', 
        type : $type,
        message : $message
    );
  }

}

?>
