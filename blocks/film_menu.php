<?php
$film_array = array();

$select_films=mysqli_query($mysqli,"SELECT * FROM `film`");
while( $row = $select_films->fetch_assoc() ) {
    array_push($film_array,$row['name']);
}

?>
<span>
            <ul>
               <?php
               foreach ($film_array as $urr => $name)
               {
                   echo "<li><a href=\"../index.php?film&id=$urr\">$name</a></li>";
               }
               ?>
            </ul>
</span>


