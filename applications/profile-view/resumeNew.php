

<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Twitter -->
    <meta name="twitter:site" content="@themepixels">
    <meta name="twitter:creator" content="@themepixels">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="DashForge">
    <meta name="twitter:description" content="Responsive Bootstrap 5 Dashboard Template">
    <meta name="twitter:image" content="http://themepixels.me/dashforge/img/dashforge-social.png">

    <!-- Facebook -->
    <meta property="og:url" content="http://themepixels.me/dashforge">
    <meta property="og:title" content="DashForge">
    <meta property="og:description" content="Responsive Bootstrap 5 Dashboard Template">

    <meta property="og:image" content="http://themepixels.me/dashforge/img/dashforge-social.png">
    <meta property="og:image:secure_url" content="http://themepixels.me/dashforge/img/dashforge-social.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Meta -->
    <meta name="description" content="Responsive Bootstrap 5 Dashboard Template">
    <meta name="author" content="ThemePixels">


    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="http://localhost/projects/PHPNation/includes/assets/img/favicon.png">

    <title>The Nations Recruitment Agency</title>

    <!-- vendor css -->
    <link href="http://localhost/projects/PHPNation/includes/lib/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="http://localhost/projects/PHPNation/includes/lib/typicons.font/src/font/typicons.css" rel="stylesheet">
    <link href="http://localhost/projects/PHPNation/includes/lib/prismjs/themes/prism-vs.css" rel="stylesheet">
    <link href="http://localhost/projects/PHPNation/includes/lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="http://localhost/projects/PHPNation/includes/lib/remixicon/fonts/remixicon.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="http://localhost/projects/PHPNation/includes/custom/custom_style.css" rel="stylesheet">

    <!-- DashForge CSS -->
    <link rel="stylesheet" href="http://localhost/projects/PHPNation/includes/assets/css/dashforge.css">
    <link rel="stylesheet" href="http://localhost/projects/PHPNation/includes/assets/css/dashforge.auth.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

