<?php


$connects = [
    "test"=>[
        "host"=>"localhost",
        "user"=>"root",
        "pass"=>"",
        "db"=>"test",
    ]
];

$current_connect = $connects['test'];
$db_link = mysqli_connect($current_connect['host'],$current_connect['user'], $current_connect['pass'], $current_connect['db']);


// Base sql function
function sql($sql){
    global $db_link;
    $result = mysqli_query($db_link, $sql);
    return $result;
} // func

function mr2array($result){
    $i=0;$ret = array();
    while ($row = $result->fetch_assoc()){
        foreach ($row as $key => $value){
            $ret[$i][$key] = $value;
        }
        $i++;
    }
    return ($ret);
} // func


function findInArr($data, $where){
    if($where and is_array($where) and count($where)>0){
        if($data and is_array($data) and count($data)>0){
            $result=[];
            foreach($data as $row){
                $find_flag = 1;
                foreach($where as $k=>$v){
                    if(!isset($row[$k])){ $find_flag=0; break; }
                    if(is_string($row[$k])){
                        if(strcasecmp(trim($row[$k]), trim($v))!=0){ $find_flag=0; break; }
                    }else{
                        if($row[$k]!=$v){ $find_flag=0; break; }
                    }
                } // foreach where
                if($find_flag == 1){ $result[] = $row; }
            } // foreach data
            return (count($result)>0)?$result:false;
        } // if isset result
    } // if isset where
    return false;
} // func
