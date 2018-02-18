<?php

include("inc/db.php");

function get_categories($limit = 999) {
    global $connection;
    $query_all_categories = "SELECT cat_title FROM categories LIMIT $limit";
    $results_all_categories = mysqli_query($connection, $query_all_categories);

    if(!$results_all_categories) {
        die("Categories query failed" . mysqli_error($connection));
    }

    return $results_all_categories;
}