<?php
include 'db/conn.php';

// Get the tool ID from the query string
$tool_id = isset($_GET['tool_id']) ? (int) $_GET['tool_id'] : 0;

// Ensure a valid tool ID is provided
if ($tool_id <= 0) {
    die("Invalid tool ID.");
}

// Query to fetch tool details
$sql = "
    SELECT 
        t.name AS tool_name,
        c.name AS category_name,
        td.description,
        td.features,
        td.pricing,
        td.compatibility,
        td.official_link,
        td.desktop_link,
        td.android_link,
        td.ios_link,
        td.video_links,
        td.tool_icon_file_path,
        td.tool_preview_file_path
    FROM 
        tools t
    JOIN 
        tool_details td ON t.id = td.tool_id
    JOIN 
        categories c ON t.category_id = c.id
    WHERE 
        t.id = ? AND t.status = 'approved'
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $tool_id);
$stmt->execute();
$result = $stmt->get_result();

// Fetch the tool details
if ($result->num_rows > 0) {
    $tool = $result->fetch_assoc();
} else {
    die("Tool not found or is not approved.");
}

$stmt->close();
$conn->close();

function convertToEmbedURL($url) {
  // Parse the URL
  $parsedUrl = parse_url($url);

  // Check if it's a YouTube URL
  if (isset($parsedUrl['host']) && (strpos($parsedUrl['host'], 'youtube.com') !== false || strpos($parsedUrl['host'], 'youtu.be') !== false)) {
      // For "youtu.be" short links
      if ($parsedUrl['host'] === 'youtu.be') {
          $videoId = ltrim($parsedUrl['path'], '/');
      }
      // For "youtube.com" long links
      elseif (strpos($parsedUrl['host'], 'youtube.com') !== false && isset($parsedUrl['query'])) {
          parse_str($parsedUrl['query'], $queryParams);
          $videoId = $queryParams['v'] ?? null;
      }

      // If video ID is found, return the embed URL
      if (!empty($videoId)) {
          return "https://www.youtube.com/embed/" . $videoId;
      }
  }

  // Return false if URL is invalid or not a YouTube URL
  return false;
}

if ($tool['video_links']) {
  $videoLinks = explode(', ', $tool['video_links']);
  $youtubeLinks = [];
  foreach ($videoLinks as $video) {
      $youtubeLinks[] = convertToEmbedURL($video);
  }
}
?>
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
        <img src="images/tool_icon/<?php echo htmlspecialchars($tool['tool_icon_file_path']); ?>" alt="Tool Icon">
        <div class="tool-header-content">
        <h1><?php echo htmlspecialchars($tool['tool_name']); ?></h1>
        <p class="category">Category: <?php echo htmlspecialchars($tool['category_name']); ?></p>
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
    <p><strong>Price:</strong> <?php echo htmlspecialchars($tool['pricing']); ?></p>
    <p><strong>Category:</strong> <?php echo htmlspecialchars($tool['category_name']); ?></p>
    <p><strong>Top Features:</strong> <?php echo htmlspecialchars($tool['features']); ?></p>
    <p><strong>Compatibility:</strong> <?php echo htmlspecialchars($tool['compatibility']); ?></p><br>

    <!-- Access Links -->
    <p><strong><u>Access Links</u>:</strong></p><br>
    <p>Web Link: <a href="<?php echo htmlspecialchars($tool['official_link']); ?>" target="_blank">Visit Tool</a></p>
    <div class="buttons">
      <?php if ($tool['desktop_link']) : ?>
        <a href="<?php echo htmlspecialchars($tool['desktop_link']); ?>" target="_blank">Desktop App</a>
      <?php endif; ?>
      <?php if ($tool['android_link']) : ?>
        <a href="<?php echo htmlspecialchars($tool['android_link']); ?>" target="_blank">Android App</a>
      <?php endif; ?>
      <?php if ($tool['ios_link']) : ?>
        <a href="<?php echo htmlspecialchars($tool['ios_link']); ?>" target="_blank">iOS App</a>
      <?php endif; ?>
    </div>
  </div>

  <!-- How to Use -->
 
  <div class="how-to-use">
  <h2>How to Use?</h2>
  <p>Learn how to use ChatGPT through the following resources:</p>
  
  <!-- Embedded Video -->
  <div class="video-container">
    <?php
    if ($youtubeLinks) {
      foreach ($youtubeLinks as $link) { 
      ?>
        <iframe 
            width="300" 
            height="170" 
            src="<?php echo $link; ?>" 
            title="How to Use ChatGPT" 
            frameborder="0" 
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
            allowfullscreen>
        </iframe>
      <?php
      }
    }
    ?>
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
