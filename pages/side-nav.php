<style>
    .menu {
        cursor: pointer;
    }
</style>
<?php if(isset($_SESSION['acc_type'])) {  ?> 




<div class="side-nav">
    <div class="nav-items-container">
        <ul class="nav-list">
        <?php if ($_SESSION['acc_type'] === 'admin') { ?> 
            <li class="nav-item admin " id = "activate-user"><div class="menu"><a href="" >activate users</a></div></li>
        <?php }?>
        <?php if ($_SESSION['acc_type'] === 'admin') { ?> 
            <li class="nav-item admin"><div class="menu"><a href="">renew student</a></div></li>
        <?php }?>
        <?php if ($_SESSION['acc_type'] === 'faculty') { ?> 
            <li class="nav-item faculty"><div class="menu" data-id = "schedule">class schedule</div></li>
        <?php }?>
        <?php if ($_SESSION['acc_type'] === 'admin') { ?> 
            <li class="nav-item admin"><a href="dashboard.php?page=main&action=set_power"><div class="menu">set power allowance</div></a></li>
        <?php }?>
        <?php if ($_SESSION['acc_type'] === 'faculty' || $_SESSION['acc_type'] === 'admin') { ?> 
            <li class="nav-item admin faculty"><div class="menu" data-id="classroom">classroom on demand</div></li>
        <?php }?>
        <?php if ($_SESSION['acc_type'] === 'admin') { ?> 
            <li class="nav-item admin"><a href=""><div class="menu">Reports</div></a></li>
        <?php }?>
        <?php if ($_SESSION['acc_type'] === 'student') { ?> 
            <li class="nav-item student"><a href=""><div class="menu">reset power allowance</div></a></li>
        <?php }?>
            <li class="nav-item admin faculty student"><a href="../logout.php"><div class="menu">Logout</div></li></a>
        </ul>
    </div>
</div>
<?php }?> 
<script>
$(document).ready(function(){
    $(".nav-item").on("click", function(){
        let action =  $(this).find(".menu").attr("data-id")
        if(action) {
            $("#"+action+"-tab").click()
        }
    })
})
        
     
            
            
        
       
 
   
</script>

