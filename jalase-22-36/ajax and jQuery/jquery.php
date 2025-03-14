<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <title>jQuery</title>
</head>

<body>
    <!-- مثال تغییر متن -->
     <h1>Heading</h1>
     <button id="changeTextBtn">Change Text</button>
     <p id="textExample">متن اصلی اینجا است</p>

     <!-- مثال در مورد تغییر استایل -->
      <h2>Heading</h2>
      <button id="changeStyleBtn">Change Style</button>
      <p id="styleExample">متن ا��لی اینجا ا��ت</p>

        <!-- نمایش یا پنهان کردن متن -->
         <button id="toggleVisibilityBtn">Toggle Visibility</button>
         <p id="visibilityExample">متن اینجا ا�ت</p>

        <!-- مثال انیمیشن -->
         <button id="showHideBtn">Show/Hide</button>
         <p id="showHideExample">متن اینجا ا�ت</p>

         <!-- مثال انیمشن 2  -->
          <button id="animationBtn">Animation</button>
          <div id="animationExample" style="width: 100px; height:100px; background:blue;"></div>
          


</body>
</html>

<script>
    $(document).ready(function(){
        $('#changeTextBtn').click(function(){
            $('#textExample').text('متن مورد نظر تغییر کرد');
        });
    })

    $(document).ready(function(){
        $('#changeStyleBtn').click(function(){
            $('#styleExample').css('color','red');
        });
    })

    $(document).ready(function(){
        $('#toggleVisibilityBtn').click(function(){
            $('#visibilityExample').toggle();
        });
    })


    $(document).ready(function(){
        $('#showHideBtn').click(function(){
            $('#showHideExample').slideToggle();
        });
    })


    $(document).ready(function(){
        $('#animationBtn').click(function(){
            $('#animationExample').animate({width: '200px', height: '200px'}, 1000)
                                  .animate({width: '100px', height: '100px'}, 1000);
        });
    })
 </script>
    
</script>

</script>

