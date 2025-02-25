<?php
/**
* @var array $unLikedUsers
 */
?>

<div class="row">
    <div class="col">
        <h1 class="text-center">Crée une personne</h1>
    </div>
</div>
<form id="form-person">
    <div class="mb-3">
        <div class="row">
            <div class="col">
                <label for="last_name" class="form-label">Nom de Famille</label>
                <input type="text" class="form-control" id="last_name" name="last_name" required value="<?php echo $res['last_name'] ?? ''?>">
            </div>
            <div class="col">
                <label for="first_name" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="first_name" name="first_name" required value="<?php echo $res['first_name'] ?? ''?>">
            </div>
        </div>
    </div>
    <div class="mb-3">
        <label for="inputAddress" class="form-label">Addresse</label>
        <input
                type="text"
                class="form-control"
                id="inputAddress"
                name="address"
                placeholder="24 rue Jeanne D'arc"
                required
                value="<?php echo $res['address'] ?? ''?>"
                list="datalistOptions">
        <datalist id="datalistOptions">

        </datalist>
    </div>
    <div class="mb-3">
        <div class="row">
            <div class="col">
                <label for="city" class="form-label">Ville</label>
                <input type="text" class="form-control" id="city" name="city" required value="<?php echo $res['city'] ?? ''?>">
            </div>
            <div class="col">
                <label for="zip-code" class="form-label">Code Postal</label>
                <input type="text" class="form-control" id="zip-code" name="zip_code" required value="<?php echo $res['zip_code'] ?? ''?>">
            </div>
        </div>
    </div>
    <div class="mb-3">
        <div class="row">
            <div class="col">
                <label for="phone" class="form-label">Téléphone</label>
                <input type="tel" class="form-control" id="phone" name="phone" required value="<?php echo $res['phone'] ?? ''?>">
            </div>
            <div class="col">
                <label for="type" class="form-label">Type</label>
                <select class="form-select" aria-label="Selectioner un type" name="type" id="type" required>
                    <option <?php echo !isset($res['type']) ? 'selected': ''?>>Selectioner un type</option>
                    <option value="1" <?php echo (isset($res['type']) && $res['type'] === 1) ? 'selected': ''?>>Elève</option>
                    <option value="2" <?php echo (isset($res['type']) && $res['type'] === 2) ? 'selected': ''?>>Proffesseur</option>
                </select>
            </div>
        </div>
    </div>
    <div class="mb-3">
        <div class="row">
            <div class="col">
                <label for="user-link" class="form-label">Liaison Utilisateur</label>
                <select
                        class="form-select"
                        aria-label="Selectioner un utilisateur"
                        name="user-link"
                        id="user-link"
                        required
                        <?php echo (isset($res) && $res['user_id'] !== null) ? 'disabled': '';?>
                >
                    <option selected value="">Selectioner un utilisateur</option>
                    <?php foreach ($unLikedUsers as $unLikedUser): ?>
                        <option
                                value="<?php echo $unLikedUser['id'];?>"
                                <?php echo (isset($res) && $res['user_id'] === $unLikedUser['id']) ? 'selected': '';?>
                                <?php echo ($unLikedUser['user_id'] !== null || $unLikedUser['person_id'] !== null) ? 'disabled' : ''?>
                        >
                            <?php echo $unLikedUser['username']?>
                        </option>
                    <?php endforeach;?>
                </select>
            </div>
        </div>
    </div>
    <button
            type="button"
            class="btn btn-primary"
            id="btn-add-person"
            name="<?php echo isset($res) ? 'edit-btn': 'new-btn'?>"
            data-id="<?php echo isset($res) ? $res['id'] : ''?>"
    >
        Créer la personne
    </button>
</form>
<script src="./asset/js/components/person.js" type="module"></script>
<script type="module">
    import {handelPerson, autoCompleteElement} from "./asset/js/components/person.js";

    document.addEventListener('DOMContentLoaded', () => {
        autoCompleteElement()
        handelPerson()
    })
</script>
