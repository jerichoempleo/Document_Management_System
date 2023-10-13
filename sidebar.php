<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
   
    <link rel="stylesheet" href="style/sidebar.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  
 

  <div class="sidebar">
    <div class="logo-details">
        <i class="fa-regular fa-folder-open icon"></i>
        <div class="logo_name">Section</div>
        <i class="fa-solid fa-bars" id = "btn"></i>
    </div>
    <ul class="nav-list">
     
      <li>
        <a href="#">
        <i class="fa-solid fa-border-all menuIcon"></i>
          <span class="links_name">DCRF</span>
        </a>
         <span class="tooltip">DCRF</span>
      </li>
      <li>
       <a href="#">
        <i class="fa-regular fa-file"></i>
         <span class="links_name">Documented Information</span>
       </a>
       <span class="tooltip">Documented Information</span>
     </li>
     <li>
       <a href="#">
        <i class="fa-solid fa-file-contract"></i>
         <span class="links_name">Track Documents</span>
       </a>
       <span class="tooltip">Track Documents</span>
     </li>
     <li>
       <a href="#">
        <i class="fa-solid fa-inbox"></i>
         <span class="links_name">Inbox</span>
       </a>
       <span class="tooltip">Inbox</span>
     </li>
     <li>
       <a href="#">
        <i class="fa-solid fa-clock-rotate-left"></i>
         <span class="links_name">Document History</span>
       </a>
       <span class="tooltip">Document History</span>
     </li>
     
    </ul>
  </div>
  
  

<!-- <script>
  let sidebar = document.querySelector(".sidebar");
  let closeBtn = document.querySelector("#btn");

  closeBtn.addEventListener("click", ()=>{
    sidebar.classList.toggle("open");
    menuBtnChange();
  });

</script> -->
  

</body>
</html>
