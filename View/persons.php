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
<div class="row">
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item"><a class="page-link" href="#" id="prev-link">Previous</a></li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#" id="next-link">Next</a></li>
        </ul>
    </nav>
</div>
<script src="./asset/js/services/persons.js" type="module"></script>
<script src="./asset/js/components/persons.js" type="module"></script>
<script type="module">
    import {getPersons} from "./asset/js/services/persons.js";
    import {getRowPerson} from "./asset/js/components/persons.js"

    document.addEventListener('DOMContentLoaded', async () => {
        const spinner = document.querySelector('#spinner')
        const tableElement = document.querySelector('#liste-person')
        const tbody = tableElement.querySelector('tbody')
        const previousLink = document.querySelector('#prev-link')
        const nextLink = document.querySelector('#next-link')
        let curentPage = 1
        spinner.classList.remove('d-none')

        const data = await getPersons()
        for (let i = 0; i < data.length; i++) {
            tbody.appendChild(getRowPerson(data[i]))
        }
        spinner.classList.add('d-none')

        previousLink.addEventListener('click', async () => {

        })
        nextLink.addEventListener('click', async () => {
            curentPage++
            const data = getPersons(curentPage)
        })
    })
</script>
