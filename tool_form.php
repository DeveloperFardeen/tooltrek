<?php
// tool_contribution.php
session_start();

// Check if the user is authenticated
if (!isset($_SESSION['userEmail'])) {
    // Redirect to login page if not authenticated
    header('Location: login.php');
    exit;
}

include 'db/conn.php';

$submission = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tool_name = $conn->real_escape_string($_POST['tool_name']);
    $category = $conn->real_escape_string($_POST['category']);
    $description = $conn->real_escape_string($_POST['description']);
    $features = $conn->real_escape_string($_POST['features']);
    $official_link = $conn->real_escape_string($_POST['official_link']);
    $pricing = $conn->real_escape_string($_POST['pricing']);
    $compatibility = isset($_POST['compatibility']) ? $conn->real_escape_string($_POST['compatibility']) : null;
    $desktop_link = isset($_POST['desktop_link']) ? $conn->real_escape_string($_POST['desktop_link']) : null;
    $android_link = isset($_POST['android_link']) ? $conn->real_escape_string($_POST['android_link']) : null;
    $ios_link = isset($_POST['ios_link']) ? $conn->real_escape_string($_POST['ios_link']) : null;
    $video_links = isset($_POST['video_links']) ? $conn->real_escape_string(implode(", ", $_POST['video_links'])) : null;
    $submitted_by = $_SESSION['userEmail'];

    $sql = "INSERT INTO tools (name, category_id, added_by, status) VALUES ('$tool_name', '$category', (SELECT id FROM users WHERE email = '$submitted_by'), 'pending')";

    if ($conn->query($sql) === TRUE) {
        $tool_id = $conn->insert_id;
        $details_sql = "INSERT INTO tool_details (tool_id, description, features, official_link, pricing, compatibility, desktop_link, android_link, ios_link, video_links) VALUES ('$tool_id', '$description', '$features', '$official_link', '$pricing', '$compatibility', '$desktop_link', '$android_link', '$ios_link', '$video_links')";

        if ($conn->query($details_sql) === TRUE) {

            $uploadDir = 'images/tool_preview_imgs/';
            $imagesArray = [];

            function sanitizeFileName($filename) {
                $filename = preg_replace('/\s+/', '', $filename); // Remove whitespace
                $filename = preg_replace('/[^A-Za-z0-9_\-\.]/', '', $filename); // Remove special characters except for -_.
                return $filename;
            }

            // Check if files are uploaded
            if (isset($_FILES['preview_images']) && !empty($_FILES['preview_images']['name'][0])) {
                $uploadSuccessfully = false; // Flag to check if at least one file is uploaded successfully

                foreach ($_FILES['preview_images']['name'] as $index => $fileName) {
                    // Retrieve file details
                    $fileTmpPath = $_FILES['preview_images']['tmp_name'][$index];
                    $fileSize = $_FILES['preview_images']['size'][$index];
                    $fileType = $_FILES['preview_images']['type'][$index];
                    $fileError = $_FILES['preview_images']['error'][$index];

                    // Process only if there's no upload error
                    if ($fileError === UPLOAD_ERR_OK) {
                        // Generate a unique name for the file to prevent overwriting
                        $fileNameCmps = pathinfo($fileName);
                        $fileExtension = $fileNameCmps['extension'];
                        $newFileName = uniqid() . '.' . $fileExtension;
                        $newFileName = sanitizeFileName($newFileName);
                        $imagesArray[] = $newFileName;

                        // Target file path
                        $targetFilePath = $uploadDir . $newFileName;

                        // Move the file to the target directory
                        if (move_uploaded_file($fileTmpPath, $targetFilePath)) {
                            echo "File uploaded successfully: " . $targetFilePath . "<br>";
                            $uploadSuccessfully = true;
                        } else {
                            echo "Error moving file: " . $fileName . "<br>";
                            $uploadSuccessfully = false;
                        }
                    } else {
                        echo "Error uploading file: " . $fileName . "<br>";
                    }
                }

                if ($uploadSuccessfully) {
                    // Convert the uploaded file paths to a comma-separated string
                    $filePaths = implode(', ', $imagesArray);

                    // Prepare the database update query
                    $fileUpdateSql = "UPDATE `tool_details` SET `tool_preview_file_path` = ? WHERE `tool_details`.`tool_id` = ?";
                    $stmt = $conn->prepare($fileUpdateSql);
                    $stmt->bind_param("si", $filePaths, $tool_id);

                    if ($stmt->execute()) {
                        echo "Database updated successfully with preview file paths.<br>";
                    } else {
                        echo "Error updating database: " . $stmt->error . "<br>";
                    }

                    $stmt->close();
                }
            } else {
                echo "No no preview image uploaded or there was an error during the upload.";
            }

            // Check if the cropped tool icon is uploaded via Croppie
            if (isset($_POST['cropped-icon']) && !empty($_POST['cropped-icon'])) {
                $croppedIconData = $_POST['cropped-icon']; // Croppie sends base64-encoded image data
                $uploadDir = 'images/tool_icon/';
                $iconFileName = uniqid() . '.png'; // Save the cropped icon as a PNG file
                $iconFilePath = $uploadDir . $iconFileName;

                // Decode base64 image data and save it as a file
                $croppedIconData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $croppedIconData));

                if (file_put_contents($iconFilePath, $croppedIconData)) {
                    echo "Tool icon uploaded successfully: " . $iconFilePath . "<br>";

                    // Update the tool_details table with the tool icon path
                    $iconUpdateSql = "UPDATE `tool_details` SET `tool_icon_file_path` = ? WHERE `tool_details`.`tool_id` = ?";
                    $stmt = $conn->prepare($iconUpdateSql);
                    $stmt->bind_param("si", $iconFilePath, $tool_id);

                    if ($stmt->execute()) {
                        echo "Database updated successfully with tool icon file path.<br>";
                    } else {
                        echo "Error updating database with tool icon: " . $stmt->error . "<br>";
                    }

                    $stmt->close();
                } else {
                    echo "Error saving cropped tool icon.<br>";
                }
            } else {
                echo "No tool icon uploaded.<br>";
            }


            $submission = true;
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Error: " . $conn->error;
    }
}

