<!DOCTYPE html>
<html>
<body>

<form action="?upload" method="post" enctype="multipart/form-data">
  Select image to upload:
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" value="Upload Image" name="submit">
</form>

<div>
    <?php


if(!isset($_GET['upload'])) {
    die();
}

$target_dir = "uploads/";
$target_file = $target_dir.uniqid().'.'.strtolower(pathinfo(basename($_FILES["fileToUpload"]["name"]), PATHINFO_EXTENSION));
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "<div>File is an image - " . $check["mime"] . ".</div>";
    $uploadOk = 1;
  } else {
    echo "<div>File is not an image.</div>";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "<div>Sorry, file already exists.</div>";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "<div>Sorry, your file is too large.</div>";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "<div>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</div>";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "<div>Sorry, your file was not uploaded.</div>";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "<div>The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.</div>";
  } else {
    echo "<div>Sorry, there was an error uploading your file.</div>";
  }
}

$type = pathinfo($target_file, PATHINFO_EXTENSION);
$data = file_get_contents($target_file);
$image = 'data:image/' . $type . ';base64,' . base64_encode($data);
echo "<div><img src=\"$image\"></div>";
echo "<div>uploaded_file=".$target_file."</div>";

?>
</div>

</body>
</html>

