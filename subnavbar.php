<?php 
   error_reporting(0);
?>
<!DOCTYPE html>
<head>
   <meta charset="utf-8">
   <link rel="icon" href="style/PUPLogo.png" class="icon">
   <link rel="stylesheet" href="style/subnavbar.css">
   <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <style>
      #notif{
         font-weight: 300;
         font-size: 18px;
         font-style: normal;
      }

      .append{
         font-weight: 300;
         font-size: 18px;
         font-style: normal;
      }
   </style>
</head>
<body>
   <nav>
      <ul>
         <li class="logo">Section</li>
         <li class="items <?php if (basename($_SERVER['PHP_SELF']) == 'dcrf.php') echo 'active'; ?>">
            <a href="dcrf.php">
            <i class="fa-solid fa-border-all menuIcon"></i> DCRF</a>
         </li>
         <li class="items <?php if (basename($_SERVER['PHP_SELF']) == 'index.php') echo 'active'; ?>">
            <a href="index.php">
            <i class="fa-regular fa-file menuIcon"></i> Documented Information</a>
         </li>
         <li class="items <?php if (basename($_SERVER['PHP_SELF']) == 'trackFile.php') echo 'active'; ?>">
            <a href="trackFile.php">
            <i class="fa-solid fa-file-contract menuIcon"></i> Track Document</a>
         </li>
         <li class="items <?php if (basename($_SERVER['PHP_SELF']) == 'inbox.php') echo 'active'; ?>">
            <a href="inbox.php">
               <i class="fa-solid fa-inbox menuIcon"></i> Inbox <i class="append">(</i><i id="notif"></i><i class="append">)</i>
            </a>
         </li>
         <li class="items <?php if (basename($_SERVER['PHP_SELF']) == 'filehistory.php') echo 'active'; ?>" >
            <a href="filehistory.php">
            <i class="fa-solid fa-clock-rotate-left menuIcon"></i> History</a>
         </li>
         <li class="btn"><a href="#"><i class="fas fa-bars"></i></a></li>
      </ul>

   </nav>
   <script>
      $(document).ready(function(){
        $('.btn').click(function(){
          $('.items').toggleClass("show");
          $('ul li').toggleClass("hide");
        });
      });
   </script>

   <script>
      function loadDoc() {
         setInterval(function(){
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
               if (this.readyState == 4 && this.status == 200) {
               document.getElementById("notif").innerHTML = this.responseText;
               }
            };
            xhttp.open("GET", "inbox-notif.php", true);
            xhttp.send();
         },10);
         }
      loadDoc();
   </script>

</body>
</html>