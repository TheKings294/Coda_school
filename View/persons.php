<?php
/**
 * @var array $persons
 */
?>

<div class="mt-2 mb-2 d-flex justify-content-center align-items-center">
    <h1 class="text-center">Liste des personnes</h1>
</div>
<div class="row">
    <div class="col d-flex justify-content-center">
        <div class="spinner-border text-primary d-none" role="status" id="spinner">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
</div>
<div class="row">
    <table class="table" id="liste-person">
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

        </tbody>
    </table>
</div>
<script src="./asset/js/services/persons.js" type="module"></script>
<script type="module">
    import {getPersons} from "./asset/js/services/persons.js";

    document.addEventListener('DOMContentLoaded', async () => {
        const spinner = document.querySelector('#spinner')
        spinner.classList.remove('d-none')

        const data = await getPersons()
        console.log(data)
    })
</script>
