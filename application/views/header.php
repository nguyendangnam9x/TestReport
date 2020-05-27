<div class='navbar navbar-default'>
    <span alt="Toggle sidenav" title="Toggle sidenav" id='expand-sidenav' class='item' ng-controller="NavigationController" navigation-state>
        <i class='fa fa-arrow-circle-o-right'></i>
    </span>
    <a class='item' alt='Search' title='Search' href='#/search'>
        <i class='fa fa-search'></i>
    </a>
    
    <!-- current project -->
    <!---<a class='item' href=''><span class='label'><%= typeof req.session.project !== 'undefined' && req.session.project != null && req.session.project !== '' ? req.session.project : '' %></span></a>-->

    <!-- check if a user is logged-in on page-load -->    
    <a class="hidden" ng-controller='UserController' ng-init="isLoggedIn();"></a>
    <!-- sign-in button -->
    <span alt="Sign in" title="Sign in" ng-controller='SigninController' ng-if='loggedIn === undefined || loggedIn == false' ng-click='open()' class='item' href='#!'>
        <i class='fa fa-user'></i>
    </span>
    <!-- if signed in, allow actions via the user-name label -->
    <span ng-if="loggedIn" uib-dropdown on-toggle="toggled(open)">
        <a href alt="User {{ loggedInUserName }}" title="User {{ loggedInUserName }}" id="user-dropdown" uib-dropdown-toggle>
            <span class="label label-info">{{ loggedInUserName || "Tester VN" }} &nbsp; <i class="fa fa-user"></i></span>
        </a>
        <ul uib-dropdown-menu aria-labelledby="user-dropdown">
            <li ng-if="isAdmin">
                <a href="#/admin"><i class='fa fa-user-secret'></i> &nbsp; Admin Panel</a>
            </li>
            <li>
                <a href ng-controller="SignoutController" ng-click="logout()">Logout</a>
            </li>
        </ul>
    </span>

    <!-- project selection -->
    <span class="item" uib-dropdown on-toggle="toggled(open)" ng-controller="ReportController">
        <a href alt="Select Project" title="Select Project" id="project-dropdown" uib-dropdown-toggle ng-if="res.projects.length > 1">
            <i class="fa fa-folder-open"></i>
        </a>
        <ul uib-dropdown-menu aria-labelledby="project-dropdown">
            <li ng-repeat="project in res.projects" class="{{(project.name === <?php echo "'".$currentProject."'"; ?>) ? 'selected' : ''}}">
                <a href ng-controller="ProjectController" ng-click="update(project.name)">
                    <span>{{ project.name }}</span>
                </a>
            </li>
            <li class="divider"></li>
            <li>
                <a href ng-controller="ProjectController" ng-click="update('')">Reset</a>
            </li>
        </ul>
    </span>
    
    <div class='float-right menu'>
    <?php
      foreach ($floatRightMenu as $key => $value) {
        echo "<a class='item' href='$value'>$key</a>";
      }
    ?>
    </div>
</div>
            
<?php $this->load->view('sidenav') ?>
<?php //$this->load->view('signin') ?>
<?php $this->load->view('dataPointsSetting') ?>
