<?php
date_default_timezone_set('UTC');

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    echo json_encode([
        'POST'=>$_POST,
        'now' => new DateTime(@$_POST['now']),
    ]);
    die;
}

?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Example - convert local time to UTC and back</title>
  </head>
  <body>
    <form id="form" method="POST" action="" onsubmit="return submitForm(event)">
        <input type="text" id="textDateTime" name='textDateTime' data-value="<?php echo (new DateTime())->format('Y-m-d\TH:i:s.v\Z'); ?>">
        <input type="datetime-local" id="datetime" name='datetime' data-value="<?php echo (new DateTime())->format('Y-m-d\TH:i:s.v\Z'); ?>">
        <input type="date" id="date" name='date' data-value="<?php echo (new DateTime())->format('Y-m-d\TH:i:s.v\Z'); ?>">
        <input type="time" id="time" name='time' data-value="<?php echo (new DateTime())->format('Y-m-d\TH:i:s.v\Z'); ?>">
        <input type="submit">
    </form>
    <script>
        function formatDate(d) { // ISO 8601 date (2020-05-11T22:02:07.275+02:00)
            return d.getFullYear() + '-' +
            d.getMonth().toString().padStart(2, '0') + '-' +
            d.getDate().toString().padStart(2, '0') + 'T' +
            d.getHours().toString().padStart(2, '0') + ':' +
            d.getMinutes().toString().padStart(2, '0') + ':' +
            d.getSeconds().toString().padStart(2, '0') + '.' +
            d.getMilliseconds().toString().padStart(3, '0') + '+' +
            (-d.getTimezoneOffset()/60).toString().padStart(2, '0')+':'+
            (-d.getTimezoneOffset()%60).toString().padStart(2, '0');
        }

        function submitForm(e) {
            e.preventDefault();
            var formData = new FormData();
            formData.append('now', new Date(document.getElementById('textDateTime').value).toISOString());
            formData.append('textDateTime', new Date().toISOString());
            formData.append('datetime', new Date(document.getElementById("datetime").value).toISOString()); // convert local time to UTM
            formData.append('time', new Date(document.getElementById("date").value+' '+document.getElementById("time").value).toISOString());  // convert local time to UTM         

            fetch('utc-time.php', {
                method: 'POST',
                body: formData,
            });

            return false;
        }

        function init() {
            var date = new Date(document.getElementById('textDateTime').dataset.value); // convert UTM to local time 
            document.getElementById('textDateTime').value = formatDate(date);

            var date = new Date(document.getElementById('datetime').dataset.value); // convert UTM to local time 
            date.setMinutes(date.getMinutes() - date.getTimezoneOffset()); // convert local time to datetime-local format
            document.getElementById('datetime').value = date.toISOString().slice(0,16);

            var date = new Date(document.getElementById('date').dataset.value); // convert UTM to local time 
            date.setMinutes(date.getMinutes() - date.getTimezoneOffset()); // convert local time to datetime-local format
            document.getElementById('date').value = date.toISOString().slice(0,10);

            var date = new Date(document.getElementById('time').dataset.value); // convert UTM to local time 
            date.setMinutes(date.getMinutes() - date.getTimezoneOffset()); // convert local time to datetime-local format
            document.getElementById('time').value = date.toISOString().slice(11,16);
        }

        window.addEventListener("load", init);

    </script>

  </body>
</html>
