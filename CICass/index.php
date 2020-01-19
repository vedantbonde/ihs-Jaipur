<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Frontend</title>
    <link rel="stylesheet" href="css/main.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
</head>
<body>
    <div id="main">
        <form action="http://34.67.124.135/Travel-Yatri/itinerary.php">
            <input id="city_search" type="text" name="city" placeholder = "City">
            <br>

            <input id="start_date" type="datetime-local" name="start">
            <input id="end_date" type="datetime-local" name="end">
            <br>

            <input id="submit_button" type="submit" value="Plan my Trip">

            <script type="text/javascript">
                var d = new Date();
                var month = d.getMonth();
                var month_actual = month + 1;

                if (month_actual < 10) {
                    month_actual = "0" + month_actual; 
                }

                var day_val = d.getDate();
                if (day_val < 10) {
                    day_val = "0" + day_val; 
                }
                
                document.getElementById("start_date").value = d.getFullYear()+"-"+month_actual+"-"+(day_val+1)+"T12:00:00";
                document.getElementById("end_date").value = d.getFullYear()+"-"+month_actual+"-"+(day_val+3)+"T18:00:00";
            </script>
            

            
        </form>
    </div>
            
</body>