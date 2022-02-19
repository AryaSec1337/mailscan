<?php
echo "\e[91m        _______\n";
echo "\e[91m      _/       \_\n";
echo "\e[91m     / |       | \ \n";
echo "\e[91m    /  |__   __|  \ \n";
echo "\e[91m   |__/((o| |o))\__|\n";
echo "\e[91m   |      | |      |\n";
echo "\e[91m   |\     |_|     /|\n";
echo "\e[91m   | \           / |\n";
echo "\e[91m    \| /  ___  \ |/\n";
echo "\e[91m     \ | / _ \ | /\n";
echo "\e[91m      \_________/\n";
echo "\e[91m       _|_____|_\n";
echo "\e[91m  ____|_________|____\n";
echo "\e[91m /___________________\  -- \e[92mMailscan v1.0\e[0m\n";

echo "\n";
echo "\e[96mAuthor     : Arya Alfahrezy (Mr.TenAr)\e[0m\n";
echo "\e[96mTeam       : Dark Clown Security\e[0m\n";
echo "\e[96mUsage      : Enter the domain you want to scan\e[0m\n";
echo "\n";
echo "\e[92mAryaSec@domain > \e[0m";
$input_nama = fopen("php://stdin","r");
$nama = trim(fgets($input_nama));

echo "\e[92m#####  Searchiing In Target (33%)\e[0m\r";
sleep(10);
echo "\e[92m#############             (66%)\e[0m\r";
sleep(5);
echo "\e[92m#######################   (100%)\e[0m\r";
echo "\n";

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.hunter.io/v2/domain-search?domain=". $nama ."&api_key=f321d790c5683da1ae369c7a36537cbd4fc1dfa8",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if($err){
    echo "cURL Error". $err;
}else{
    $data = json_decode($response, TRUE);
    echo "\n";
    echo " \e[92mInformation Domain\e[0m\n";
    echo " \e[92mDomain     :\e[91m".$data['data']['domain'] . "\e[0m\n";
    echo " \e[92mOrganisasi :\e[91m".$data['data']['organization'] . "\e[0m\n";
    echo " \e[92mNegara     :\e[91m". $data['data']['country'] . "\e[0m\n";
    echo "\n";
    foreach($data['data']['emails'] as $key => $result)
    {
        echo "\n";
        echo "\e[92mEmail         : \e[91m". $result['value']. "\e[0m\n";
        echo "\e[92mType Email    : \e[91m". $result['type']. "\e[0m\n";
        echo "\e[92mNama Depan    : \e[91m". $result['first_name']. "\e[0m\n";
        echo "\e[92mNama Belakang : \e[91m". $result['last_name']. "\e[0m\n";
        echo "\e[92mPosisi        : \e[91m". $result['position']. "\e[0m\n";
    }
    echo "\n";
    echo "\e[92m#######################\e[0m\n";
    echo "\e[92mResult Emails\e[0m\n";
    echo "\e[92m#######################\e[0m\n";
    foreach($data['data']['emails'] as $key => $result)
    {
        echo "\n";
        echo "\e[91m". $result['value'] ."\e[0m";
    }

}
?>
