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
                    <a href="<?php echo base_url(); ?>login"> Home </a>
                </li>
            </ul>
            <ul class="navbar-nav my-lg-0">

        </div>
        <?php if (session()->get('username')) { ?>
            <a class="mx-4" href="<?php echo base_url(); ?>upload"> Upload </a>
        <a class="mx-4" href="<?php echo base_url(); ?>login/logout"> Courses </a>
        <a class="mx-4" href="<?php echo base_url(); ?>cart">Wish list</a>
        <a class="mx-4" href="<?php echo base_url(); ?>profile"> User Profile</a>
        <a class="mx-4" href="<?php echo base_url(); ?>login/logout"> Logout </a>
        <?php } else { ?>
            <a class="mx-4" href="<?php echo base_url(); ?>login"> Login </a>
            <a class="mx-4" href="<?php echo base_url(); ?>signup"> Sign Up</a>
        <?php } ?>
    </nav>
    <div>
    <?= form_open_multipart(base_url() . 'dashboard/Rating')?>
        <label>Search for course</label>
        <input class="form-control" id="search" name="search"/>
        <input type="submit" value="Search">
    </form>
    </div>
    <ul>
    <?php foreach ($results as $course) : ?>
        <li>
            <a href="<?= base_url(); ?>courses/<?= $course->courseCode ?>" style="display: inline-block;"><?= $course->courseCode ?>-<?=$course->Rating?></a>
            <form action="<?= base_url().'dashboard/Rating/rate' ?>" style="display: inline-block;">
                <label>Rate your course</label>
                <input type="hidden" name="courseCode" value="<?= $course->courseCode ?>">
                <input class="form-control" id="rate" name="rate"/>
                <input type="submit" value="Rate">
            </form>
        </li>
    </div>
    <?php endforeach ?>

    </ul>


</body>
</html>
