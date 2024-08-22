<!DOCTYPE html>
<html>
<head>
    <title>PDF Upload</title>
</head>
<body>
    <h1>Upload PDF</h1>
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">
        Subject Name: <input type="text" name="table_name"><br>
        Lesson Name: <input type="text" name="row_id"><br>
        Select PDF to upload: <input type="file" name="fileToUpload" id="fileToUpload"><br>
        <input type="submit" value="Upload PDF" name="submit">
        <a href="download.php?id=<?php echo $row['id']; ?>">Download PDF</a>
    </form>

    <?php
    $servername = "localhost:3307";
    $username = "root";
    $password = "";
    $dbname = "csd";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    


    if(isset($_POST["submit"])) {
        $table_name = $_POST["table_name"];
        $row_id = $_POST["row_id"];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        if($fileType != "pdf") {
            echo "Sorry, only PDF files are allowed.";
            $uploadOk = 0;
        }

        if ($_FILES["fileToUpload"]["size"] > 5000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        if ($uploadOk == 1) {
            $pdf_name = basename($_FILES["fileToUpload"]["name"]);
            $pdf_content = file_get_contents($_FILES["fileToUpload"]["tmp_name"]);

            $sql = "UPDATE $table_name SET pdfs=? WHERE lessons=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss",  $pdf_content, $row_id);

            if ($stmt->execute() === TRUE) {
                echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded and updated.";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $stmt->close();
        }
        




    }

    $conn->close();
    ?>
</body>
</html>
