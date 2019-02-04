<?php





function getLinesAsGenerator($file) {
    $f = fopen($file, 'r');
    try {
        while ($line = fgets($f)) {
            $line =  trim(str_replace(["\n", "\r"], "", $line));
            if(strlen($line)>0){
                yield $line;
            }
        } // while
    } finally {
        fclose($f);
    }
}

