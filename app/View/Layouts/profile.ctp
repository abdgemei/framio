<?php //pr($this->params); die;
if (!Configure::read('debug')):
    throw new NotFoundException();
endif;
App::uses('Debugger', 'Utility');
?>
<?php $cakeDescription = __d('cake_dev', 'Framio'); ?>
<!DOCTYPE HTML>
<html>
<head>
    <?php echo $this->Html->charset(); ?>
    <title>
        <?php echo $title_for_layout; ?> |
        <?php echo $cakeDescription ?>
    </title>
    <?php echo $this->Html->meta('icon');
          echo $this->Html->css('bootstrap');
          //echo $this->Html->css('style');
          echo $this->Html->css('profile');
          echo $this->Html->script('jquery-2.0.2.min');
          echo $this->fetch('meta');
          echo $this->fetch('css');
          echo $this->fetch('script');
    ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <script type="text/javascript">
    <!--
$(document).ready(function(){

if($(window).width() > 1120 ){
$('.prev_page').clone().prependTo('body').addClass('prev_big').html('&lsaquo;');
$('.next_page').clone().prependTo('body').addClass('next_big').html('&rsaquo;');
};

});
// -->
    </script>
  
<!-- <meta name="author" content="Nouran zedan" />
    <meta name="description" content="Framio profile page, Social network and photography publishing platform in Egypt for users to share there photos and upload them to their own gallery" />
    <meta name="keywords" content="framio, user, profile, photographer, photos,photography social sharing, gallery, username, Brain grey" /> -->
</head>

<body>
<div id="container">
<nav id="bar"><h1>Framio</h1>
<ul><br/>
<li><a href="">Upload</a></li>
<li><a href="">Messages</a></li>
<li><a href="">Notification</a></li>
</ul>
<img src="/images/bar_03.png"/>
</nav>

<header id="greybar">
<img src="/images/profilepic_03.jpg"/>
<h2>Brain Grey<br/>Egypt,Alexandria<br><a href="">www.Braingrey.com</a><br/>Member since 2013</h2><br/>
<button type="submit" id="hoverbtn" ><img src="images/images/images/images/images/icon_06.png"/>Follow</button>

<ul class="followers">
<li>Followers <p>300</p></li>
<li>Following <p>20</p></li>
<li>Likes <p>1050</p></li>
<li>Views <p>13668</p></li>
</ul>

</header>



<aside id="asidebar">
<ul>
<li><a href="friends.html">Friends</a></li>
<li><a href="">Favorites</a></li>
<li><a href="">Featured Content</a></li>
<li><a href="">Featured Albums</a></li>
<li><a href="">Category</a></li>
</ul>
<img src="images/images/images/images/asidebar_06.jpg"/></aside>

<aside id="darkgreybar">
<ul>
    <li> <img src="images/images/images/leaves.jpg" width="175" height="131" alt="green leaves">
    <span> <!--span contains the popup image-->
<img src="images/images/images/leaves.jpg " width="348" height="262" alt="green leaves" /> <!--popup image-->
<br />21 likes <!--caption appears under the popup image-->
</span></li>

    <li><img src="images/images/images/boats.jpg" width="175" height="131" alt="shimp in the forest"/>
    <span> <!--span contains the popup image-->
<img src="images/images/images/boats.jpg" width="348" height="262" alt="shimp in the forest" /> <!--popup image-->
<br />30 likes <!--caption appears under the popup image-->
</span></li>

    <li><img src="images/images/images/lights.jpg" width="175" height="131" alt="bulb"/>
    <span><img src="images/images/images/lights.jpg" width="348" height="262" alt="bulb"/> <br />60 likes</span></li>
    
    <li><img src="images/images/images/girlondock.jpg" width="175" height="131" alt="lake and trees"/>
    <span><img src="images/images/images/girlondock.jpg" width="348" height="262" alt="lake and trees"/> <br />60 likes</span></li>
    
    <li><img src="images/images/images/farm.jpg" width="175" height="131"  alt="farm"/>
    <span><img src="images/images/images/farm.jpg" width="348" height="262" alt="farm"/> <br />100 likes</span></li>
    
    <li><img src="images/images/images/boatview.jpg" width="175" height="131"  alt="sea view"/>
    <span><img src="images/images/images/boatview.jpg" width="348" height="262" alt="sea view"/> <br />50 likes</span></li>
    
    <li><img src="images/images/images/sunset.jpg" width="175" height="131" alt="mountains and the sea"/>
     <span><img src="images/images/images/sunset.jpg" width="348" height="262" alt="mountains and the sea"/> <br />30 likes</span></li>
    
    <li><img src="images/images/images/snowforest.jpg" width="175" height="131" alt="snow forest"/>
     <span><img src="images/images/images/snowforest.jpg" width="348" height="262" alt="snow forest"/> <br />70 likes</span></li>
     
    <li><img src="images/images/images/alarmclock.jpg" width="175" height="131" alt="alarm clock"/>
     <span><img src="images/images/images/alarmclock.jpg" width="348" height="262"alt="alarm clock"/> <br />70 likes</span></li>
    
    <li><img src="images/images/images/guitar.jpg" width="175" height="131" alt="guitar under water"/>
    <span><img src="images/images/images/guitar.jpg" width="348" height="262" alt="guitar under water"/> <br />70 likes</span></li>
    
    <li><img src="images/images/images/protest.jpg"width="175" height="131" alt="people walking in the night"/>
    <span><img src="images/images/images/protest.jpg" width="348" height="262" alt="people walking in the night"/> <br />70 likes</span></li>
    
    <li><img src="images/images/images/flower.jpg" width="175" height="131" alt="flower"/>
    <span><img src="images/images/images/flower.jpg" width="348" height="262" alt="flower"/> <br />70 likes 1200 views</span></li>
    </ul>


<a class="prev_big" href="page1.html" title="View Previous Page">Previous</a>
<a class="next_big" href="page3.html" title="View Next Page">Next</a> 
<img src="/images/asidedarkbar_07.jpg"/>
</aside>

<?php echo $this->element('footer'); ?>