<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Search Courses</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style.css">
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/smoothness/jquery-ui.css" />
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand">TechBridge</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a href="<?php echo base_url(); ?>home"> Home </a>
                </li>
            </ul>
            <ul class="navbar-nav my-lg-0">

        </div>
        <?php if (session()->get('username')) { ?>
            <a class="mx-4" href="<?php echo base_url(); ?>upload"> Dashboard </a>
        <a class="mx-4" href="<?php echo base_url(); ?>courses"> Courses </a>
        <a class="mx-4" href="<?php echo base_url(); ?>profile"> User Profile</a>
        <a class="mx-4" href="<?php echo base_url(); ?>login/logout"> Logout </a>
        <?php } else { ?>
            <a class="mx-4" href="<?php echo base_url(); ?>login"> Login </a>
            <a class="mx-4" href="<?php echo base_url(); ?>signup"> Sign Up</a>
        <?php } ?>
    </nav>
    <div>
    <?= form_open_multipart(base_url() . 'courses/getcourses')?>
        <label>Search for course</label>
        <input class="form-control" id="search" name="search"/>
        <input type="submit" value="Search">
        </form>
    </div>
    <script>
        $("#search").autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: '<?php echo base_url()."courses/getSearchValue"; ?>',
                    dataType: "json",
                    data: { search: $("#search").val() },
                    success: function (data) {
                        response($.map(data, function (item) {
                            return { label: item.courseCode + ' - ' + item.title, value: item.courseCode };
                        }));
                    },
                    error: function (xhr, status, error) {
                        alert("Error");
                    }
                });
            }
        });
    </script>
    <ul>
    <?php foreach ($results as $course) : ?>
        <li>
            <h2><a href="<?= base_url(); ?>courses/<?= $course->courseCode ?>" style="display: inline-block;"><?= $course->courseCode ?> - <?= $course->title ?></a></h2>
            <form action="<?= base_url().'/enroll' ?>" style="display: inline-block;">
                <input type="hidden" name="courseCode" value="<?= $course->courseCode ?>">
                <button type="submit">Enroll</button>
            </form>
            <form action="<?= base_url().'/wish' ?>" style="display: inline-block;">
                <input type="hidden" name="courseCode" value="<?= $course->courseCode ?>">
                <button type="submit">Add to wish list</button>
            </form>
        </li>
    <?php endforeach ?>
    </ul>
</body>
</html>
