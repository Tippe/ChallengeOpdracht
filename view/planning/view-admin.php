<div class="container">

    <h1>Planning overzicht</h1>

    <table class="table">
        <tr>
            <th>Barber</th>
            <th>Date</th>
            <th>Start Time sessie</th>
            <th>End Time sessie</th>
            <th>Reserved</th>
            <th>Costumer</th>
            <th>Status</th>

            <th colspan="3">Actie</th>
        </tr>

        <?php
        if ($planning == false) {
            echo '<tr><td colspan="10">Er zijn geen beschikbare momenten toegevoegd.</td></tr>';

        } else {

            foreach ($planning as $plan) {
                $employeeData = getEmployee($plan['employee']);
                $employee = $employeeData["firstname"];
                $customerData = getCustomer($plan['customer']);
                $customer = $customerData["firstname"]." ".$customerData["lastname"];
                ?>
                <tr>
                    <td><?=$employee;?></td>
                    <td><?=$plan['date'];?></td>
                    <td><?=$plan['start_time'];?></td>
                    <td><?=$plan['end_time'];?></td>
                    <td><?=$plan['reserved'];?></td>
                    <td><?=$customer;?></td>
                    <td><?= $plan['status']; ?></td>
                    <?php if($plan['reserved'] == "Yes") { ?>
                        <td><a href="<?= URL ?>planning/success/<?= $plan['id'] ?>">Appointment done</a></td>
                        <td><a href="<?= URL ?>planning/fail/<?= $plan['id'] ?>">Did not show up</a></td>
                    <?php } else { ?>
                        <td></td>
                        <td></td>
                    <?php } ?>
                    <?php if($plan['reserved'] == "No" || $plan['status'] > 0) { ?>
                        <td><a href="<?= URL ?>planning/delete/<?= $plan['id'] ?>">Delete</a></td>
                    <?php } else { ?>
                        <td></td>
                    <?php } ?>
                </tr>
            <?php
            }
        }
        ?>

    </table>
    <h5><a href="<?= URL ?>planning/create">Make an appointment</a></h5>
</div>