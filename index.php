<!DOCTYPE html>
<html lang="it" dir="ltr">
  <head>

    <link rel="apple-touch-icon" sizes="57x57" href="../img/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="../img/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="../img/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="../img/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="../img/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="../img/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="../img/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="../img/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="../img/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="../img/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../img/favicon/favicon-16x16.png">
    <link rel="manifest" href="../img/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="../img/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <link rel="stylesheet" href="../styles/style.css">
    <title>Benvenuto su Project Plan</title>
  </head>
  <body>
    <header class="top top_header">
      <h1>Project Plan</h1>
    </header>
    <main>
      <form action="handler/user.php" method="post">
        <label>Inserisci username: </label><br>
        <input type="text" name="username" value="Inserisci Username" required><br>
        <label>Inserisci password:</label><br>
        <input type="password" class="pwd" name="pwd" required><br>
        <span><input type="checkbox" id="show_password"><label for="show_password"> Mostra password</label></span><br>
        <input type="submit" name="accessoUtente" value="Accedi">
      </form>
      <a href="public/registration.php">Non sei ancora registrato? Registrati qui</a>
    </main>
    <footer>
      <a href="https://raffaeleberardo.github.io/raffaeleberardo/"><img src="../img/sito.png" alt="logoSito"></a>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/user.js"></script>
  </body>
</html>
