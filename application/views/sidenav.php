<div class='toc' ng-controller='NavigationController'>
    <ul id='slide-out' class='side-nav fixed'>
        <li class='no padding'>
            <a class='logo' title='ExtentX' href='<?php echo $projectUrl; ?>'><?php echo $projectLogoText; ?></a>
        </li>
        
        <li ng-repeat="item in items" class="no-padding" ng-class="{'active': item.id == states.activeItem}" ng-click="states.activeItem=item.id">
            <a href='{{ item.target }}' alt='{{ item.title }}' title='{{ item.title }}'>
                <i class='fa {{ item.icon }}'></i>
                <span class="item-name hidden">{{ item.title }}</span>
            </a>
        </li>

        <li class='item bottom' ng-click='setTheme("dark")'>
            <a href='#!'>
                <i class='fa fa-desktop'></i>
            </a>
        </li>
    </ul>
</div>
