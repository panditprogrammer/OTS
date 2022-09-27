<?php require_once "header.php"; ?>

<div class="container">
    <h1 class="h3 mt-4 text-gray-800">Course Details</h1>
    <hr class="hr">
    <div class="row my-5">
        <div class="col-lg-4 col-md-6 col-sm-12">
            <?php
            $course_desc = null;
            if (isset($_GET['id'])) {
                $course_id = $_GET["id"];
            } else {
                die("Page Not Found!");
            }
            $sql = "SELECT * FROM course_categories RIGHT JOIN courses ON courses.c_category = course_categories.cat_id WHERE course_id = '$course_id'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $course_desc = $row['c_desc'];
            ?>
                    <!-- Card -->
                    <div class="card border-left-primary shadow py-2 mb-4" style="width: 100%;">
                        <div class="card-body">
                            <img height="160px" src="https://cdn.pixabay.com/photo/2020/05/07/12/11/web-development-company-5141298_1280.jpg" class="card-img-top" alt="...">
                            <div class="row no-gutters align-items-center">

                                <div class="col mr-2">
                                    <h4 class="card-title my-2 text-gray-800"><?php echo $row["c_name"]; ?></h4>
                                    <p class="card-text"><?php echo substr($row['c_desc'], 0, 100); ?></p>

                                    <h6 class="text-xs mb-1"><?php echo $row["cat_name"]; ?></h6>
                                    <div class="d-flex justify-content-between">
                                        <h5 class="text-primary mt-1 text-uppercase"> ₹ <?php echo $row['c_fees']; ?></h5>
                                        <a href="view-course.php?id=<?php echo $row['course_id']; ?>" class="btn btn-primary">Start Course</a>
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

            <h3 class="h5 my-4 text-gray-800">Course Contents</h3>
            <ul class="list-group">
                <?php
                $lsn_sql = "SELECT * FROM lessions WHERE fk_course_id = '$course_id'";
                $lsn_res = $conn->query($lsn_sql);
                if ($lsn_res->num_rows > 0) {
                    $lsn_count = 0;
                    while ($lsn_row = $lsn_res->fetch_assoc()) {
                        $lsn_count++;
                ?>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Lession #<?php echo $lsn_count; ?></div>
                                <?php echo $lsn_row['lsn_title']; ?>
                            </div>
                            <span class="badge bg-dark rounded-pill">14</span>
                        </li>
                <?php
                    }
                }
                ?>
            </ul>
        </div>


        <div class="col-lg-8 col-md-6 col-sm-12">
            <h3>Course Description</h3>
            <p><?php echo $course_desc; ?> </p>

            <h3>what you will learn in this course?</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat repellat sed commodi, delectus, qui in mollitia sint facere exercitationem deleniti odit perferendis assumenda aliquam nisi hic vitae possimus suscipit. Distinctio enim corrupti reiciendis necessitatibus repellendus autem obcaecati quisquam voluptatum alias voluptatem vero, odio nostrum aspernatur iusto tempora quae neque cupiditate consequuntur, officia optio repudiandae? Harum dolores aliquam ut debitis quidem esse pariatur aliquid et nulla quis veniam, sapiente unde rem natus illo autem alias vitae itaque. Neque sed numquam praesentium amet ullam voluptas recusandae aliquam voluptates? Sit assumenda autem reiciendis dicta, sequi nobis soluta labore repellat, nostrum ratione id modi veniam delectus ipsam tempore quisquam qui culpa rerum molestias facere deserunt!</p>
            <a href="" class="btn btn-primary"> get course</a>
            <a href="" class="btn btn-primary"> start course</a>
        </div>
    </div>
</div>



<?php require_once "footer.php"; ?>