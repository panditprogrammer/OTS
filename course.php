<?php
require_once "header.php";

?>

<div class="container">
    <h1 class="h3 mt-4 text-gray-800">Latest Courses</h1>
    <hr class="hr">

    <div class="row row-cols-1 row-cols-md-2 g-4 my-4 d-flex justify-content-start">
        <?php
        $sql = "SELECT * FROM course_categories RIGHT JOIN courses ON courses.c_category = course_categories.cat_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
        ?>
                <!-- Card -->
                <div class="card border-left-primary shadow py-2 mx-2 mb-4" style="width: 25rem;">
                    <div class="card-body">
                        <img height="160px" src="https://cdn.pixabay.com/photo/2020/05/07/12/11/web-development-company-5141298_1280.jpg" class="card-img-top" alt="...">
                        <div class="row no-gutters align-items-center">

                            <div class="col mr-2">
                                <h4 class="card-title my-2 text-gray-800"><?php echo $row["c_name"]; ?></h4>
                                <p class="card-text"><?php echo substr($row['c_desc'],0,100); ?></p>
<div class="d-flex justify-content-end text-secondary"><em> Instructor: Akash Sir</em> </div>
                                <h6 class="text-xs mb-1"><?php echo $row["cat_name"]; ?></h6>
                                <div class="d-flex justify-content-between">
                                    <h5 class=" text-primary mt-1 text-uppercase"> ₹ <?php echo $row['c_fees']; ?></h5>
                                    <a href="view-course.php?id=<?php echo $row['course_id']; ?>" class="btn btn-primary">Enroll Course</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- /Card -->
        <?php
            }
        }
        ?>
    </div>
</div>

<?php
require_once "footer.php";
?>
