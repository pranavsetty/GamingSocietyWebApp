<div class="justify-content-between flex-wrap flex-md-nowrap align-items-center text-center mb-5 mt-5">
    <h1 class="align-left">Staff</h1>
    <a class="btn btn-add align-right" href="pages/addStaff.php" title="Add Staff"><i class="fas fa-plus"></i></a>
    <div class="clear-float"></div>
</div>
<div class="row mt-3">
    <div class="col">
        <div class="card card-blue card-big">
            <div class="card-title title-blue">
                <div class="align-left label">Staff</div>
                <div class="align-right"><?php echo countStaff();?></div>
                <div class="clear-float"></div>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th class="no-border" scope="col">Name</th>
                        <th class="no-border" scope="col">Date of Birth</th>
                        <th class="no-border" scope="col">Phone Number</th>
                        <th class="no-border" scope="col">Email</th>
                        <th class="no-border" scope="col">Home address</th>
                        <th class="no-border" scope="col"></th>
                        <th class="no-border" scope="col"></th>
                        <th class="no-border" scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $staff =  get_staff_data();
                    while($staffMember = mysqli_fetch_assoc($staff)) { ?>
                            <tr>
                                <td><?php echo $staffMember['firstname'] . " " . $staffMember['surname']; ?></td>
                                <td><?php echo $staffMember['DoB']; ?></td>
                                <td><?php echo $staffMember['phoneNo']; ?></td>
                                <td><?php echo $staffMember['email']; ?></td>
                                <td><?php echo $staffMember['homeAddress']; ?></td>
                                <td><?php if (isAdmin($staffMember['email'])) echo 'admin'; else echo 'staff' ?></td>
<!--                                TODO:-->
                                <td>delete</td>
                                <td>make admin</td>
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
        <div class="card card-purple card-big">
            <div class="card-title title-purple">
                <div class="align-left label">Rules</div>
                <div class="align-right"><?php echo countRules();?></div>
                <div class="clear-float"></div>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th class="no-border" scope="col">Description</th>
                        <th class="no-border" scope="col">Value</th>
                        <th class="no-border" scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $rules = get_rules_data();
                    while($rule = mysqli_fetch_assoc($rules)) { ?>
                        <tr>
                            <td><?php echo $rule['description']; ?></td>
                            <td><?php echo $rule['value']; ?></td>
                            <td>edit</td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="card-footer"></div>
        </div>
    </div>
</div>
