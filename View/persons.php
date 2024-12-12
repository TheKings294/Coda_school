<?php
/**
 * @var array $persons
 */
?>

<div class="mt-2 mb-2 d-flex justify-content-center align-items-center">
    <h1 class="text-center">Liste des personnes</h1>
</div>
<div class="row">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Lastname</th>
            <th scope="col">Firstname</th>
            <th scope="col">Address</th>
            <th scope="col">Zip_code</th>
            <th scope="col">City</th>
            <th scope="col">Phone</th>
            <th scope="col">Type</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
            <?php foreach($persons as $person):?>
            <tr>
                <td><?php echo $person['id']?></td>
                <td><?php echo $person['last_name']?></td>
                <td><?php echo $person['first_name']?></td>
                <td><?php echo $person['address']?></td>
                <td><?php echo $person['zip_code']?></td>
                <td><?php echo $person['city']?></td>
                <td><?php echo $person['phone']?></td>
                <td><?php echo $person['type'] === 1 ? "Student" : "Teacher";?></td>
            </tr>
        </tbody>
        <?php endforeach;?>
    </table>
</div>
