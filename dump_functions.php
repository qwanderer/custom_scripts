<?php

function d($data=[], $function="print_r"){
    if($function === 1){ $function = "var_dump"; }
    if(is_array($data) or is_object($data)){
        $web_suff = ['<pre>', '</pre>'];
        $cli_suff = ["", ""];
        $curr_suff = (is_cli())?$cli_suff:$web_suff;
        echo $curr_suff[0];
        $function($data);
        echo $curr_suff[1];
    }else{
        echo (is_cli())?"\n":"<br>";$function($data);
    }
} // func

function dd($data=[], $function="print_r"){d($data, $function);die;} // func

function wd($text, $function="print_r"){
    d($text, $function);
    while(1){sleep(1);}
} // func

function et($data, $with_line_numbers=0){
    if(!is_array($data) or !count($data)>0){ return "Table Error - data is not an array"; }
    $arr_keys = getMultiArrayKeys($data);
    $return = "<table border='1' cellpadding='5'>";
    $ln = ($with_line_numbers==1)?"<th>ln</th>":"";
    $headers = "<tr>$ln<th>".implode("</th><th>", $arr_keys)."</th></tr>";
    $table_data = "";$loop=0;
    foreach($data as $row){
        $loop++;
        $ln=($with_line_numbers==1)?"<td>$loop</td>":"";
        $table_data .= "<tr>$ln";
        foreach($arr_keys as $key){
            if(!isset($row[$key])){ $table_data .= "<td></td>";continue; }
            $td_data = (is_array($row[$key])) ? print_r($row[$key],1):$row[$key];
            $table_data .= "<td>".$td_data."</td>";
        }
        $table_data .= "</tr>";
    } // foreach
    echo $return.$headers.$table_data."</table>";
} // func

function etd($data, $with_line_numbers=0){
    et($data, $with_line_numbers);die;
} // func

function getMultiArrayKeys($data) {
    $keys=[];
    foreach($data as $k => $v) {
        is_int($k) OR $keys[]=$k;
        if (is_array($v)){
            $keys = array_merge($keys, getMultiArrayKeys($v));
        }
    }
    return array_unique($keys);
} // func

function is_cli(){
    return (PHP_SAPI==='cli' OR defined('STDIN'));
}