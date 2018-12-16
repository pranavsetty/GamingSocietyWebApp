<?php

if (isPostRequest()) {
    $rent = [];
    $rent['rentalID'] = $_POST['rentalID'] ?? '';
    $rent['memberID'] = $_POST['memberID'] ?? '';
    $rent['startDate'] = $_POST['startDate'] ?? '';
    $rent['period'] = $_POST['period'] ?? '';

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
?>
<div class="justify-content-between flex-wrap flex-md-nowrap align-items-center text-center mb-5 mt-5">

    <h1>Overview</h1>
</div>
<div class="row mt-3">
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
                    if (isOverdue($rental)){ ?>
                    <tr>
                        <td><?php echo $rental['name']; ?></td>
                        <td><?php echo $rental['firstname'] . " " . $rental['surname']; ?></td>
                        <td><?php echo calculateEndDate($rental['startDate'], getPeriod()); ?></td>
                        <td><?php echo $rental['extension']; ?></td>
                        <form action="" method="post">
                            <td><input type="checkbox" name="isDamaged"> Damaged</td>
                            <input type="hidden" name="rentalID" value= <?php echo $rental['rentalID'] ?>>
                            <input type="hidden" name="memberID" value= <?php echo $rental['memberID'] ?>>
                            <input type="hidden" name="startDate" value= <?php echo $rental['startDate'] ?>>
                            <input type="hidden" name="period" value= <?php echo getPeriod(); ?>>
                            <td>
                                <button type="submit" class="btn btn-outline-primary">
                                    <i class="fas fa-undo-alt"></i> return
                                </button>
                            </td>
                        </form>
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
        <div class="card card-purple card-big">
            <div class="card-title title-purple">
                <div class="align-left label">Total outstanding fees:</div>
                <div class="align-right"><?php echo countTotalDebt() . '£'; ?></div>
                <div class="clear-float"></div>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th class="no-border" scope="col">Member Name</th>
                        <th class="no-border" scope="col">Date of Birth</th>
                        <th class="no-border" scope="col">Phone Number</th>
                        <th class="no-border" scope="col">Email</th>
                        <th class="no-border" scope="col">Home address</th>
                        <th class="no-border" scope="col">Violations</th>
                        <th class="no-border" scope="col">Debt</th>
                        <th class="no-border" scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $members = getMembersWithFees();
                    while ($member = mysqli_fetch_assoc($members)) { ?>
                        <tr>
                            <td><?php echo $member['firstname'] . " " . $member['surname']; ?></td>
                            <td><?php echo $member['DoB']; ?></td>
                            <td><?php echo $member['phoneNo']; ?></td>
                            <td><?php echo $member['email']; ?></td>
                            <td><?php echo $member['homeAddress']; ?></td>
                            <td><?php echo $member['violations']; ?></td>
                            <td><?php echo $member['debt'] . '£'; ?></td>
                            <td>
                                <a href="<?php echo('pages/editDebt.php?id=' . ($member['memberID'])); ?>" class="btn-outline-primary">
                                    <i class="far fa-money-bill-alt"></i> pay back
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="card-footer"></div>
        </div>
    </div>
</div>
