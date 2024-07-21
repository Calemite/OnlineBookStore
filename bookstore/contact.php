<?php
  session_start();
  // Connect to the database
  require_once "./functions/database_functions.php";
  $conn = db_connect();

  // Handle form submission
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["inputName"];
    $email = $_POST["inputEmail"];
    $message = $_POST["textArea"];

    // Validate and process the data as needed (you may add more validation)

    // For demonstration purposes, let's insert the data into the "review" table
    $insert_query = "INSERT INTO review (Name, Email, Comment) VALUES ('$name', '$email', '$message')";
    $insert_result = mysqli_query($conn, $insert_query);

    if ($insert_result) {
      echo "Thank you for your feedback!";
      // Additional actions can be performed here
    } else {
      echo "Error: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
    exit;
  }

  // Fetch data from the "review" table
  $query = "SELECT Name, Email, Comment FROM review";
  $result = mysqli_query($conn, $query);

  if (!$result) {
    echo "Can't retrieve data " . mysqli_error($conn);
    exit;
  }

  $title = "Contact";
  require_once "./template/header.php";
?>

<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6 text-center">
        <form class="form-horizontal" method="post" action="">
            <fieldset>
                <legend>Contact</legend>
                <p class="lead">I’d love to hear from you! Complete the form to send me an email.</p>
                <div class="form-group">
                    <label for="inputName" class="col-lg-2 control-label">Name</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="inputName" name="inputName" placeholder="Name" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label">Email</label>
                    <div class="col-lg-10">
                        <input type="email" class="form-control" id="inputEmail" name="inputEmail" placeholder="Email" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="textArea" class="col-lg-2 control-label">Textarea</label>
                    <div class="col-lg-10">
                        <textarea class="form-control" rows="3" id="textArea" name="textArea" required></textarea>
                        <span class="help-block">A longer block of help text that breaks onto a new line and may extend beyond one line.</span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        <button type="reset" class="btn btn-default">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
    <div class="col-md-3"></div>
</div>

<?php
  require_once "./template/footer.php";
?>
