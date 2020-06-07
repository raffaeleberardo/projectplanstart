<?php
  session_start();
?>
<?php if(isset($_SESSION['username'])) :?>
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
    <title>Project Plan | I tuoi compiti</title>
  </head>
  <body>
      <nav class="sidenav">
        <!--Logout and Delete user Buttons-->
          <a id="closeNav">&times;</a>
          <a id='logout'>Logout</a>
          <a id='delete-account'>Delete account</a>
        <!-- <button id='delete-account' type="button" name="button">Delete Account</button>
        <button id='logout' type="button" name="button">Logout</button> -->
      </nav>
      <div class="push">
        <header>
          <p id="openNav">&equiv;</p>
          <h1>Project Plan <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
        </header>
        <main>
          <!--Lista progetti-->
        </main>
        <div>
          <form id="add_activity" action="../handler/activity.php" method="post">
            <input type="text" name="add_activity_input" value="Inserisci attività"><br>
            <input type="date" name="expiration_date"><br>
            <input type="submit" name="add_activity_submit" value="Aggiungi">
          </form>
          <button id="show_add_activity" type="button" name="button"> + </button>
        </div>
        <footer>
          <a href="https://raffaeleberardo.github.io/raffaeleberardo/">
            <img src="../img/sito.png" alt="logoSito">
          </a>
        </footer>
      </div>
      <script type="text/javascript">const username = "<?php echo htmlspecialchars($_SESSION['username']);?>";</script>
      <script src='https://kit.fontawesome.com/a076d05399.js'></script>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script type="text/javascript" src="../js/user.js"></script>
      <script type="text/javascript" src="../js/activity.js"></script>
  </body>
</html>
<?php endif; ?>
