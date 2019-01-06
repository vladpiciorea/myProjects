<?php
// initializare curl
$curl = curl_init();

$search_string = '?yt=2015&co=1';
$url = 'https://lajumate.ro/anunturi_autoturisme.html'.$search_string;
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($curl);

preg_match_all('!https://lajumate.ro/[^\s]*?.html!', $result, $matches);
preg_match_all('!<i>Preţ</i>[^\s]*? [^\s]*?</span>!', $result, $price);

$i = 0;
$data = array();
foreach($matches as $k => $vs) {
    foreach($vs as $match){

    // Elimin linkurile nefolositore
    $check_1 = strpos($match,'anunturi');
    $check_2 = strpos($match,'tag');
    $check_3 = strpos($match,'promovare');
    $check_4 = strpos($match,'aplicatie');
    $check_5 = strpos($match,'validare');
    $check_6 = strpos($match,'spoturi');
    
    
    if($check_1 != 20 && $check_2 != 20 && $check_3 != 20 && $check_4 != 20 && $check_5 != 20 && $check_6 != 20) {
        // Compunere url img
        $match = substr($match, 20);
        $match = explode('.', $match);
        $code = substr($match[0], -7);   
        $first_code = substr($code, 0, 3);
        $name = substr($match[0],0, -8);
        $img_url = 'https://media2.lajumate.ro/media/i/cart/1/'. $first_code . '/' . $code. '_'. $name . '_1.jpg';

        // Compunere nume produs
        $name_pod = str_replace('-', ' ', $name);

        // Compunere url produs
        $match_html = 'https://lajumate.ro/' . $match[0];

        // Compunere pret produs
        $price_prod = $price[0][$i];
        $price_prod = substr($price_prod, 4);
        $price_prod = substr($price_prod, 4);
        $i++;
        $data[] = ['img' =>$img_url,
                    'name' => $name_pod,
                    'html' => $match_html,
                    'price' => $price_prod];
        // var_dump($arr_img);
        
    }
    }
    var_dump($data);
}
curl_close($curl);
// https://www.okazii.ro/autoturisme/?at%5B422001%5D%5Bmax%5D=2012
// https://media1.lajumate.ro/media/i/cart/0/691/6918570_opel-astra-h-17-cdti-110-cp_1.jpg
// https://media1.lajumate.ro/media/i/cart/6/832/8324396_tobe-scutere-maxi-scuter-50-250-cc_1.jpg
// https://media2.lajumate.ro/media/i/cart/5/831/8311795_audi-a8-42tdi-quattro-430cp_1.jpg
?>
