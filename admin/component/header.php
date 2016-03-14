<!--starting of nav bar -->
<div class="navbar navbar-fixed-top navbar-inverse">
    <div class="navbar-inner">
        <div class="container-fluid">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="admin.php"><span style="color:#00ccff">Social Share</span></a>
            <ul class="nav pull-right">
                <li class="dropdown" id="accountmenu">  
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo $_SESSION['uname']; ?><b class="caret"></b></a>  
                    <ul class="dropdown-menu">  
                        <li class="divider"></li>  
                        <li><a href="logout.php"><i class="icon-off"></i> Sign Out</a></li>  
                    </ul>  
                </li>  
            </ul>
        </div>
    </div>
</div>
<!--End of nav bar -->    