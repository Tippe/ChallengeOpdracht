<div class="container">

    <h1>Planning overzicht</h1>

    <table class="table">
        <tr>
            <th>Barber</th>
            <th>Date</th>
            <th>Start Time sessie</th>
            <th>End Time sessie</th>

            <th>Actie</th>
        </tr>

        <?php
        if ($planning == false) {
            echo '<tr><td colspan="10">Er zijn geen beschikbare momenten toegevoegd.</td></tr>';

        } else {

            foreach ($planning as $plan) {
                $employeeData = getEmployee($plan['employee']);
                $employee = $employeeData["firstname"];
                ?>
                <tr>
                    <td><?=$employee;?></td>
                    <td><?=$plan['date'];?></td>
                    <td><?=$plan['start_time'];?></td>
                    <td><?=$plan['end_time'];?></td>
                    <td><a href="<?= URL ?>planning/inplannen/<?= $plan['id'] ?>">Plan mij in</a></td>
                </tr>
            <?php
            }
        }
        ?>

    </table>
    <a href="<?= URL ?>planning/planned">Scheduled appointments</a>
</div>