// Fetch categories
$categories_result = $conn->query("SELECT id, name FROM categories");
$categories = [];
while ($row = $categories_result->fetch_assoc()) {
    $categories[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contribute a Tool</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin: 10px 0 5px;
        }
        input, textarea, select, button {
            padding: 10px;
            font-size: 1em;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #333;
            color: #fff;
            cursor: pointer;
        }
        button:hover {
            background-color: #555;
        }
        #croppie-container {
            margin: 15px 0;
        }
    </style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css" rel="stylesheet">
</head>
<body>
    <?php
    if ($submission) {
        echo '<script>alert("Tool is Added Successfully. After review, It will be live.");</script>';
    }
    ?>
    <div class="container">
        <h1>Add a Tool</h1>
        <p>Be a contributor, help other ❤️</p>
        <form action="" method="POST" enctype="multipart/form-data">
            
            <label for="icon-upload">Tool Icon:</label>
            <input type="file" id="icon-upload" accept="image/*">
            <div id="croppie-container"></div>
            <!-- Hidden input to store the cropped image data -->
            <input type="hidden" id="cropped-icon" name="cropped_icon">


            <label for="tool_name">Tool Name:</label>
            <input type="text" id="tool_name" name="tool_name" required>

            <label for="category">Category:</label>
            <select id="category" name="category" required>
                <option value="">Select a category</option>
                <?php foreach ($categories as $category) : ?>
                    <option value="<?php echo $category['id']; ?>">
                        <?php echo htmlspecialchars($category['name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="5" required></textarea>

            <label for="features">Features (comma-separated):</label>
            <textarea id="features" name="features" rows="3" placeholder="eg. easy to use, offline and online, etc." required></textarea>

            <label for="pricing">Pricing:</label>
            <input type="text" id="pricing" name="pricing">

            <label for="compatibility">Compatibility (Optional):</label>
            <input type="text" id="compatibility" name="compatibility">

            <label for="official_link">Official Link:</label>
            <input type="url" id="official_link" name="official_link" required>

            <label for="desktop_link">Desktop App Download Link (Optional):</label>
            <input type="url" id="desktop_link" name="desktop_link">

            <label for="android_link">Android App Download Link (Optional):</label>
            <input type="url" id="android_link" name="android_link">

            <label for="ios_link">iOS App Download Link (Optional):</label>
            <input type="url" id="ios_link" name="ios_link">

            <label for="video_links">YouTube Video Tutorial Links (Optional):</label>
            <textarea id="video_links" name="video_links[]" rows="3" placeholder="Add one link per line"></textarea>

            <label for="preview_images">Upload Preview Images (Max 3):</label>
            <input type="file" id="preview_images" name="preview_images[]" accept="image/*" multiple>

            <button type="submit">Submit Tool</button>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"></script>
    <script>
        const upload = document.getElementById('icon-upload');
        const croppieContainer = document.getElementById('croppie-container');
        const croppedIconInput = document.getElementById('cropped-icon'); // Hidden input to store the cropped image

        let croppieInstance;

        upload.addEventListener('change', function (event) {
            const reader = new FileReader();
            reader.onload = function (e) {
                if (croppieInstance) {
                    croppieInstance.destroy();
                }

                croppieInstance = new Croppie(croppieContainer, {
                    viewport: { width: 150, height: 150, type: 'circle' },
                    boundary: { width: 300, height: 300 },
                });

                croppieInstance.bind({
                    url: e.target.result,
                });
            };

            reader.readAsDataURL(event.target.files[0]);
        });

        // Capture the cropped image before form submission
        document.querySelector('form').addEventListener('submit', function (e) {
            if (croppieInstance) {
                e.preventDefault(); // Prevent default form submission

                croppieInstance.result({
                    type: 'base64',
                    format: 'png',
                    size: { width: 150, height: 150 }
                }).then(function (croppedImage) {
                    // Store the cropped image in the hidden input
                    croppedIconInput.value = croppedImage;

                    // Submit the form after setting the cropped image
                    e.target.submit();
                });
            }
        });
    </script>
</body>
</html>
