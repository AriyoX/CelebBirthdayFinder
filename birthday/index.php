<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="js/validation.js"></script>
    <script src="js/form.js"></script>
    <script src="js/ajax.js"></script>

  </head>
  <body>
    <h1>Famous People Birthday Finder</h1>
    <form id="#birthday-form" method="post" action="process.php">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>
    <label for="birthday">Date of Birth:</label>
    <input type="date" id="birthday" name="birthday" required>
  
    <label for="type">Type of Celebrity:</label>
    <select id="type" name="type" required>
      <option value="">--Select Type--</option>
      <option value="all">All Celebrities</option>
      <option value="sportsmen">Sportsmen</option>
      <option value="actors">Actors</option>
      <option value="actors">Actresses</option>
      <option value="singers">Singers</option>
      <option value="models">Models</option>
      <option value="politicians">Politicians</option>
      <option value="fictional characters">Fictional Characters</option>
      <option value="tv personalities">TV Personalities</option>
      <option value="writers">Writers</option>

    </select>
  
    <button type="submit">Find Famous People</button>
  </form>
  <script src="script.js"></script>
  </body>
</html>
  