<?php


// echo "ISO : {$iso}\n";

$mti  = substr($iso, 0, 4);
$sisa = substr($iso, strlen($mti));
// echo "MTI : {$mti}\n";

$bitmaphex = substr($sisa,0,16);

$bitmap_length = base_convert($bitmaphex, 16, 2);
$bitmap_length = strlen($bitmaphex);
// echo "Panjang Bit Map    : {$bitmap_length}\n";

$bitmap_hex = substr($sisa, 0, $bitmap_length);
// echo "Bit Map (HEX)      : {$bitmap_hex}\n";

$bitmapbin = substr($sisa,0,16);
$bitmapbins = base_convert($bitmapbin, 16, 2);

$bitmap = '';
for ($i=0; $i<$bitmap_length; $i++) {
    $bitmap .= sprintf("%04d", base_convert($bitmap_hex[$i], 16, 2));
}
// echo "Bit Map            : {$bitmap}\n";

$active_data_element = array();
for ($i=0; $i<strlen($bitmap); $i++) {
    if($bitmap[$i]==1) $active_data_element[$i+1] = 'aktif';
}
// echo "Data Element Aktif : ";
// print_r ($active_data_element);

$sisa = substr($sisa, 16);
$str_data = $sisa;
// echo "Data : {$str_data}\n";

$iso_config = array(
    //bit ke => tipe, panjang, fix=0
    //bit ke => tipe, panjang, fix=0
    1   => array('b', 64, 0),
    2   => array('an', 19, 1),
    3   => array('n', 6, 0),
    4   => array('n', 12, 0),
    5   => array('n', 12, 0),
    6   => array('n', 12, 0),
    7   => array('an', 10, 0),
    8   => array('n', 8, 0),
    9   => array('n', 8, 0),
    10  => array('n', 8, 0),
    11  => array('n', 6, 0),
    12  => array('n', 6, 0),
    13  => array('n', 4, 0),
    14  => array('n', 4, 0),
    15  => array('n', 4, 0),
    16  => array('n', 4, 0),
    17  => array('n', 4, 0),
    18  => array('n', 4, 0),
    19  => array('n', 3, 0),
    20  => array('n', 3, 0),
    21  => array('n', 3, 0),
    22  => array('n', 3, 0),
    23  => array('n', 3, 0),
    24  => array('n', 3, 0),
    25  => array('n', 2, 0),
    26  => array('n', 2, 0),
    27  => array('n', 1, 0),
    28  => array('n', 8, 0),
    29  => array('an', 9, 0),
    30  => array('n', 8, 0),
    31  => array('an', 9, 0),
    32  => array('an', 11, 1),
    33  => array('n', 11, 1),
    34  => array('an', 28, 1),
    35  => array('z', 37, 1),
    36  => array('n', 104, 1),
    37  => array('an', 12, 0),
    38  => array('an', 6, 0),
    39  => array('an', 2, 0),
    40  => array('an', 3, 0),
    41  => array('ans', 8, 0),
    42  => array('ans', 15, 0),
    43  => array('ans', 40, 0),
    44  => array('an', 25, 1),
    45  => array('an', 76, 1),
    46  => array('an', 999, 1),
    47  => array('an', 999, 1),
    48  => array('ans', 999, 1),
    49  => array('an', 3, 0),
    50  => array('an', 3, 0),
    51  => array('a', 3, 0),
    52  => array('an', 16, 0),
    53  => array('an', 18, 0),
    54  => array('an', 120, 0),
    55  => array('ans', 999, 1),
    56  => array('ans', 999, 1),
    57  => array('ans', 999, 1),
    58  => array('ans', 999, 1),
    59  => array('ans', 99, 1),
    60  => array('ans', 60, 1),
    61  => array('ans', 99, 1),
    62  => array('ans', 999, 1),

);






// if(count($iso_config)!=count($active_data_element)) exit;

$data = array();
foreach ($active_data_element as $key=>$val) {
    if($iso_config[$key][0]!='b') {
        //fix length
        if($iso_config[$key][2]==0) {
            $tmp = substr($str_data, 0, $iso_config[$key][1]);
            if(strlen($tmp)==$iso_config[$key][1]) {
                if($iso_config[$key][0]=='n') {
                    $data[$key] = substr($str_data, 0, $iso_config[$key][1]);
                }
                else {
                    $data[$key] = ltrim(substr($str_data, 0, $iso_config[$key][1]));
                }
                $str_data = substr($str_data, $iso_config[$key][1], strlen($str_data)-$iso_config[$key][1]);
            }
        }
        //dynamic length
        else {
            $len = strlen($iso_config[$key][1]);
            $tmp = substr($str_data, 0, $len);
            if (strlen($tmp)==$len ) {
                $num = (integer) $tmp;
                $str_data = substr($str_data, $len, strlen($str_data)-$len);

                $tmp2 = substr($str_data, 0, $num);
                if (strlen($tmp2)==$num) {
                    if ($iso_config[$key][0]=='n') {
                        $data[$key] = (double) $tmp2;
                    }
                    else {
                        $data[$key] = ltrim($tmp2);
                    }
                    $str_data = substr($str_data, $num, strlen($str_data)-$num);
                }
            }
        }
    }
}

// echo "Ekstrak Data : ";
// print_r ($data);

$data487 = $data[48];
// $data11 = $data[11];
// $data37 = $data[37];




$session = new Zend_Session_Namespace('data');

$session->dat48 = $data487;
$session->dat11 = $data[11];
$session->dat4 = $data[4];
$session->dat39 = $data[39];

$no_va = substr ($data487 , 0, 16);
// $operator = substr ($data48, strlen($produkid), 4);
$nama = substr($data487, 16, 30);
$nbu    = substr ($data487, 46, 30);
$nkp = substr ($data487, 76, 13);
$ntd = substr ($data487, 95, 6);
$ntd1 = substr($ntd, 0, 3);
$ntd2 = substr($ntd, 3, 3);


$ntdd = substr($data487, 96, 5);
$ntdd1 = substr($ntdd, 0, 2);
$ntdd2 = substr($ntdd, 2, 3);


$digitt = substr($ntd, 0, 1);




$ba     = substr ($data487, 109, 4);


$total    = substr ($data487, 119, 6);
$total1 = substr($total, 0, 3);
$total2 = substr($total, 3, 3);

$totall    = substr ($data487, 120, 5);
$totall1 = substr($totall, 0, 2);
$totall2 = substr($totall, 2, 3);


$digit = substr($total, 0, 1);
$fjt  = substr ($data487, 125, 5);
$kjt  = substr ($data487, 130, 30);
$khd  = substr ($data487, 160, 15);
$kap  = substr ($data487, 175, 15);
$kpks  = substr ($data487, 190, 15);
?>