<?php
$file = fopen("Notes.txt", "r");
$notes = array();
$counter = 0;
$id = 0;
while (!feof($file)) {
    $line = fgets($file);
    if (!empty(trim($line))) {
        $temp_notes = (explode("\t", $line, 4));
        array_push($notes, $temp_notes);
        $id = $notes[$counter][0];
    } else {
        continue;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notify</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Playfair+Display:ital,wght@0,600;1,500&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
</head>

<body>
    <div class="main-card">
        <div class="navbar">
            <div class="navbrand"><i class="far fa-clipboard"></i>Note<span>It</span></div>
            <ul>
                <li><a href="index.php"><i class="fas fa-home"></i>Home</a></li>
                <li><a href="notes.php"><i class="fas fa-sticky-note"></i>Notes</a></li>
            </ul>
        </div>
        <div class="content-cards">
            <div class="top-bar flex-container">
                <div class="search-form">
                    <input type="text" placeholder="Search..">
                    <button type="submit"><i class="fa fa-search"></i></button>
                </div>
                <div class="user-details flex-container">
                    <img src="images/avatar.png" alt="Avatar">
                    <div class="greetings">Hello, Sharvin Kogilavanan</div>
                </div>
            </div>
            <hr style="background-color:#222831; border: 1px solid  rgba(0, 0, 0, 0.125);">
            <div class="big-card flex-container">
                <div class="left-card">
                    <div class="intro flex-container">
                        <img src="dp2.jpg" style="border-radius: 50%" height="150px" width="150px">
                    </div>
                    <div class="notes-intro">
                        <h1>Welcome, Sharvin Kogilavanan</h1>
                        <h2>You have created</h2>
                        <p><?php echo count($notes) ?><i class="fas fa-sticky-note"></i></p>
                        <h2>notes</h2>
                    </div>
                </div>
                <div class="right-card">
                    <div class="class overall-notes">
                        <div class="quotes">
                            <h1>"WE'RE TAKING NOTES VERY SERIOUSLY"
                            </h1>
                        </div>
                        <div class="quotes">
                            <h2>- NotedIt Inc</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>