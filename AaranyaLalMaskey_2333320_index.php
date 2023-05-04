<?php include "AaranyaLalMaskey_2333320_connection.php";?>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Boy</title>
    <script src="https://kit.fontawesome.com/1ae1db6a1d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/fontawesome.min.css">
</head>
<body>
    
    <div class="container">

        <div class="header">     
            <div class="search-container">
                <form method="GET" action="AaranyaLalMaskey_2333320_connection.php">
                    <input type="search" id="search" name="search" placeholder="Search your City">
                </form>
                
            </div>
        </div>   

        <div class="title" id="title">
            <h1>KTM</h1>
            <h2>2nd ap</h2>
        </div>
         <div class="weather-container">
            <div class="content" id="weather">
                <div class="row-1">
                    <img src="https://openweathermap.org/img/wn/<?php $main1?>@2x.png">

                    <div class="item-title"><?php echo $description1 ?></div>
                </div>
            
                <div class="row-2">
            
                    <div class="item">
                        <i class="fa-solid fa-temperature-three-quarters"></i>
                        <div class="item-title">
                            Temperature
                        </div>
                        <div class="item-content">
                            <?php echo $temp1 . "°C"; ?>
                        </div>
                    </div>
            
                    <div class="item">
                        <i class="fa-solid fa-gauge"></i>
                        <div class="item-title">
                            Pressure
                        </div>
                        <div class="item-content">
                        <?php echo "Pressure: " . $pressure1 . " hPa";?>
                        </div>
                    </div>
            
                    <div class="item">
                        <i class="fa-solid fa-wind"></i>
                        <div class="item-title">
                            Windspeed
                        </div>
                        <div class="item-content">
                            2km/h
                        </div>
                    </div>
            
                    <div class="item">
                        <i class="fa-solid fa-droplet"></i>
                        <div class="item-title">
                            Humidity
                        </div>
                        <div class="item-content">
                            2%
                        </div>
                    </div>
            
                    </div>
            </div>
               
            <div class="weather-history">
                <div class="day">
                    <div class="item-title">
                        <?php echo (new DateTime())->sub(new DateInterval('P1D'))->format('Y-m-d');?>
                    </div>
                    <div class="item-content">
                        2°C
                    </div>
                </div>

                <div class="day">
                    <div class="item-title">
                        <?php echo (new DateTime())->sub(new DateInterval('P1D'))->format('Y-m-d');?>
                    </div>
                    <div class="item-content">
                        Weather | 2°C
                    </div>
                </div>

                <div class="day">
                    <div class="item-title">
                        <?php echo (new DateTime())->sub(new DateInterval('P1D'))->format('Y-m-d');?>
                    </div>
                    <div class="item-content">
                        Weather | 2°C
                    </div>
                </div>

                <div class="day">
                    <div class="item-title">
                        <?php echo (new DateTime())->sub(new DateInterval('P1D'))->format('Y-m-d');?>
                    </div>
                    <div class="item-content">
                        Weather | 2°C
                    </div>
                </div>

                <div class="day">
                    <div class="item-title">
                        <?php echo (new DateTime())->sub(new DateInterval('P1D'))->format('Y-m-d');?>
                    </div>
                    <div class="item-content">
                        Weather | 2°C
                    </div>
                </div>

                <div class="day">
                    <div class="item-title">
                        <?php echo (new DateTime())->sub(new DateInterval('P1D'))->format('Y-m-d');?>
                    </div>
                    <div class="item-content">
                        Weather | 2°C
                    </div>
                </div>

                <div class="day">
                    <div class="item-title">
                        <?php echo (new DateTime())->sub(new DateInterval('P1D'))->format('Y-m-d');?>
                    </div>
                    <div class="item-content">
                       Weather | 2°C
                    </div>
                </div>
            </div>
         </div>
        
        <div class="footer">
            &#169; Made by Aaranya Maskey
        </div>
    </div>
</body>
</html>