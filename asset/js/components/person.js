import {autoCompleteAddress, createPerson, updatePerson} from "../services/person.js"
import {toastUserEnabled} from './chared/toast.js'

export const autoCompleteElement = async () => {
    document.querySelector('#inputAddress').addEventListener('keydown', async () => {
        const adressValue = document.querySelector('#inputAddress').value
        const zipCodeElement = document.querySelector('#zip-code')
        const cityCodeElement = document.querySelector('#city')

        if(adressValue.length > 4) {
            adressValue.replace(' ', '+')

            const data = await autoCompleteAddress(adressValue)
            printAddress(data)

            const btnAddress = document.querySelectorAll('.btn-adress')

            for(let i = 0; i < btnAddress.length; i++) {
                btnAddress[i].addEventListener('click', () => {
                    const zip_code = e.target.getDataAttribute('data-zip-code')
                    const city = e.target.getDataAttribute('data-city')
                    console.log('j ai ete cliquer')

                    zipCodeElement.setAttribute('value', zip_code)
                    cityCodeElement.setAttribute('value', city)
                })
            }
        }
    })
}

const printAddress = (data) => {
    const dataList = document.querySelector('#datalistOptions')
    const tabRes = []

    for(let i = 0; i < data.features.length; i++) {
        tabRes.push(`<option 
                    value="${data.features[i].properties.label}"
                    class="btn-adress"
                    data-zip-code="${data.features[i].properties.postcode}" 
                    data-city="${data.features[i].properties.city}"
                    >
                    </option>`)
    }
    dataList.innerHTML = tabRes.join('')
}

export const handelPerson = () => {
    const btn = document.querySelector('#btn-add-person')

    btn.addEventListener('click', async () => {
        const form = document.querySelector('#form-person')
        if(!form.checkValidity()) {
            form.reportValidity()
            return false
        }
        const btn = document.querySelector('#btn-add-person')
        if(btn.getAttribute('name') === 'new-btn') {
            const res = await createPerson(form)
            if(res.success === false) {
                toastUserEnabled(res.error, 'text-bg-danger')
            } else {
                toastUserEnabled('Personnes cree', 'text-bg-success')
                form.reset()
            }
        } else{
            const res = await updatePerson(form, btn.getAttribute('data-id'))
            if(res.success === false) {
                toastUserEnabled(res.error, 'text-bg-danger')
            } else {
                toastUserEnabled('Personnes modifier', 'text-bg-success')
                form.reset()
            }
        }

    })
}