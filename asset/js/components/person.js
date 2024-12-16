import {autoCompleteAddress, createPerson} from "../services/person.js";
import {toastUserEnabled} from './chared/toast.js';

export const autoCompleteElement = async () => {
    document.querySelector('#inputAddress').addEventListener('keydown', async () => {
        const adressValue = document.querySelector('#inputAddress').value
        if(adressValue.length > 4) {
            adressValue.replace(' ', '+')

            const data = await autoCompleteAddress(adressValue)
            console.log(data)
            printAddress(data)
        }
    })
}

const printAddress = (data) => {
    const dataList = document.querySelector('#datalistOptions')
    const tabRes = []

    for(let i = 0; i < data.length; i++) {
        const optionElement = document.createElement('option')
        optionElement.setAttribute('value', data.features[i].label)
        tabRes.push(optionElement)
    }
    dataList.innerHTML = tabRes.join('')
}

export const handelPerson = () => {
    const btn = document.querySelector('#btn-add-person')

    btn.addEventListener('click', () => {
        const form = document.querySelector('#form-person')
        if(!form.checkValidity()) {
            form.reportValidity()
            return false
        }
        const res = createPerson(form)
        if(res.success === false) {
            toastUserEnabled(res.error, 'text-bg-danger')
        } else {
            toastUserEnabled('Personnes cree', 'text-bg-success')
        }
    })
}