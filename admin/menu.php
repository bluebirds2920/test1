<ul class="navbar-nav bg-dark sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-snowplow"></i>
    </div>
    <div class="sidebar-brand-text mx-3">crane&nbsp;Rental</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="index.php">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">
<li class="nav-item ">
    <a class="nav-link" href="rent_check_insert.php">
        <i class="fas fa-truck"></i>
        <span>ยืนยันการเช่าเครน</span></a>
</li>

<li class="nav-item ">
    <a class="nav-link" href="anstheques.php">
        <i class="fas fa-comments"></i>
        <span>ตอบคำถาม</span></a>
</li>

<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    ข้อมูลภายในบริษัท
</div>


  
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
        aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-fw fa-folder"></i>
        <span>จัดการข้อมูล</span>
    </a>
    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">                
            <a class="collapse-item" href="edit_staff.php">พนักงาน</a>
            <a class="collapse-item" href="edit_crane.php">รถเครน</a>        
        </div>
    </div>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<div class="sidebar-heading">
    ข้อมูลสมาชิก
</div>


<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages3"
        aria-expanded="true" aria-controls="collapsePages3">
        <i class="fas fa-address-book"></i>
        <span>จัดการข้อมูล</span>
    </a>
    <div id="collapsePages3" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
         
            <a class="collapse-item" href="edit_member.php">สมาชิก</a>
            
       
            
        </div>
    </div>
</li>
<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">
<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>
</ul>