</head><body class="">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />
<style>
    /* My Resume */
    .profile {
        margin-bottom: 25px;
    }
    .profile .jobster-user-info {
        display: inline-block;
        width: 100%;
    }
    .profile .jobster-user-info .profile-avatar {
        position: relative;
        height: 115px;
        width: 115px;
        border-radius: 100%;
        display: inline-block;
    }
    .profile .jobster-user-info .profile-avatar img {
        border-radius: 100%;
    }
    .profile .jobster-user-info .profile-avatar i {
        font-size: 16px;
        color: #21c87a;
        position: absolute;
        background: #ffffff;
        border-radius: 100%;
        cursor: pointer;
        height: 30px;
        width: 30px;
        line-height: 30px;
        text-align: center;
        bottom: 20px;
        right: -5px;
    }

    .about-candidate {
        padding: 25px 0px;
    }
    .about-candidate .candidate-info {
        margin-bottom: 20px;
    }

    .resume-experience {
        padding-left: 10px;
        padding-top: 60px;
        padding-bottom: 60px;
        position: relative;
        padding-right: 50px;
        background: #f6f6f6;
    }
    .resume-experience:before {
        position: absolute;
        left: -40%;
        right: 0;
        width: 100%;
        height: 100%;
        background: #f6f6f6;
        content: "";
        z-index: -1;
        top: 0;
    }
    .resume-experience .jobster-candidate-timeline .jobster-timeline-item .jobster-timeline-cricle {
        border-color: #f6f6f6;
    }

    .user-dashboard-info-box .select2-container--default .select2-selection--single .select2-selection__rendered {
        font-weight: bold;
        color: #626262;
    }

    @media (max-width: 1199px) {
        .secondary-menu ul li a {
            padding: 10px 15px;
        }
    }

    @media (max-width: 991px) {
        .resume-experience {
            padding-left: 15px;
            padding-top: 30px;
            padding-bottom: 30px;
            padding-right: 15px;
        }
        .resume-experience:before {
            content: none;
        }
        .secondary-menu ul li {
            display: inline-block;
        }
    }

    @media (max-width: 575px) {
        .secondary-menu ul li a {
            padding: 4px 8px;
        }
    }

    /*****************************
        Progress Bar
    *****************************/
    .progress {
        position: relative;
        overflow: inherit;
        height: 3px;
        margin: 40px 0px 15px;
        width: 100%;
        display: inline-block;
    }
    .progress .progress-bar {
        height: 3px;
        background: #21c87a;
    }
    .progress .progress-bar-title {
        position: absolute;
        left: 0;
        top: -20px;
        color: #212529;
        font-size: 14px;
        font-weight: 600;
    }
    .progress .progress-bar-number {
        position: absolute;
        right: 0;
        color: #646f79;
        top: -20px;
    }


    /* Jobster Candidate */
    .jobster-candidate-timeline {
        position: relative;
    }
    .jobster-candidate-timeline:before {
        content: "";
        position: absolute;
        left: 20px;
        width: 2px;
        top: 5px;
        bottom: 5px;
        height: calc(100% - 5px);
        background-color: #eeeeee;
    }

    .jobster-candidate-timeline .jobster-timeline-item {
        display: table;
        position: relative;
        margin-bottom: 20px;
        width: 100%;
    }

    .jobster-candidate-timeline .jobster-timeline-item .jobster-timeline-cricle {
        border-radius: 50%;
        border: 12px solid white;
        z-index: 1;
        top: 5px;
        left: 9px;
        position: absolute;
    }
    .jobster-candidate-timeline .jobster-timeline-item .jobster-timeline-cricle:before {
        content: "";
        position: absolute;
        left: 12px;
        width: 20px;
        top: -1px;
        bottom: 5px;
        height: 2px;
        background-color: #eeeeee;
    }
    .jobster-candidate-timeline .jobster-timeline-item .jobster-timeline-cricle > i {
        font-size: 15px;
        top: -8px;
        left: -7px;
        position: absolute;
        color: #21c87a;
    }

    .jobster-candidate-timeline .jobster-timeline-item .jobster-timeline-info {
        display: table-cell;
        vertical-align: top;
        padding: 5px 0 0 70px;
    }
    .jobster-candidate-timeline .jobster-timeline-item .jobster-timeline-info h6 {
        color: #21c87a;
        margin: 5px 0 0px;
    }
    .jobster-candidate-timeline .jobster-timeline-item .jobster-timeline-info span {
        color: #212529;
        font-size: 13px;
        font-weight: 500;
    }

    .jobster-candidate-timeline span.jobster-timeline-time {
        color: #646f79 !important;
    }

    .jobster-candidate-timeline .jobster-timeline-icon {
        border: 2px solid #eeeeee;
        width: 42px;
        height: 42px;
        border-radius: 50%;
        line-height: 42px;
        text-align: center;
        background: #ffffff;
        position: relative;
        margin-bottom: 20px;
    }
    .jobster-candidate-timeline .jobster-timeline-icon i {
        font-size: 16px;
        color: #212529;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        top: 16px;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <div class="resume-base bg-primary user-dashboard-info-box p-4">
                        <div class="profile">
                            <div class="jobster-user-info">
                                <div class="profile-avatar">
                                    <img class="img-fluid " src="../../uploads/profile_images/../../uploads/img/fallback-image.png" alt="">
                                </div>
                                <div class="profile-avatar-info mt-3">
                                    <h5 class="text-white">Mrs Janila Jeewani Gamage</h5>
                                </div>
                            </div>
                        </div>
                        <div class="about-candidate border-top">
                            <div class="candidate-info">
                                <h6 class="text-white">Name:</h6>
                                <p class="text-white">Mrs Janila Jeewani Gamage</p>
                            </div>
                            <div class="candidate-info">
                                <h6 class="text-white">Email:</h6>
                                <p class="text-white">janalijeewanigamage@gmail.com</p>
                            </div>
                            <div class="candidate-info">
                                <h6 class="text-white">Phone:</h6>
                                <p class="text-white">761572348</p>
                            </div>
                            <div class="candidate-info">
                                <h6 class="text-white">Date Of Birth:</h6>
                                <p class="text-white">1994-10-05</p>
                            </div>
                            <div class="candidate-info">
                                <h6 class="text-white">Address:</h6>
                                <p class="text-white">walpita North,Aramba Junction,Balagoda , London</p>
                            </div>
                            <div class="candidate-info">
                                <h6 class="text-white">Gender:</h6>
                                <p class="text-white">female</p>
                            </div>
                        </div>
                        <div class="mt-0">
                            <h5 class="text-white">Language Skill:</h5>

                            <div class="progress bg-dark">
                                <div class="progress-bar bg-white" role="progressbar" style="width:100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar-title text-white">sinhala</div>
                                    <span class="progress-bar-number text-white">100%</span>
                                </div>
                            </div>


                            <div class="progress bg-dark">
                                <div class="progress-bar bg-white" role="progressbar" style="width:20%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar-title text-white">english</div>
                                    <span class="progress-bar-number text-white">20%</span>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="resume-experience">
                        <div class="timeline-box">
                            <h5 class="resume-experience-title">Education:</h5>
                            <div class="jobster-candidate-timeline">
                                <div class="jobster-timeline-item">
                                    <div class="jobster-timeline-cricle">
                                        <i class="far fa-circle"></i>
                                    </div>
                                    <div class="jobster-timeline-info">
                                        <div class="dashboard-timeline-info">
                                            <span class="jobster-timeline-time">2017</span>
                                            <h6 class="mb-2"> General Certificate of Education (Advanced Level)  </h6>
                                            <span>- Siridahama Collage</span>
                                            <p class="mt-2">After grade 13, students take national exams for the General Certificate of Education (Advanced Level) . The General Certificate of Education (Advanced Level) is often abbreviated as GCE A/L</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="jobster-timeline-item">
                                    <div class="jobster-timeline-cricle">
                                        <i class="far fa-circle"></i>
                                    </div>
                                    <div class="jobster-timeline-info">
                                        <div class="dashboard-timeline-info">
                                            <span class="jobster-timeline-time">2014</span>
                                            <h6 class="mb-2">General Certificate of Education (Ordinary Level) </h6>
                                            <span>- Amarasooriya Collage</span>
                                            <p class="mt-2">After grade 11, students take national exams for the General Certificate of Education (Ordinary Level) . The General Certificate of Education (Ordinary Level) is often abbreviated as GCE O/L.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="timeline-box mt-4">
                            <h5 class="resume-experience-title">Work &amp; Experience:</h5>
                            <div class="jobster-candidate-timeline">

                                <div class="jobster-timeline-item">
                                    <div class="jobster-timeline-cricle">
                                        <i class="far fa-circle"></i>
                                    </div>
                                    <div class="jobster-timeline-info">
                                        <div class="dashboard-timeline-info">
                                            <span class="jobster-timeline-time">2023-02-08 to 2023-08-08</span>
                                            <h6 class="mb-2">Senior Software Engineere</h6>
                                            <span>- Xess Globle</span>
                                            <p class="mt-2">One of the main areas that I work on with my clients is shedding these non-supportive beliefs and replacing them with beliefs that will help them to accomplish their desires.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="jobster-timeline-item">
                                    <div class="jobster-timeline-cricle">
                                        <i class="far fa-circle"></i>
                                    </div>
                                    <div class="jobster-timeline-info">
                                        <div class="dashboard-timeline-info">
                                            <span class="jobster-timeline-time">2018-06-08 to 2022-08-08</span>
                                            <h6 class="mb-2">Software Enginere</h6>
                                            <span>- Zincat</span>
                                            <p class="mt-2">One of the main areas that I work on with my clients is shedding these non-supportive beliefs and replacing them with beliefs that will help them to accomplish their desires.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="timeline-box mt-4">
                            <h5 class="resume-experience-title">Professional Qualifications:</h5>
                            <div class="jobster-candidate-timeline">
                                <div class="jobster-timeline-item">
                                    <div class="jobster-timeline-cricle">
                                        <i class="far fa-circle"></i>
                                    </div>
                                    <div class="jobster-timeline-info">
                                        <div class="dashboard-timeline-info">
                                            <span class="jobster-timeline-time">2 years</span>
                                            <h6 class="mb-2">Diploma In Software Enginnering</h6>
                                            <span>- IJSE</span>
                                            <p class="mt-2">One of the main areas that I work on with my clients is shedding these non-supportive beliefs and replacing them with beliefs that will help them to accomplish their desires.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="jobster-timeline-item">
                                    <div class="jobster-timeline-cricle">
                                        <i class="far fa-circle"></i>
                                    </div>
                                    <div class="jobster-timeline-info">
                                        <div class="dashboard-timeline-info">
                                            <span class="jobster-timeline-time">1 year</span>
                                            <h6 class="mb-2">Software Enginering</h6>
                                            <span>- Esoft</span>
                                            <p class="mt-2">One of the main areas that I work on with my clients is shedding these non-supportive beliefs and replacing them with beliefs that will help them to accomplish their desires.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
