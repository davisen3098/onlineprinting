<?php require_once('initialize.php');
$db = new DBConnection();
$conn = $db->conn;
if(!$conn) { die("Connection failed: " . mysqli_connect_error()); }
?>
<h1>Welcome to <?php echo $_settings->info('name'); ?></h1>
<hr class="border-info">
<?php
function duration($dur = 0){
    if($dur == 0){ return "00:00"; }
    $hours = floor($dur / (60 * 60));
    $min = floor($dur / 60) - ($hours*60);
    $dur = sprintf("%'.02d",$hours).":".sprintf("%'.02d",$min);
    return $dur;
}
?>
<div class="row">
    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
        <div class="info-box bg-gradient-light shadow">
            <span class="info-box-icon bg-gradient-primary elevation-1"><i class="fas fa-tasks"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">New Projects</span>
                <span class="info-box-number text-right">
                    <?php 
                    $query = $conn->query("SELECT * FROM `project_list` WHERE delete_flag=0 AND `status` = 0");
                    echo $query ? $query->num_rows : 0;
                    ?>
                </span>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
        <div class="info-box bg-gradient-light shadow">
            <span class="info-box-icon bg-gradient-info elevation-1"><i class="fas fa-tasks"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">In-Progress Projects</span>
                <span class="info-box-number text-right">
                    <?php 
                    $query = $conn->query("SELECT * FROM `project_list` WHERE delete_flag=0 AND `status` = 1");
                    echo $query ? $query->num_rows : 0;
                    ?>
                </span>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
        <div class="info-box bg-gradient-light shadow">
            <span class="info-box-icon bg-gradient-secondary elevation-1"><i class="fas fa-tasks"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Closed Projects</span>
                <span class="info-box-number text-right">
                    <?php 
                    $query = $conn->query("SELECT * FROM `project_list` WHERE delete_flag=0 AND `status` = 2");
                    echo $query ? $query->num_rows : 0;
                    ?>
                </span>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
        <div class="info-box bg-gradient-light shadow">
            <span class="info-box-icon bg-gradient-warning elevation-1"><i class="fas fa-file-alt"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total Reports</span>
                <span class="info-box-number text-right">
                    <?php 
                    $user_id = $_settings->userdata('id');
                    $query = $conn->query("SELECT * FROM `report_list` WHERE employee_id = '$user_id'");
                    echo $query ? $query->num_rows : 0;
                    ?>
                </span>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
        <div class="info-box bg-gradient-light shadow">
            <span class="info-box-icon bg-gradient-success elevation-1"><i class="fas fa-clock"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total Time Alloted</span>
                <span class="info-box-number text-right">
                    <?php 
                    $user_id = $_settings->userdata('id');
                    $query = $conn->query("SELECT sum(duration) as total FROM `report_list` WHERE employee_id = '$user_id'");
                    $result = $query ? $query->fetch_array() : [0];
                    echo duration($result[0]);
                    ?>
                </span>
            </div>
        </div>
    </div>
</div>
<hr>
