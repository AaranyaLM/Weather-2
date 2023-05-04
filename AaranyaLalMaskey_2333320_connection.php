<?php
    
  function conmysql($data,$city){
      $hostname="localhost";
      $username="root";
      $password="";
      $dbname="weather app 2";
      $con = mysqli_connect($hostname, $username, $password, $dbname);
      if (!$con) {
          die("Sorry, Connection failed: " . mysqli_connect_error());
        }
        entry($con,$data,$city);
     }


  function city($city){
      $url = "https://api.openweathermap.org/data/2.5/weather?q=" . $city . "&units=metric&appid=9b6d0aa88d6f133dc229ec48ec83c0fe";
      $curl = curl_init($url);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($curl);
      if(!$response){
        die("Connection Failure");
      }
      $json = json_decode($response);
      if($json->cod != 200){
        echo "Error No Data Found!!";
      } 
      else {
          $data = file_get_contents($url);
          $data = json_decode($data, true);
          conmysql($data,$city);
      }
      curl_close($curl);
  }

  function entry($mysql,$data,$city){
    $cityname = $data['name'];
    $temp = $data['main']['temp'];
    $humidity = $data['main']['humidity'];
    $windspeed = $data['wind']['speed'];
    $description = $data['weather'][0]['description'];
    $main = $data['weather'][0]['main'];
    $pressure = $data['main']['pressure'];
    $feels_like = $data['main']['feels_like'];
    $sql = "INSERT INTO weather (id, cityname, temp, humidity, windspeed, description, main, pressure, feels_like) VALUES (1, '$cityname', $temp, $humidity, $windspeed, '$description', '$main', $pressure, $feels_like)";
    $sql2="DELETE FROM weather";
    $sql3="UPDATE weather SET id = 1";
    mysqli_query($mysql,$sql2);
    mysqli_query($mysql,$sql3);
    mysqli_query($mysql,$sql);
    for ($i=1; $i<=7; $i++) {
        $end_date=(new DateTime())->sub(new DateInterval('P'.($i-1).'D'))->format('Y-m-d');
        $start_date = (new DateTime())->sub(new DateInterval('P'.$i.'D'))->format('Y-m-d');
        $urlhis="https://api.weatherbit.io/v2.0/history/daily?city=" . $city . "&start_date=".$start_date."&end_date=".$end_date."&key=84261a640ccc4156ac16f25e37b53693";
        $Data = file_get_contents($urlhis);
        $Data = json_decode($Data, true);
        $temp=$Data['data'][0]['temp'];
        $cityname=$Data['city_name'];
        $datetime=$Data['data'][0]['datetime'];
        $sql = "INSERT INTO weather (id, cityname, temp, humidity, windspeed, description, main, pressure, feels_like, datetime) VALUES ($i+1, '$cityname', $temp, 0, 0, 'description value', '0', 0, 0, '$datetime')";
        mysqli_query($mysql,$sql);
    }
    retrive($mysql,$data,$Data);
    }
    
    function retrive($mysql,$data,$Data){
        global $city_name1, $temp1, $humidity1, $windspeed1, $description1, $main1, $pressure1, $feels_like1, $temp2;
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
    
        for ($i=2;$i<=8;$i++){
            $sql="SELECT temp FROM weather WHERE id=$i";
            $row=mysqli_fetch_assoc(mysqli_query($mysql, $sql));
            $temp2[$i-2]=$row['temp'];
        }
  }
  
  if ( isset($_GET['search']) ) 
  {
      $Searched_City_Name = $_GET['search'];
      
     // Redirect to the weather app since form submission will navigate the user away from this page
      header("Location: LeejaSagarShrestha.php?passed_city_name=" . urlencode($Searched_City_Name));
      exit();
  }
  
  if (!isset($_GET['passed_city_name'])) {
      $cityName = "Ayelsbury Vale";
  } 
  else  {
      $cityName = $_GET['passed_city_name'];
      city($cityName);
  }

?>