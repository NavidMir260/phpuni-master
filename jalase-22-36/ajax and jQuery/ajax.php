<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AJAX</title>
    <script>
        function fetchData(){
            // ایجاد یک شی از نوع XMLHttpRequest
            const xhr = new XMLHttpRequest();

            // یک درخواست بصورت غیر همگام از طریق متد گت به فایلی که در لینک زیر آمده است
            xhr.open('GET', 'server.php', true);

                xhr.onload =function (){
                    if(xhr.status === 200 ){
                        const response  = JSON.parse(xhr.responseText);

                        document.getElementById("result").innerHTML = response.message + "Time:" + response.time;
                    }else {
                        document.getElementById("result").innerHTML = `Error: ${xhr.status}`;
                    }
                };
                xhr.send();
               }
    </script>
</head>
<body>
    <h1>Ajax Example</h1>
    <button onclick="fetchData()">دریافت اطلاعات از سرور یا بانک اطلاعاتی یا هر چیز دیگری بصورت آژاکس</button>
    <div id="result">اطلاعات دریافتی اینجا نمایش داده می شو</div>
</body>
</html>