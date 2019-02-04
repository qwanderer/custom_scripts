<?php






function getMinLev($string, $data){
    $lev_results = [];
    $string_l = trim(strtolower($string));
    foreach($data as $word){
        $word_l = trim(strtolower($word));
        $lev_distance = levenshtein($string_l, $word_l);
        if(isset($lev_results[$lev_distance])){
            $lev_results[$lev_distance] .= ",".$word;
        }else{
            $lev_results[$lev_distance] = $word;
        }
    } // foreach

    ksort($lev_results);
    return each($lev_results);
} // func



