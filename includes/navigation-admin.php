<header class="navbar navbar-header navbar-header-fixed">
    <a href="" id="mainMenuOpen" class="burger-menu d-none d-md-flex d-lg-none"><i data-feather="menu"></i></a>
    <a href="" id="mailSidebar" class="burger-menu d-md-none"><i data-feather="arrow-left"></i></a>
    <div class="navbar-brand">
        <a href="../../index.html" class="df-logo">The<span>Nation</span></a>
    </div><!-- navbar-brand -->
    <div id="navbarMenu" class="navbar-menu-wrapper">
        <div class="navbar-menu-header">
            <a href="../../index.html" class="df-logo">The<span>Nation</span></a>
            <a id="mainMenuClose" href=""><i data-feather="x"></i></a>
        </div><!-- navbar-menu-header -->
        <ul class="nav navbar-menu ">
            <li class="nav-label pd-l-20 pd-lg-l-25 d-lg-none">Main Navigation</li>
            <li class="nav-item active">
                <a href="<?php echo $baseUrl; ?>/admin/dashboard.php" class="nav-link">Dashboard</a>
            </li>
            <li class="nav-item with-sub">
                <a href="" class="nav-link"><i data-feather="package"></i> Leads</a>
                <ul class="navbar-menu-sub">
                    <li class="nav-sub-item"><a href="<?php echo $baseUrl; ?>/leads/view_all_leads.php"
                            class="nav-sub-link"><i data-feather="users"></i>View All</a></li>
                
                </ul>
            </li>
            <li class="nav-item with-sub">
                <a href="" class="nav-link"><i data-feather="package"></i> Applications</a>
                <ul class="navbar-menu-sub">
                    <li class="nav-sub-item"><a href="<?php echo $baseUrl; ?>/applications/view_all_applications.php"
                            class="nav-sub-link"><i data-feather="users"></i>View All</a></li>
                    <li class="nav-sub-item"><a href="#" class="nav-sub-link"><i data-feather="users"></i>Contacts</a>
                    </li>
                    <li class="nav-sub-item"><a href="<?php echo $baseUrl; ?>/interview/view_all_interviews.php" class="nav-sub-link"><i
                                data-feather="activity"></i>Interview</a></li>

                </ul>
            </li>
            <li class="nav-item"><a href="<?php echo $baseUrl; ?>/contracts/view_all_Contracts.php" class="nav-link"><i
                        data-feather="box"></i> Contracts</a>
            </li>
            <li class="nav-item with-sub">
                <a href="" class="nav-link"><i data-feather="layers"></i> Agents</a>
                <ul class="navbar-menu-sub">
                    <li class="nav-sub-item"><a
                            href="<?php echo $baseUrl; ?>/agents/local-agent/view_all_local_agent.php"
                            class="nav-sub-link"><i data-feather="users"></i>Local Agent</a></li>
                    <li class="nav-sub-item"><a
                            href="<?php echo $baseUrl; ?>/agents/foreign-agent/view_all_foreign_agent.php"
                            class="nav-sub-link"><i data-feather="users"></i>Foriegn Agent</a></li>
                    <li class="nav-sub-item"><a href="<?php echo $baseUrl; ?>/agents/sponcers/view_all_sponcer.php" class="nav-sub-link"><i
                                data-feather="activity"></i>Sponcers</a></li>
                    <li class="nav-sub-item"><a href="<?php echo $baseUrl; ?>/job-orders/view_all_joborders.php"
                            class="nav-sub-link"><i data-feather="activity"></i>Job Orders</a></li>
                </ul>
            </li>
            <li class="nav-item with-sub">
                <a href="" class="nav-link"><i data-feather="layers"></i> Processings</a>
                <ul class="navbar-menu-sub">
                    <li class="nav-sub-item"><a href="<?php echo $baseUrl; ?>/medical/view_all_medicals.php"
                            class="nav-sub-link"><i data-feather="users"></i>Medical</a></li>
                    <li class="nav-sub-item"><a href="<?php echo $baseUrl; ?>/enjaz/view_all_enjaz.php"
                            class="nav-sub-link"><i data-feather="users"></i>Enjaz</a></li>
                    <li class="nav-sub-item"><a href="<?php echo $baseUrl; ?>/fPrint/view_all_fprint.php"
                            class="nav-sub-link"><i data-feather="users"></i>Finger Print</a></li>
                    <li class="nav-sub-item"><a href="<?php echo $baseUrl; ?>/muzaned/view_all_muzaned.php"
                            class="nav-sub-link"><i data-feather="users"></i>Musaned</a></li>
                    <li class="nav-sub-item"><a href="<?php echo $baseUrl; ?>/bureau/view_all_bureau_new.php"
                             class="nav-sub-link"><i data-feather="users"></i>Beauro</a></li>
                                <li class="nav-sub-item"><a href="<?php echo $baseUrl; ?>/trainings/view_all_trainings.php" class="nav-sub-link"><i
                                data-feather="activity"></i>Training</a></li>
                                <li class="nav-sub-item"><a href="<?php echo $baseUrl; ?>/visa-stamping/view_all_visa_new.php" class="nav-sub-link"><i
                                data-feather="activity"></i>Visa Stamping</a></li>
                </ul>
            </li>

            <li class="nav-item"><a href="<?php echo $baseUrl; ?>/help-desk/view-all-complains.php" class="nav-link"><i data-feather="archive"></i> Help
                    Desk</a></li>
            <li class="nav-item with-sub">
                <a href="../../collections/" class="nav-link"><i data-feather="archive"></i>
                    Accounts</a>
                <ul class="navbar-menu-sub">
                    <li class="nav-sub-item"><a href="app-calendar.html" class="nav-sub-link"><i
                                data-feather="users"></i>Recevables</a></li>
                    <li class="nav-sub-item"><a href="<?php echo $baseUrl; ?>/accounts/payabel/view_all_payabel.php" class="nav-sub-link"><i
                                data-feather="users"></i>Payables</a></li>
                </ul>
            </li>
            <li class="nav-item with-sub">
                <a href="" class="nav-link"><i data-feather="layers"></i> Data</a>
                <ul class="navbar-menu-sub">
                    <li class="nav-sub-item"><a href="<?php echo $baseUrl; ?>/data-creation/medical-centers.php"
                            class="nav-sub-link"><i data-feather="users"></i>Medical Centers</a></li>
                    <li class="nav-sub-item"><a href="<?php echo $baseUrl; ?>/data-creation/training-centers.php" class="nav-sub-link"><i
                                data-feather="users"></i>Training Centers</a></li>
                    <li class="nav-sub-item"><a href="<?php echo $baseUrl; ?>/data-creation/users.php" class="nav-sub-link"><i
                                data-feather="activity"></i>Users</a></li>
                    <li class="nav-sub-item"><a href="app-file-manager.html" class="nav-sub-link"><i
                                data-feather="activity"></i>Skills</a></li>
                    <li class="nav-sub-item"><a href="app-file-manager.html" class="nav-sub-link"><i
                                data-feather="activity"></i>Lanuages</a></li>
                </ul>
            </li>
        </ul>
    </div><!-- navbar-menu-wrapper -->
    <div class="navbar-right">
        <div class="dropdown dropdown-message">
            <a href="" class="dropdown-link new-indicator" data-bs-toggle="dropdown">
                <i data-feather="message-square"></i>
                <span>5</span>
            </a>
            <div class="dropdown-menu dropdown-menu-end">
                <div class="dropdown-header">New Messages</div>
                <a href="" class="dropdown-item">
                    <div class="media">
                        <div class="avatar avatar-sm avatar-online"><img src="https://placehold.co/500"
                                class="rounded-circle" alt=""></div>
                        <div class="media-body mg-l-15">
                            <strong>Socrates Itumay</strong>
                            <p>nam libero tempore cum so...</p>
                            <span>Mar 15 12:32pm</span>
                        </div><!-- media-body -->
                    </div><!-- media -->
                </a>
                <a href="" class="dropdown-item">
                    <div class="media">
                        <div class="avatar avatar-sm avatar-online"><img src="https://placehold.co/500"
                                class="rounded-circle" alt=""></div>
                        <div class="media-body mg-l-15">
                            <strong>Joyce Chua</strong>
                            <p>on the other hand we denounce...</p>
                            <span>Mar 13 04:16am</span>
                        </div><!-- media-body -->
                    </div><!-- media -->
                </a>
                <a href="" class="dropdown-item">
                    <div class="media">
                        <div class="avatar avatar-sm avatar-online"><img src="https://placehold.co/500"
                                class="rounded-circle" alt=""></div>
                        <div class="media-body mg-l-15">
                            <strong>Althea Cabardo</strong>
                            <p>is there anyone who loves...</p>
                            <span>Mar 13 02:56am</span>
                        </div><!-- media-body -->
                    </div><!-- media -->
                </a>
                <a href="" class="dropdown-item">
                    <div class="media">
                        <div class="avatar avatar-sm avatar-online"><img src="https://placehold.co/500"
                                class="rounded-circle" alt=""></div>
                        <div class="media-body mg-l-15">
                            <strong>Adrian Monino</strong>
                            <p>duis aute irure dolor in repre...</p>
                            <span>Mar 12 10:40pm</span>
                        </div><!-- media-body -->
                    </div><!-- media -->
                </a>
                <div class="dropdown-footer"><a href="">View all Messages</a></div>
            </div><!-- dropdown-menu -->
        </div><!-- dropdown -->
        <div class="dropdown dropdown-notification">
            <a href="" class="dropdown-link new-indicator" data-bs-toggle="dropdown">
                <i data-feather="bell"></i>
                <span>2</span>
            </a>
            <div class="dropdown-menu dropdown-menu-end">
                <div class="dropdown-header">Notifications</div>
                <a href="" class="dropdown-item">
                    <div class="media">
                        <div class="avatar avatar-sm avatar-online"><img src="https://placehold.co/500"
                                class="rounded-circle" alt=""></div>
                        <div class="media-body mg-l-15">
                            <p>Congratulate <strong>Socrates Itumay</strong> for work anniversaries</p>
                            <span>Mar 15 12:32pm</span>
                        </div><!-- media-body -->
                    </div><!-- media -->
                </a>
                <a href="" class="dropdown-item">
                    <div class="media">
                        <div class="avatar avatar-sm avatar-online"><img src="https://placehold.co/500"
                                class="rounded-circle" alt=""></div>
                        <div class="media-body mg-l-15">
                            <p><strong>Joyce Chua</strong> just created a new blog post</p>
                            <span>Mar 13 04:16am</span>
                        </div><!-- media-body -->
                    </div><!-- media -->
                </a>
                <a href="" class="dropdown-item">
                    <div class="media">
                        <div class="avatar avatar-sm avatar-online"><img src="https://placehold.co/500"
                                class="rounded-circle" alt=""></div>
                        <div class="media-body mg-l-15">
                            <p><strong>Althea Cabardo</strong> just created a new blog post</p>
                            <span>Mar 13 02:56am</span>
                        </div><!-- media-body -->
                    </div><!-- media -->
                </a>
                <a href="" class="dropdown-item">
                    <div class="media">
                        <div class="avatar avatar-sm avatar-online"><img src="https://placehold.co/500"
                                class="rounded-circle" alt=""></div>
                        <div class="media-body mg-l-15">
                            <p><strong>Adrian Monino</strong> added new comment on your photo</p>
                            <span>Mar 12 10:40pm</span>
                        </div><!-- media-body -->
                    </div><!-- media -->
                </a>
                <div class="dropdown-footer"><a href="">View all Notifications</a></div>
            </div><!-- dropdown-menu -->
        </div><!-- dropdown -->
        <div class="dropdown dropdown-profile">
            <a href="" class="dropdown-link" data-bs-toggle="dropdown" data-display="static">
                <div class="avatar avatar-sm"><img src="https://placehold.co/387" class="rounded-circle" alt=""></div>
            </a><!-- dropdown-link -->
            <div class="dropdown-menu dropdown-menu-end tx-13">
                <div class="avatar avatar-lg mg-b-15"><img src="https://placehold.co/387" class="rounded-circle" alt="">
                </div>
                <h6 class="tx-semibold mg-b-5"><?php echo $username; ?></h6>
                <p class="mg-b-25 tx-12 tx-color-03"><?php echo $userrolename; ?></p>

                <a href="" class="dropdown-item"><i data-feather="edit-3"></i> Edit Profile</a>
                <a href="page-profile-view.html" class="dropdown-item"><i data-feather="user"></i> View Profile</a>
                <div class="dropdown-divider"></div>
                <a href="page-help-center.html" class="dropdown-item"><i data-feather="help-circle"></i> Help Center</a>
                <a href="" class="dropdown-item"><i data-feather="life-buoy"></i> Forum</a>
                <a href="" class="dropdown-item"><i data-feather="settings"></i>Account Settings</a>
                <a href="" class="dropdown-item"><i data-feather="settings"></i>Privacy Settings</a>
                <a href="<?php echo $baseUrl; ?>/public/logout.php" class="dropdown-item"><i data-feather="log-out"></i>Sign Out</a>
            </div><!-- dropdown-menu -->
        </div><!-- dropdown -->
    </div><!-- navbar-right -->
</header><!-- navbar -->