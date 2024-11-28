<?php
/**
 * @var array $users
 */
?>

<div class="mt-2 mb-2 d-flex justify-content-center align-items-center">
    <h1 class="text-center">Liste des utilisateurs</h1>
    <a href="index.php?component=user&action=new" class="ms-4 btn btn-primary">Nouveau Utilisateur <i class="fa-solid fa-plus"></i></a>
</div>
<div class="row">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Username</th>
            <th scope="col">Actif</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
            <?php foreach($users as $user): ?>
            <tr>
                <td><?php echo $user['id'];?></td>
                <td><?php echo $user['username'];?></td>
                <td>
                    <a href="index.php?component=users&action=toogle_enabled&id=<?php echo $user['id'];?>">
                        <i class="fa-solid <?php echo ($user['enabled']) ? 'fa-check text-success' : 'fa-xmark text-danger'; ?>"></i>
                    </a>
                </td>
                <td>
                    <a href="index.php?component=users&action=delete&id=<?php echo $user['id'];?>">
                        <i class="fa-solid fa-trash text-danger"></i>
                    </a>
                    <a href="index.php?component=user&action=edit&id=<?php echo $user['id'];?>">
                        <i class="fa-solid fa-pen-to-square text-primary ms-2"></i>
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
