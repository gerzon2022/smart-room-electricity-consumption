
<div class="side-nav">
    <div class="nav-items-container">
        <ul class="nav-list">
            <li class="nav-item admin " id = "activate-user"><div class="menu"><a href="" >activate users</a></div></li>
            <li class="nav-item admin"><div class="menu"><a href="">renew student</a></div></li>
            <li class="nav-item faculty"><div class="menu"><a href="">class schedule</a></div></li>
            <li class="nav-item admin"><div class="menu"><a href="">set power allowance</a></div></li>
            <li class="nav-item admin faculty"><div class="menu"><a href="">classroom on demand</a></div></li>
            <li class="nav-item admin"><div class="menu"><a href="">Reports</a></div></li>
            <li class="nav-item student"><div class="menu"><a href="">reset power allowance</a></div></li>
            <li class="nav-item admin faculty student"><div class="menu"><a href="../logout.php">Logout</a></div></li>
        </ul>
    </div>
</div>
<script>
    //wafdasfsad
$(".nav-item").hide()    
if(sessionStorage.getItem("acc-type") == "admin"){
    $(".admin").show()
} else if(sessionStorage.getItem("acc-type") == "faculty") {
    $(".faculty").show()
} else if(sessionStorage.getItem("acc-type") == "student") {
    $(".student").show()
} else {
    $(".nav-item").hide()
}
</script>
