<?php
$rules = getRules();
//$ext = getMaxExtensions();
//echo gettype($ext);
//foreach (getMaxExtensions() as $max) {
//    echo $max[0];
//}
//echo getMaxExtensions()[0];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $rent = [];
    $rent['rentalID'] = $_POST['rentalID'] ?? '';
    $rent['memberID'] = $_POST['memberID'] ?? '';
    $rent['startDate'] = $_POST['startDate'] ?? '';
    $rent['period'] = $_POST['period'] ?? '';

    if (isset($_POST['extend'])) {
        $rent['extension'] = $_POST['extension'];


        $numOfExtension = getMaxExtensions();
        $extensionValue = getExtension($rent);
        if ($extensionValue >= $numOfExtension) {
            echo '<script language = "javascript">';
            echo 'alert ("Error: Could not extend game");';
            echo '</script>';
        } else {
            $result = updateRentalExtension($rent);
            $result = updateRentalPeriod($rent);
            redirect_to(url_for('staff/dashboard.php?tab=rentals'));


        }
        // TODO: remove post

    } else if (!isset($_POST['extend'])) {
        if (isset($_POST['isDamaged'])) $isDamaged = true;
        else $isDamaged = false;
        $result = returnRental($rent, $isDamaged);
        if ($result !== true) {
            echo '<script language = "javascript">';
            echo 'window.location.href = "addRental.php";';
            echo 'alert ("Error: Could not return game");';
            echo '</script>';
        }
    }

}
?>
<div class="justify-content-between flex-wrap flex-md-nowrap align-items-center text-center mb-5 mt-5">
    <h1 class="align-left">Rentals</h1>
    <a class="btn btn-add align-right" href="pages/addRental.php" title="Record rental"><i class="fas fa-plus"></i></a>
    <div class="clear-float"></div>
</div>
<div class="row mt-3">
    <div class="col">
        <div class="card card-purple card-big">
            <div class="card-title title-purple">
                <div class="label">Current rentals</div>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th class="no-border" scope="col">Game Title</th>
                        <th class="no-border" scope="col">Member Name</th>
                        <th class="no-border" scope="col">Until</th>
                        <th class="no-border" scope="col">Extensions</th>
                        <th class="no-border" scope="col"></th>
                        <th class="no-border" scope="col"></th>
                        <th class="no-border" scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $rentals = findRentals();
                    while ($rental = mysqli_fetch_assoc($rentals)) {
                        if (isCurrentRental($rental)) { ?>
                            <tr>
                                <td><?php echo $rental['name']; ?></td>
                                <td><?php echo $rental['firstname'] . " " . $rental['surname']; ?></td>
                                <td><?php echo calculateEndDate($rental['startDate'], $rental['period']); ?></td>
                                <td><?php echo $rental['extension']; ?></td>
                                <td>
                                    <form method="post" action=''>
                                        <button type="submit" name="extend" class="btn btn-outline-primary">
                                            <i class="fas fa-plus-circle"></i> extend
                                        </button>
                                        <input type="hidden" name="rentalID" value= <?php echo $rental['rentalID'] ?>>
                                        <input type="hidden" name="memberID" value= <?php echo $rental['memberID'] ?>>
                                        <input type="hidden" name="extension" value= <?php echo $rental['extension'] ?>>
                                        <input type="hidden" name="period" value= <?php echo $rental['period'] ?>>

                                    </form>
                                </td>

                                <form action="" method="post">
                                    <td><input type="checkbox" name="isDamaged"> Damaged</td>
                                    <input type="hidden" name="rentalID" value= <?php echo $rental['rentalID'] ?>>
                                    <input type="hidden" name="memberID" value= <?php echo $rental['memberID'] ?>>
                                    <input type="hidden" name="startDate" value= <?php echo $rental['startDate'] ?>>
                                    <input type="hidden" name="period" value= <?php echo $rental['period'] ?>>
                                    <td>
                                        <button type="submit" class="btn btn-outline-primary">
                                            <i class="fas fa-undo-alt"></i> return
                                        </button>
                                    </td>
                                </form>
                            </tr>
                        <?php }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <div class="card-footer"></div>
        </div>
    </div>
</div>
<div class="row mt-5">
    <div class="col">
        <div class="card card-blue card-big">
            <div class="card-title title-blue">
                <div class="label">Past rentals</div>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th class="no-border" scope="col">Game Title</th>
                        <th class="no-border" scope="col">Member Name</th>
                        <th class="no-border" scope="col">Until</th>
                        <th class="no-border" scope="col">Extensions</th>
                        <th class="no-border" scope="col">Return Date</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php $rentals = findRentals();
                    while ($rental = mysqli_fetch_assoc($rentals)) {
                        if (!isCurrentRental($rental)) { ?>
                            <tr>
                                <td><?php echo $rental['name']; ?></td>
                                <td><?php echo $rental['firstname']; ?></td>
                                <td><?php echo calculateEndDate($rental['startDate'], $rental['period']); ?></td>
                                <td><?php echo $rental['extension']; ?></td>
                                <td><?php echo $rental['returnDate']; ?></td>
                            </tr>
                        <?php }
                    } ?>
                    </tbody>
                </table>
            </div>
            <div class="card-footer"></div>
        </div>
    </div>
</div>


<div class="row mt-5">
    <div class="col">
        <div class="card card-blue card-big">
            <div class="card-title title-blue">
                <div class="label">Overdue rentals</div>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th class="no-border" scope="col">Game Title</th>
                        <th class="no-border" scope="col">Member Name</th>
                        <th class="no-border" scope="col">Until</th>
                        <th class="no-border" scope="col">Extensions</th>
                        <th class="no-border" scope="col"></th>
                        <th class="no-border" scope="col"></th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php $rentals = findRentals();
                    while ($rental = mysqli_fetch_assoc($rentals)) {
                        if (isOverdue($rental)) { ?>
                            <tr>
                                <td><?php echo $rental['name']; ?></td>
                                <td><?php echo $rental['firstname']; ?></td>
                                <td><?php echo calculateEndDate($rental['startDate'], $rental['period']); ?></td>
                                <td><?php echo $rental['extension']; ?></td>
                                <form action="" method="post">
                                    <td><input type="checkbox" name="isDamaged"> Damaged</td>
                                    <input type="hidden" name="rentalID" value= <?php echo $rental['rentalID'] ?>>
                                    <input type="hidden" name="memberID" value= <?php echo $rental['memberID'] ?>>
                                    <input type="hidden" name="startDate" value= <?php echo $rental['startDate'] ?>>
                                    <input type="hidden" name="period" value= <?php echo $rental['period'] ?>>
                                    <td>
                                        <button type="submit" class="btn btn-outline-primary">
                                            <i class="fas fa-undo-alt"></i> return
                                        </button>
                                    </td>
                                </form>
                            </tr>
                        <?php }
                    } ?>
                    </tbody>
                </table>
            </div>
            <div class="card-footer"></div>
        </div>
    </div>
</div>
