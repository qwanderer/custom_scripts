<?php



function renderOutput($template, $data=[], $return_flag=1){
    if(file_exists($template.'.php')){
        ob_start();
        require_once($template.'.php');
        $return = ob_get_clean();
        if($return_flag==1){
            return $return;
        }else{
            echo $return;
        }
    }else{
        die("template not found: ".$template.'.php');
    }
} // func