export const toastUserEnabled = (text, level) => {
    const ToastElement = document.getElementById('mytoast')
    const toast = new bootstrap.Toast(ToastElement)

    document.querySelector('.toast').classList.remove('text-bg-success')
    document.querySelector('.toast').classList.add(level)
    document.querySelector('.toast').innerHTML = text
    toast.show()
}