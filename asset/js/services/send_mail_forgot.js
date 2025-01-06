export const sendMailForgot = async (formMail) => {
    const data = new FormData(formMail)

    const res = await fetch(`index.php?component=send_mail_forgot`, {
        method: 'POST',
        body: data,
        headers: {
            'X-Requested-Width': 'XMLHttpRequest'
        }
    })

    return res.json()
}