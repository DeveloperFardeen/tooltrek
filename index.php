<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage : ToolTrek</title>
    <link rel="stylesheet" href="css/homestyle.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>
<body>
    <header class="header">
        <div class="header-container">
            <h1 class="title">Tool Trek</h1>
            <div class="header-buttons">
                <a href="signup.php"><button class="hbtn signup">Sign Up</button></a>
                <a href="login.php"><button class="hbtn login">Login</button></a>
            </div>
        </div>
    </header>
    <main>
        <span>
            <h1 id="tagline">The Ultimate Student Toolbox</h1>
            <h3 id="desc">All important tools(AI and non-AI), resources and applications in one place</h2>
        </span>
        

        <section>
            <div class="section-container">
                <div class="section-head">
                    <h1 class="section-htitle">Popular Tools</h2>>
                    <button class="filter-button">
                        <i class="bi bi-funnel"></i>&nbsp Filter
                    </button>
                </div>
                <br/>
                <div class="section-card-container">
                <?php
                // Include database configuration
                include 'db/conn.php';
                $a = 20;
                $b = 19;
                $c = 17;
                $d = 9;

                // Fetch contributed tools by the user
                $sql = "
                    SELECT 
                        t.id AS tool_id, 
                        t.name AS tool_name,
                        t.status AS tool_status,
                        c.name AS category_name, 
                        td.tool_icon_file_path, 
                        td.features, 
                        td.pricing 
                    FROM 
                        tools t
                    JOIN 
                        tool_details td ON t.id = td.tool_id
                    JOIN 
                        categories c ON t.category_id = c.id
                    WHERE 
                        t.id = ? OR t.id = ? OR t.id = ? OR t.id = ?
                ";

                $stmt = $conn->prepare($sql);
                $stmt->bind_param("iiii", $a, $b, $c, $d);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    while ($tool = $result->fetch_assoc()) {
                        ?>
                        <!-- Card --- <?php echo htmlspecialchars($tool['tool_name']); ?> -->
                        <div class="section-card">
                            <div class="section-card-h">
                                <h2 style="color:#01783f; text-align: left;"><?php echo htmlspecialchars($tool['tool_name']); ?></h2>
                            </div>
                            <div class="section-card-l">
                                <img src="images/tool_icon/<?php echo htmlspecialchars($tool['tool_icon_file_path']); ?>" alt="logo" />
                                <h3><?php echo htmlspecialchars($tool['category_name']); ?></h3>
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
                                <span style="font-weight: bold;">Category :</span> <?php echo htmlspecialchars($tool['category_name']); ?>
                            </div>
                            <div class="section-card-e">
                                <div>
                                    <ul>
                                        <?php
                                        $features = explode(',', $tool['features']);
                                        foreach ($features as $feature) {
                                            echo "<li>" . htmlspecialchars(trim($feature)) . "</li>";
                                        }
                                        ?>
                                        <li><?php echo htmlspecialchars($tool['pricing']); ?></li>
                                    </ul>
                                </div>
                                <div class="getd">
                                    <a href="tool_detail.php?tool_id=<?php echo htmlspecialchars($tool['tool_id']); ?>">
                                        <i class="bi bi-arrow-right-circle-fill"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "<p>No tools Favourite yet.</p>";
                }

                $stmt->close();
                $conn->close();
                ?>

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
                    <h1 class="section-htitle">Categories</h2>>
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
                    <iframe src="https://www.youtube.com/embed/u9MIwoFWXVg" 
                        title="Video 1" 
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen>
                    </iframe>
                </div>
                <!-- Video 2 -->
                <div class="video">
                    <iframe src="https://www.youtube.com/embed/zJSgUx5K6V0" 
                        title="Video 2" 
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen>
                    </iframe>
                </div>
                <!-- Add more videos as needed -->
                <div class="video">
                    <iframe src="https://www.youtube.com/embed/BErxU9o_gOk" 
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
    <style>
        





    </style>
</body>
</html>