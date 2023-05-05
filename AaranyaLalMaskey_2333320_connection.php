<?php
function city($city){
    $url = "https://api.openweathermap.org/data/2.5/weather?q=" . $city . "&units=metric&appid=9b6d0aa88d6f133dc229ec48ec83c0fe";
    $data = file_get_contents($url);
    $data = json_decode($data, true);
    conmysql($data,$city);
}


function conmysql($data,$city){
    $localhost = "localhost";
    $username = "root";
    $password = "";
    $dbname = "weather app 2";
    $mysql = mysqli_connect($localhost, $username, $password, $dbname);
    entry($mysql,$data,$city);
}

function entry($mysql,$data,$city){
    
    $cityname = $data['name'];
    $temp = $data['main']['temp'];
    $humidity = $data['main']['humidity'];
    $windspeed = $data['wind']['speed'];
    $description = $data['weather'][0]['description'];
    $main = $data['weather'][0]['icon'];
    $pressure = $data['main']['pressure'];
    $feels_like = $data['main']['feels_like'];
    $country = $data['sys']['country'];
    $sql = "INSERT INTO weather (id, cityname, temp, humidity, windspeed, description, main, pressure, feels_like, country) VALUES (1, '$cityname', $temp, $humidity, $windspeed, '$description', '$main', $pressure, $feels_like, '$country')";
    $sql2="DELETE FROM weather";
    $sql3="UPDATE weather SET id = 1";
    mysqli_query($mysql,$sql2);
    mysqli_query($mysql,$sql3);
    mysqli_query($mysql,$sql);
    for ($i=1; $i<=7; $i++) {
        $date = (new DateTime())->sub(new DateInterval('P'.$i.'D'))->format('Y-m-d');
        $url = "https://api.openweathermap.org/data/2.5/weather?q=$city&appid=9b6d0aa88d6f133dc229ec48ec83c0fe&dt=$date";
    
        $data = file_get_contents($url);
        $data = json_decode($data, true);
    
        $temp_kelvin = $data['main']['temp'];
        $temp_celsius = round($temp_kelvin - 273.15, 2);
        $cityname = $data['name'];
        $datetime = date('Y-m-d H:i:s', $data['dt']);
    
        $sql = "INSERT INTO weather (id, cityname, temp, humidity, windspeed, description, main, pressure, feels_like, country, datetime) VALUES ($i+1, '$cityname', $temp_celsius, 0, 0, '0', '0', 0, 0, '0', '$datetime')";
        mysqli_query($mysql, $sql);
    }
    
    retrive($mysql,$data);
}

function retrive($mysql,$data){
    global $city_name1, $temp1, $humidity1, $windspeed1, $description1, $main1, $pressure1, $feels_like1, $country1, $temp2;
    $sql="SELECT cityname FROM weather WHERE id=1";
    $row=mysqli_fetch_assoc(mysqli_query($mysql, $sql));
    $city_name1=$row['cityname'];
    $sql="SELECT temp FROM weather WHERE id=1";
    $row=mysqli_fetch_assoc(mysqli_query($mysql, $sql));
    $temp1=$row['temp'];
    $sql="SELECT humidity FROM weather WHERE id=1";
    $row=mysqli_fetch_assoc(mysqli_query($mysql, $sql));
    $humidity1=$row['humidity'];
    $sql="SELECT windspeed FROM weather WHERE id=1";
    $row=mysqli_fetch_assoc(mysqli_query($mysql, $sql));
    $windspeed1=$row['windspeed'];
    $sql="SELECT description FROM weather WHERE id=1";
    $row=mysqli_fetch_assoc(mysqli_query($mysql, $sql));
    $description1=$row['description'];
    $sql="SELECT main FROM weather WHERE id=1";
    $row=mysqli_fetch_assoc(mysqli_query($mysql, $sql));
    $main1=$row['main'];
    $sql="SELECT pressure FROM weather WHERE id=1";
    $row=mysqli_fetch_assoc(mysqli_query($mysql, $sql));
    $pressure1=$row['pressure'];
    $sql="SELECT feels_like FROM weather WHERE id=1";
    $row=mysqli_fetch_assoc(mysqli_query($mysql, $sql));
    $feels_like1=$row['feels_like'];
    $sql="SELECT country FROM weather WHERE id=1";
    $row=mysqli_fetch_assoc(mysqli_query($mysql, $sql));
    $country1=$row['country'];
    for ($i=2;$i<=8;$i++){
        $sql="SELECT temp FROM weather WHERE id=$i";
        $row=mysqli_fetch_assoc(mysqli_query($mysql, $sql));
        $temp2[$i-2]=$row['temp'];
    }
}
if ( isset($_GET['search']) ) 
{
    $Searched_City_Name = $_GET['search'];
    header("Location: AaranyaLalMaskey_2333320_index.php?passed_city_name=" . urlencode($Searched_City_Name));
    exit();
}

if (!isset($_GET['passed_city_name'])) {
    $cityName = "Aylesbury Vale";
} 
else  {
    $cityName = $_GET['passed_city_name'];
    
}
city($cityName);
?>