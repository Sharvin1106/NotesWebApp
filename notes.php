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
        $id = (int)$notes[$counter][0];
        $id = $id + 1;
        $counter = $counter + 1;
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
    <title>NoteIt</title>
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
            <div class="flex-container add-note-button">
                <button type="submit" form="form1" value="Submit" class="add-btn"><i class="fas fa-plus-circle"></i>Add Note</button>
            </div>
            <?php
            echo '<script>document.getElementsByClassName("add-btn")[0].addEventListener("click", function(){
            var addnote = document.getElementsByClassName("add-notes");
            var delnote = document.getElementsByClassName("display-notes");
            delnote[0].style.zIndex = -1;
            addnote[0].style.zIndex = 1;

        })</script>';
            ?>
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
                <div class="left-card flex-container">
                    <?php
                    $counter = 0;
                    $colours = ["#08f7fe", "#09FBD3", "#FE53BB", "#F5D300", "#FDC7D7", "#652EC7", "#7122FA", "#FF2281", "#FFD300", "#FF9472", "#01FFC3"];
                    while ($counter < count($notes) && $notes != null) {
                        $random_colour = rand(0, count($colours) - 1);
                        $title_num = $notes[$counter][0];
                        echo '<div class="card" style="border-color: ' . $colours[$random_colour] .
                            '"><div class="card-id">' . $notes[$counter][0] . '</div><div class="card-header" style="color: ' . $colours[$random_colour] . '">'
                            . $notes[$counter][1] . '</div>
                            <div class="card-description" style="color: ' . $colours[$random_colour] . '">' . $notes[$counter][2] . ' </div>
                            <div class="card-content"> ' . $notes[$counter][3] . '</div>
                            <div class="card-footer">
                            <form action="" method="POST">
                                <button type="delete" name="delete" value="Delete"><i class="fas fa-times del-btn"></i></button>
                                <i class="fas fa-arrow-right view-btn"></i>
                                <input type="hidden" name="title" value = ' . $notes[$counter][0] . '>
                            </form>
                            </div>
                            
                        </div>';
                        $counter = $counter + 1;
                    }
                    echo '<script>
                var numOfDelBtn = document.getElementsByClassName("del-btn");
                var numOfViewBtn = document.getElementsByClassName("view-btn").length;
                var noteCard = document.getElementsByClassName("card");
                var dispNote = document.getElementsByClassName("display-notes");
                var addNote = document.getElementsByClassName("add-notes");
                
                for(var i = 0; i < numOfViewBtn; i++){
                    
                document.querySelectorAll(".view-btn")[i].addEventListener("click", function(){
                    console.log(i);
                    console.log(this.parentNode.parentNode.parentNode.childNodes);
                    addNote[0].style.zIndex = -1;
                    dispNote[0].style.zIndex = 1;
                    dispNote[0].childNodes[1].innerText = this.parentNode.parentNode.parentNode.childNodes[1].innerText;
                    dispNote[0].childNodes[3].childNodes[5].textContent = this.parentNode.parentNode.parentNode.childNodes[3].innerText;
                    dispNote[0].childNodes[3].childNodes[7].textContent = this.parentNode.parentNode.parentNode.childNodes[5].innerText;
                    
                });
               
            }
                </script>';
                    if (isset($_POST['delete'])) {
                        $searchKeyword = $_POST['title'];
                        $counter = 0;
                        while ($counter < count($notes)) {
                            if ($notes[$counter][0] == $searchKeyword) {
                                array_splice($notes, $counter, $counter);
                                $file = fopen('Notes.txt', 'w');
                                $count = 0;
                                while ($count < count($notes)) {
                                    fwrite($file, $notes[$count][0]);
                                    fwrite($file, "\t");
                                    fwrite($file, $notes[$count][1]);
                                    fwrite($file, "\t");
                                    fwrite($file, $notes[$count][2]);
                                    fwrite($file, "\t");
                                    fwrite($file, $notes[$count][3]);
                                    $count = $count + 1;
                                }
                                echo '<meta http-equiv="refresh" content="0.1">';
                                break;
                            }
                            $counter = $counter + 1;
                        }
                    }
                    ?>
                </div>
                <div class="right-card">
                    <div class="add-notes">
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id="AddNote">
                            <h1>Add Notes</h1>
                            <label for="fname">Title</label><br>
                            <input type="text" name="fname" id="notes-title"><br><br>
                            <label for="lname">Description</label><br>
                            <input type="text" name="lname" id="notes-desc"><br><br>
                            <label for="rname">Notes</label><br>
                            <input type="text" name="rname" id="notes-cont">
                            <input type="submit" name="submit" value="Submit" class="submit">
                        </form>
                        <?php
                        if (isset($_POST['submit'])) {
                            $file = fopen('Notes.txt', 'a');
                            fwrite($file, "\n");
                            fwrite($file, $id);
                            fwrite($file, "\t");
                            fwrite($file, $_POST['fname']);
                            fwrite($file, "\t");
                            fwrite($file, $_POST['lname']);
                            fwrite($file, "\t");
                            fwrite($file, $_POST['rname']);
                            $id = $id + 1;
                            echo '<meta http-equiv="refresh" content="0.1">';
                        }
                        ?>

                    </div>
                    <div class="display-notes">
                        <h1><i class="far fa-sticky-note"></i>Notes</h1>
                        <div class="notes-content">
                            <div class="flex-container notes-details">
                                <p><i class="far fa-calendar-minus"></i> 29/11/2020</p>
                                <p><i class="far fa-clock"></i> 8.30</p>
                            </div>
                            <br>
                            <h2>Title</h2>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero sit, expedita laborum saepe adipisci minima quos enim hic, natus consequuntur nobis numquam corrupti? Obcaecati amet beatae, accusamus architecto quaerat odit?</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>