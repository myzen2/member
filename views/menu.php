<?php
session_start();
require 'header.php';
 ?>
<div class="nav">

 <nav class="dropdownmenu">
  <ul>
    <li><a href="../index.php">Accueil</a></li>
    <li><a href="apropos.php">A propos de nous</a></li>
    <li><a href="#">Articles on HTML5 & CSS3</a>
      <ul id="submenu">
        <li><a href="http://www.jochaho.com/wordpress/difference-between-svg-vs-canvas/">Difference between SVG vs. Canvas</a></li>
        <li><a href="http://www.jochaho.com/wordpress/new-features-in-html5/">New features in HTML5</a></li>
        <li><a href="http://www.jochaho.com/wordpress/creating-links-to-sections-within-a-webpage/">Creating links to sections within a webpage</a></li>
      </ul>
    </li>
    <li><a href="http://www.jochaho.com/wordpress/category/news/">News</a></li>
    <li><a href="http://www.jochaho.com/wordpress/about-pritesh-badge/">Contact Us</a></li>
  </ul>
</nav>
<nav class="dropdownmenuright">
 <ul>
   <li><img class="avatar" src="../img/004-man-user.png"></li>
   <li><a>Mon Compte</a>
     <ul id="submenu">
       <li><a href="login.php">Login</a></li>
       <li><a href="register.php">Register</a></li>
       <li><a href="profile.php">My account</a></li>
       <li><a href="index.php">Logout</a></li>
     </ul>
 </ul>
</nav>
</div>
