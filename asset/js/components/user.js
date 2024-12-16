import {toogleUser} from '../services/users.js'

export const toastUserEnabled = (text, level) => {
    const ToastElement = document.getElementById('mytoast')
    const toast = new bootstrap.Toast(ToastElement)

        document.querySelector('.toast-body').classList.remove('text-bg-success')
        document.querySelector('.toast-body').classList.add(level)
        document.querySelector('.toast-body').innerHTML = text
        toast.show()
}

export const UpdateUserEnabled = async () => {
    const iconLinkToogle = document.querySelectorAll('.icon-link')
    const spinners = document.querySelectorAll('.spinner-enabled')

    for (let i = 0; i < iconLinkToogle.length; i++) {
        iconLinkToogle[i].addEventListener('click', async (e) => {
            spinners[i].classList.remove('d-none')
            if(iconLinkToogle[i].classList.contains('fa-check')) {
                const data = await toogleUser(parseInt(e.target.getAttribute('data-id')))
                if(data.hasOwnProperty('success')) {
                    iconLinkToogle[i].classList.remove('fa-check', 'text-success')
                    iconLinkToogle[i].classList.add('fa-xmark', 'text-danger')
                    toastUserEnabled('Stutus utilisateur changer', 'text-bg-success')
                } else {
                    toastUserEnabled(data.error, 'text-bg-danger')
                }
            } else {
                const data = await toogleUser(parseInt(e.target.getAttribute('data-id')))
                if(data.hasOwnProperty('success')) {
                    iconLinkToogle[i].classList.add('fa-check', 'text-success')
                    iconLinkToogle[i].classList.remove('fa-xmark', 'text-danger')
                    toastUserEnabled('Stutus utilisateur changer', 'text-bg-success')
                } else {
                    toastUserEnabled(data.error, 'text-bg-danger')
                }
            }
            spinners[i].classList.add('d-none')
        })
    }
}