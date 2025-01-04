<?php
// profile.php
session_start();

// Check if the user is authenticated
if (!isset($_SESSION['userEmail'])) {
    // Redirect to login page if not authenticated
    header('Location: login.php');
    exit;
}

include 'db/conn.php';

// Fetch user details
$userEmail = $_SESSION['userEmail'];
$sql = "SELECT name, email, course, interests FROM users WHERE email = '$userEmail'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "User not found.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile : ToolTrek</title>
    <link rel="stylesheet" href="css/homestyle.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>
<body>
    <header class="header">
        <div class="header-container">
            <h1 class="title">Profile</h1>
            <div class="header-buttons">
                <a href="logout.php"><button class="hbtn login">Log Out</button></a>
            </div>
        </div>
    </header>
    <main>

        <section>
            <div class="section-container">
                
                <div class="section-profile">
                    <div class="avatar-box">
                        <img src="images/avatar/level-3.png" alt="">
                    </div>
                    <div class="profile-details">
                        <h2>User Name</h2>
                        <div class="info-container">
                            <div class="info-box">
                                <div class="icon">
                                    <i class="fa fa-envelope"></i>
                                </div>
                                <div class="text">
                                    <h3>Email:</h3>
                                    <p>example@gmail.com</p>
                                </div>
                            </div>
                            <div class="info-box">
                                <div class="icon">
                                    <i class="fa fa-graduation-cap"></i>
                                </div>
                                <div class="text">
                                    <h3>Course:</h3>
                                    <p>Data Science</p>
                                </div>
                            </div>
                            <div class="info-box">
                                <div class="icon">
                                    <i class="fa fa-bullseye"></i>
                                </div>
                                <div class="text">
                                    <h3>Level:</h3>
                                    <div class="level-cap">
                                        <span class="level"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="section-head">
                    <h1 class="section-htitle">Badges</h2>
                    <button class="filter-button">
                        <i class="bi bi-eye"></i>&nbsp all
                    </button>
                </div>
                <br/>
                <div class="badges-container">
                    <img src="images/badges/bronze-and-black-round.png" alt="">
                    <img src="images/badges/gold-wavy-circle.png" alt="">
                    <img src="images/badges/octagon-black-and-silver.png" alt="">
                    <img src="images/badges/gold-round-badge.png" alt="">
                </div>
                <br>
                <div class="section-head">
                    <h1 class="section-htitle">Interests</h2>
                </div>
                <br/>
                <div class="interests-container">
                    <div class="interest-btn">Tech</div>
                    <div class="interest-btn active">Travel</div>
                    <div class="interest-btn">Food</div>
                    <div class="interest-btn active">Fitness</div>
                    <div class="interest-btn">Books</div>
                </div>
                <br><br>
                <div class="section-head">
                    <h1 class="section-htitle">Contributed Tools</h2>
                    <button class="filter-button">
                        <i class="bi bi-funnel"></i>&nbsp Filter
                    </button>
                </div>
                <br/>
                <div class="section-card-container">

                    <!-- Card --- 1 -->
                    <div class="section-card">
                        <div class="section-card-h">
                            <h2 style="color:#01783f; text-align: left;">Chat GPT</h3>
                        </div>
                        <div class="section-card-l">
                            <img src="logo.jpeg" alt="logo"/>
                            <h3>AI Virtual Assistant</h3>
                        </div>
                        <br/>
                        <div class="section-card-r">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-half"></i>
                            <i class="bi bi-star"></i>
                            <span>&#40 100 &#41</span>
                        </div>
                        <br/>
                        <div class="section-card-c">
                            <span style="font-weight: bold;">Category :</span>Category of Tools
                        </div>
                        <div class="section-card-e">
                            <div>
                                <ul>
                                    <li>Free/Paid</li>
                                    <li>Dificulty</li>
                                    <li>Ai Based or n</li>
                                </ul>
                            </div>
                            <div class="getd">
                                <i class="bi bi-arrow-right-circle-fill"></i>
                            </div>
                        </div>
                    </div>


                    <!-- Card --- 2 -->
                    <div class="section-card">
                        <div class="section-card-h">
                            <h2 style="color:#01783f; text-align: left;">Framer</h3>
                        </div>
                        <div class="section-card-l">
                            <img src="framer.png" alt="logo"/>
                            <h3>Tool Main Feature</h3>
                        </div>
                        <br/>
                        <div class="section-card-r">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-half"></i>
                            <i class="bi bi-star"></i>
                            <span>&#40 100 &#41</span>
                        </div>
                        <br/>
                        <div class="section-card-c">
                            <span style="font-weight: bold;">Category :</span>Category of Tools
                        </div>
                        <div class="section-card-e">
                            <div>
                                <ul>
                                    <li>Free/Paid</li>
                                    <li>Dificulty</li>
                                    <li>Ai Based or n</li>
                                </ul>
                            </div>
                            <div class="getd">
                                <i class="bi bi-arrow-right-circle-fill"></i>
                            </div>
                        </div>
                    </div>


                    <!-- Card --- 3 -->
                    <div class="section-card">
                        <div class="section-card-h">
                            <h2 style="color:#01783f; text-align: left;">Chat GPT</h3>
                        </div>
                        <div class="section-card-l">
                            <img src="logo.jpeg" alt="logo"/>
                            <h3>AI Virtual Assistant</h3>
                        </div>
                        <br/>
                        <div class="section-card-r">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-half"></i>
                            <i class="bi bi-star"></i>
                            <span>&#40 100 &#41</span>
                        </div>
                        <br/>
                        <div class="section-card-c">
                            <span style="font-weight: bold;">Category :</span>Category of Tools
                        </div>
                        <div class="section-card-e">
                            <div>
                                <ul>
                                    <li>Free/Paid</li>
                                    <li>Dificulty</li>
                                    <li>Ai Based or n</li>
                                </ul>
                            </div>
                            <div class="getd">
                                <i class="bi bi-arrow-right-circle-fill"></i>
                            </div>
                        </div>
                    </div>


                    <!-- Card --- 4 -->
                    <div class="section-card">
                        <div class="section-card-h">
                            <h2 style="color:#01783f; text-align: left;">Chat GPT</h3>
                        </div>
                        <div class="section-card-l">
                            <img src="logo.jpeg" alt="logo"/>
                            <h3>AI Virtual Assistant</h3>
                        </div>
                        <br/>
                        <div class="section-card-r">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-half"></i>
                            <i class="bi bi-star"></i>
                            <span>&#40 100 &#41</span>
                        </div>
                        <br/>
                        <div class="section-card-c">
                            <span style="font-weight: bold;">Category :</span>Category of Tools
                        </div>
                        <div class="section-card-e">
                            <div>
                                <ul>
                                    <li>Free/Paid</li>
                                    <li>Dificulty</li>
                                    <li>Ai Based or n</li>
                                </ul>
                            </div>
                            <div class="getd">
                                <i class="bi bi-arrow-right-circle-fill"></i>
                            </div>
                        </div>
                    </div>


                </div>
                <br/>
                <div class="view-opt"><span>View More</span></div>
                <div class="section-head">
                    <h1 class="section-htitle">Favourite Tools</h2>
                    <button class="filter-button">
                        <i class="bi bi-funnel"></i>&nbsp Filter
                    </button>
                </div>
                <br/>
                <div class="section-card-container">

                    <!-- Card --- 1 -->
                    <div class="section-card">
                        <div class="section-card-h">
                            <h2 style="color:#01783f; text-align: left;">Chat GPT</h3>
                        </div>
                        <div class="section-card-l">
                            <img src="logo.jpeg" alt="logo"/>
                            <h3>AI Virtual Assistant</h3>
                        </div>
                        <br/>
                        <div class="section-card-r">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-half"></i>
                            <i class="bi bi-star"></i>
                            <span>&#40 100 &#41</span>
                        </div>
                        <br/>
                        <div class="section-card-c">
                            <span style="font-weight: bold;">Category :</span>Category of Tools
                        </div>
                        <div class="section-card-e">
                            <div>
                                <ul>
                                    <li>Free/Paid</li>
                                    <li>Dificulty</li>
                                    <li>Ai Based or n</li>
                                </ul>
                            </div>
                            <div class="getd">
                                <i class="bi bi-arrow-right-circle-fill"></i>
                            </div>
                        </div>
                    </div>


                    <!-- Card --- 2 -->
                    <div class="section-card">
                        <div class="section-card-h">
                            <h2 style="color:#01783f; text-align: left;">Framer</h3>
                        </div>
                        <div class="section-card-l">
                            <img src="framer.png" alt="logo"/>
                            <h3>Tool Main Feature</h3>
                        </div>
                        <br/>
                        <div class="section-card-r">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-half"></i>
                            <i class="bi bi-star"></i>
                            <span>&#40 100 &#41</span>
                        </div>
                        <br/>
                        <div class="section-card-c">
                            <span style="font-weight: bold;">Category :</span>Category of Tools
                        </div>
                        <div class="section-card-e">
                            <div>
                                <ul>
                                    <li>Free/Paid</li>
                                    <li>Dificulty</li>
                                    <li>Ai Based or n</li>
                                </ul>
                            </div>
                            <div class="getd">
                                <i class="bi bi-arrow-right-circle-fill"></i>
                            </div>
                        </div>
                    </div>


                    <!-- Card --- 3 -->
                    <div class="section-card">
                        <div class="section-card-h">
                            <h2 style="color:#01783f; text-align: left;">Chat GPT</h3>
                        </div>
                        <div class="section-card-l">
                            <img src="logo.jpeg" alt="logo"/>
                            <h3>AI Virtual Assistant</h3>
                        </div>
                        <br/>
                        <div class="section-card-r">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-half"></i>
                            <i class="bi bi-star"></i>
                            <span>&#40 100 &#41</span>
                        </div>
                        <br/>
                        <div class="section-card-c">
                            <span style="font-weight: bold;">Category :</span>Category of Tools
                        </div>
                        <div class="section-card-e">
                            <div>
                                <ul>
                                    <li>Free/Paid</li>
                                    <li>Dificulty</li>
                                    <li>Ai Based or n</li>
                                </ul>
                            </div>
                            <div class="getd">
                                <i class="bi bi-arrow-right-circle-fill"></i>
                            </div>
                        </div>
                    </div>


                    <!-- Card --- 4 -->
                    <div class="section-card">
                        <div class="section-card-h">
                            <h2 style="color:#01783f; text-align: left;">Chat GPT</h3>
                        </div>
                        <div class="section-card-l">
                            <img src="logo.jpeg" alt="logo"/>
                            <h3>AI Virtual Assistant</h3>
                        </div>
                        <br/>
                        <div class="section-card-r">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-half"></i>
                            <i class="bi bi-star"></i>
                            <span>&#40 100 &#41</span>
                        </div>
                        <br/>
                        <div class="section-card-c">
                            <span style="font-weight: bold;">Category :</span>Category of Tools
                        </div>
                        <div class="section-card-e">
                            <div>
                                <ul>
                                    <li>Free/Paid</li>
                                    <li>Dificulty</li>
                                    <li>Ai Based or n</li>
                                </ul>
                            </div>
                            <div class="getd">
                                <i class="bi bi-arrow-right-circle-fill"></i>
                            </div>
                        </div>
                    </div>


                </div>
                <br/>
                <div class="view-opt"><span>View More</span></div>

            </div>
        </section>
        <hr color="#01783f"/>


        <!-- CATEGORIES SECTION START -->
        <section>
            <div class="section-container">
                <div class="section-head">
                    <h1 class="section-htitle">Categories</h2>
                    <button class="filter-button">
                        <i class="bi bi-funnel"></i>&nbsp Filter
                    </button>
                </div>
                <br/>
                <div class="section-card-container">

                    <!-- Category Card --- 1 -->
                    <div class="section-card category-card">
                        <div class="section-card-h">
                            <h2 style="color:#01783f; text-align: left;">Coding</h3>
                        </div>
                        <span><b>Description :</b> manage time task, and project efficiently</span>
                        <br/><br/>
                        <span><b>Tools :</b> ChatGPT, Framer, Fontawesome .....</span>
                    </div>
                    <!-- Category Card --- 2 -->
                    <div class="section-card category-card">
                        <div class="section-card-h">
                            <h2 style="color:#01783f; text-align: left;">Image EditingT</h3>
                        </div>
                        <span><b>Description :</b> manage time task, and project efficiently</span>
                        <br/><br/>
                        <span><b>Tools :</b> ChatGPT, Framer, Fontawesome .....</span>
                    </div>
                    <!-- Category Card --- 3 -->
                    <div class="section-card category-card">
                        <div class="section-card-h">
                            <h2 style="color:#01783f; text-align: left;">Video Editing</h3>
                        </div>
                        <span><b>Description :</b> manage time task, and project efficiently</span>
                        <br/><br/>
                        <span><b>Tools :</b> ChatGPT, Framer, Fontawesome .....</span>
                    </div>
                    <!-- Category Card --- 4 -->
                    <div class="section-card category-card">
                        <div class="section-card-h">
                            <h2 style="color:#01783f; text-align: left;">Language learning</h3>
                        </div>
                        <span><b>Description :</b> manage time task, and project efficiently</span>
                        <br/><br/>
                        <span><b>Tools :</b> ChatGPT, Framer, Fontawesome .....</span>
                    </div>
                    <!-- Category Card --- 5 -->
                    <div class="section-card category-card">
                        <div class="section-card-h">
                            <h2 style="color:#01783f; text-align: left;">Category 5</h3>
                        </div>
                        <span><b>Description :</b> manage time task, and project efficiently</span>
                        <br/><br/>
                        <span><b>Tools :</b> ChatGPT, Framer, Fontawesome .....</span>
                    </div>
                    <!-- Category Card --- 6 -->
                    <div class="section-card category-card">
                        <div class="section-card-h">
                            <h2 style="color:#01783f; text-align: left;">Category 6</h3>
                        </div>
                        <span><b>Description :</b> manage time task, and project efficiently</span>
                        <br/><br/>
                        <span><b>Tools :</b> ChatGPT, Framer, Fontawesome .....</span>
                    </div>
                    <!-- Category Card --- 7 -->
                    <div class="section-card category-card">
                        <div class="section-card-h">
                            <h2 style="color:#01783f; text-align: left;">Category 7</h3>
                        </div>
                        <span><b>Description :</b> manage time task, and project efficiently</span>
                        <br/><br/>
                        <span><b>Tools :</b> ChatGPT, Framer, Fontawesome .....</span>
                    </div>
                    <!-- Category Card --- 8 -->
                    <div class="section-card category-card">
                        <div class="section-card-h">
                            <h2 style="color:#01783f; text-align: left;">Category 8</h3>
                        </div>
                        <span><b>Description :</b> manage time task, and project efficiently</span>
                        <br/><br/>
                        <span><b>Tools :</b> ChatGPT, Framer, Fontawesome .....</span>
                    </div>

                </div>
                <br/>
                <div class="view-opt"><span>View More</span></div>


            </div>
        </section>
        <hr color="#01783f"/>


        <!-- VIDEO TUTORIAL SECTION STARTS HERE -->
        <section>
            <div class="section-container">
                <h1 style="text-align: center;margin: 20px 0;color: #01783f;">YouTube Video Tutorials</h1>
                <div class="video-grid">
                <!-- Video 1 -->
                <div class="video">
                    <iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ" 
                        title="Video 1" 
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen>
                    </iframe>
                </div>
                <!-- Video 2 -->
                <div class="video">
                    <iframe src="https://www.youtube.com/embed/3fumBcKC6RE" 
                        title="Video 2" 
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen>
                    </iframe>
                </div>
                <!-- Add more videos as needed -->
                <div class="video">
                    <iframe src="https://www.youtube.com/embed/kJQP7kiw5Fk" 
                        title="Video 3" 
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen>
                    </iframe>
                </div>
                </div>
            </div>
        </section>
        <hr color="#01783f"/>


        <!-- WHY USE TOOLTREK STARTS HERE -->
        <section>
            <div class="section-container">
                <h1 style="text-align: center;margin: 20px 0;color: #01783f;">Why Use ToolTrek ?</h1>
                <div>
                    <!-- side image and some description of website related to heading question will be coded here -->
                </div>
            </div>
        </section>
    </main>
    <div class="container">
        <h1>Welcome, <?php echo htmlspecialchars($user['name']); ?>!</h1>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
        <p><strong>Course:</strong> <?php echo htmlspecialchars($user['course']); ?></p>
        <p><strong>Interests:</strong> <?php echo htmlspecialchars($user['interests']); ?></p>
        <div class="logout">
        </div>
    </div>
</body>
</html>
