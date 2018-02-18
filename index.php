<?php
include("inc/header.php");
include("inc/navigation.php");
?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="page-header">
                Page Heading
                <small>Secondary Text</small>
            </h1>

            <!-- First Blog Post -->
            <?php
            if(isset($_GET['search'])) {
                // include("inc/db.php");
                
                $search = $_GET['search'];
                $query_posts = "SELECT * FROM posts WHERE post_tags LIKE '%$search%'";
            } else {
                $query_posts = "SELECT * FROM posts"; 
            }

            $results_posts = mysqli_query($connection, $query_posts);
            if(!$results_posts) {
                die("Search query failed" . mysqli_error($connection));
            }

            if(isset($_GET['search'])) {
                $count = mysqli_num_rows($results_posts);
                if($count == 0) {
                    echo "<h1>No results</h1>";
                } else {
                    echo "<h1>$count results</h1>";
                    echo "<hr>";
                }
            }
            
            while($row_posts = mysqli_fetch_assoc($results_posts)) {
            ?>
                <h2>
                    <a href="#"><?php echo $row_posts['post_title'] ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $row_posts['post_author'] ?></a>
                </p>
                <p>
                    <span class="glyphicon glyphicon-time"></span>
                    <?php echo $row_posts['post_date'] ?>
                </p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $row_posts['post_image'] ?>" alt="">
                <hr>
                <p>
                    <?php echo $row_posts['post_content'] ?>
                </p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                <hr>

            <?php } ?>
            
        </div>

    <?php include("inc/sidebar.php"); ?>

    </div>
    <!-- /.row -->

    <hr>

<?php
include("inc/footer.php");
?>