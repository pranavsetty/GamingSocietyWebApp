<div class="justify-content-between flex-wrap flex-md-nowrap align-items-center text-center mb-5 mt-5">
    <h1 class="align-left">Members</h1>
    <a class="btn btn-add align-right" href="pages/addMember.php" title="Add member"><i class="fas fa-plus"></i></a>
    <div class="clear-float"></div>
</div>
<div class="row mt-3">
    <div class="col">
        <div class="card card-blue card-big">
            <div class="card-title title-blue">
                <div class="align-left label">Active members: </div>
                <div class="align-right"><?php echo countActiveMembers(); ?></div>
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
                    </tr>
                    </thead>
                    <tbody>
                      <?php $members = getActiveMembers();
                            while($member = mysqli_fetch_assoc($members)) {?>
                    <tr>
                        <td><?php echo $member['firstname'] . " " . $member['surname']; ?></td>
                        <td><?php echo $member['DoB']; ?></td>
                        <td><?php echo $member['phoneNo']; ?></td>
                        <td><?php echo $member['email']; ?></td>
                        <td><?php echo $member['homeAddress']; ?></td>
                        <td><?php echo $member['violations']; ?></td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="card-footer"></div>
        </div>
    </div>
</div>
<div class="row mt-5">
    <div class="col">
        <div class="card card-purple card-big" id="banned">
            <div class="card-title title-purple">
                <div class="align-left label">Banned members: </div>
                <div class="align-right"><?php echo countBanMembers(); ?> </div>
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
                        <th class="no-border" scope="col">Until</th>
                        <th class="no-border" scope="col"></th>
                        <th class="no-border" scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php $members =  getBannedMembers();
                            while($member = mysqli_fetch_assoc($members)) {?>
                    <tr>
                        <td><?php echo $member['firstname'] . " " . $member['surname'];  ?></td>
                        <td><?php echo $member['DoB']; ?></td>
                        <td><?php echo $member['phoneNo']; ?></td>
                        <td><?php echo $member['email']; ?></td>
                        <td><?php echo $member['homeAddress']; ?></td>
                        <td><?php echo $member['violations']; ?></td>
                        <?php $ban = getBanByMember($member['memberID']);
                        if(hasEndDate($ban['memberID'])) {
                            echo '<td>' . $ban['endDate'] . '</td>';
                        } else {
                            echo '<td>paid back</td>';
                        }
                        if ($member['debt'] != '0') {
                            echo '<td>' . $member['debt'] . '£</td>
                            <td>
                                <a href="pages/editDebt.php?id=' . ($member['memberID']) . '" class="btn-outline-primary">
                                    <i class="far fa-money-bill-alt"></i> pay back
                                </a>
                            </td>';
                        } ?>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="card-footer"></div>
        </div>
    </div>
</div>
