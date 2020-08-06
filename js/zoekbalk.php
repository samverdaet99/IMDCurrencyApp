<!DOCTYPE html>
<html>
  <body>
    <!-- [SEARCH FORM] -->
    <form method="post" action="1-form.php">
      <h1>SEARCH FOR USERS</h1>
      <input type="text" name="search" required/>
      <input type="submit" value="Search"/>
    </form>

    <?php
    if (isset($_POST['search'])) {
      // SEARCH FOR USERS
      require "classes/Search.php";

      // DISPLAY RESULTS
      if (count($results) > 0) {
        foreach ($results as $r) {
          printf("<div>%s - %s</div>", $r['name'], $r['email']);
        }
      } else {
        echo "No results found";
      }
    }
    ?>
  </body>
</html>