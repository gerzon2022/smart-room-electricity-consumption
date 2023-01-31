<?php
include "../php/db_conn.php";
$output = '';
if (isset($_POST['export_excel'])) {
    $sql = "SELECT * FROM schedule ORDER BY user ASC";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0) {
        $totalhours = 0;
        $output .= '
            <table>

                <!-- SCHEDULE TABLE HEAD -->
                <thead>
                    <tr>
                        <th>User Scheduled</th>
                        <th>Building</th>
                        <th>Classroom</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Hourly Load</th>
                    </tr>
                </thead>
                <tbody>
        ';
        while ($row = mysqli_fetch_array($result)) {
            $date1 = new DateTime($row['start_time']);
            $date2 = new DateTime($row['end_time']);
            $diff = $date1->diff($date2);
            $hours = $diff->h;
            $hours = $hours + ($diff->days*24);
            $totalhours += $hours;
                $output .= '
                    <tr>
                        <th>'.$row['user'].'</th>
                        <td>'.$row['building'].'</td>
                        <td>'.$row['room_number'].'</td>
                        <td>'.$row['start_time'].'</td>
                        <td>'.$row['end_time'].'</td>
                        <td>'.$hours.'</td>
                    </tr>
                ';
        }

        $output .= '
                <tr>
                    <th colspan="5">Total Load Consumed</th>
                    <td colspan="1">'.$totalhours.'</td>
                </tr>
                </tbody>
            </table>
        ';
        header("Content-Type: application/xls");
        header("Content-Disposition: attachment; filename=data.xls");
        echo $output;
    }
}
?>