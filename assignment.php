<?php
function print_histogram($even, $odd){
    $max_count = max($even, $odd);

    for( $i = $max_count; $i > 0; $i--){
        $even_char = ($i<= $even) ? '<span style="color:green"></span>':'';
        $odd_char = ($i<= $odd) ? '<span style="color:red"></span>':'';

        echo str_pad($even_char, $even * 2) . str_pad($odd_char, $odd  * 2) . "\n";

    }
}
$even_count = 0;
$odd_count = 0;

for($i = 0; $i <= 9; $i++){
    if($i % 2 == 0){
        $even_count++;
    }else{
        $odd_count++;
    }
}
print_histogram($even_count, $odd_count);
?>
