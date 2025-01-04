<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tool Detail Page</title>
  <link rel="stylesheet" href="css/tool.css">
</head>
<body>
    
    <header class="header">
        <div class="header-container">
            <h1 class="title">ToolTrek</h1>
            <div class="header-buttons">
                <?php
                if (isset($_SESSION['userEmail'])) {
                    echo '<a href="logout.php"><button class="hbtn login">Log Out</button></a>';
                } else {
                    echo '<a href="signup.php"><button class="hbtn signup">Sign Up</button></a>';
                    echo '<a href="login.php"><button class="hbtn login">Login</button></a>';
                }
                
                ?>
            </div>
        </div>
    </header>
    
<div class="content">

    <div class="tool-header">
        <img src="https://static.vecteezy.com/system/resources/previews/021/059/827/original/chatgpt-logo-chat-gpt-icon-on-white-background-free-vector.jpg" alt="Tool Icon">
        <div class="tool-header-content">
        <h1>ChatGPT (Tool Name)</h1>
        <p class="category">Category: AI Assistant</p>
        <div class="rating">
            <div class="stars">★★★★★</div>
            <span class="count">(4.8/5)</span>
        </div>
        </div>
        <hr>
    </div>
  <!-- Previews -->
  <div class="previews">
    <img src="https://s3.amazonaws.com/media.mediapost.com/dam/cropped/2023/02/03/screen-shot-2023-02-03-at-92545-am_cD0mMB3.png" alt="Preview 1">
    <img src="https://miro.medium.com/v2/resize:fit:700/1*helr4CAS8UYA6Au9p8oskw.png" alt="Preview 2">
  </div>
<hr>
  <!-- Details -->
  <div class="details">
    <h2>Details</h2>
    <br>
    <p><strong>Price:</strong> Free / Paid</p>
    <p><strong>Category:</strong> AI Tool</p>
    <p><strong>Top Features:</strong> Content creation, coding assistance, customer support</p>
    <p><strong>Compatibility:</strong> Web, Windows, iOS, Android</p><br>

    <!-- Access Links -->
    <p><strong><u>Access Links</u>:</strong></p><br>
    <p>Web Link: <a href="https://www.chatgpt.com" target="_blank">Visit Tool</a></p>
    <div class="buttons">
      <a href="https://apps.microsoft.com/detail/9nt1r1c2hh7j">Download for Windows</a>
      <a href="https://apps.apple.com/us/app/chatgpt/id6448311069">Download for iOS</a>
      <a href="https://play.google.com/store/apps/details?id=com.openai.chatgpt&pcampaignid=pcampaignidMKT-Other-global-all-co-prtnr-py-PartBadge-Mar2515-1">Download for Android</a>
    </div>
  </div>

  <!-- How to Use -->
 
  <div class="how-to-use">
  <h2>How to Use?</h2>
  <p>Learn how to use ChatGPT through the following resources:</p>
  
  <!-- Embedded Video -->
  <div class="video-container">
    <iframe 
        width="300" 
        height="170" 
        src="https://www.youtube.com/embed/BErxU9o_gOk?si=iqCBX1LY7-epRVDp" 
        title="How to Use ChatGPT" 
        frameborder="0" 
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
        allowfullscreen>
      </iframe>
  </div>

  <!-- Documentation Link -->
  <div class="buttons">
    <a href="https://www.wikihow.com/Use-Chat-Gpt" target="_blank">Read Documentation</a>
  </div>
</div>



  <!-- FAQs -->
  <div class="faq">
    <h2>FAQs</h2>
    <input type="text" placeholder="Search for answers...">
  </div>
</div>

</html>
</body>