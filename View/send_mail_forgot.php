<div>
    <h1>Entrez votre adresse mail</h1>
    <form id="form-forgot-mail">
        <div class="mb-3">
            <label for="username" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" name="username" required>
        </div>
        <button type="button" class="btn btn-primary" name="login_button" id="send_forgot_mail_btn">Submit</button>
    </form>
    <a href="index.php" class="btn btn-danger mt-2">Retour</a>
</div>
<script src="./asset/js/services/send_mail_forgot.js" type="module"></script>
<script type="module">
    import {sendMailForgot} from "./asset/js/services/send_mail_forgot.js"
    import {toastUserEnabled} from "./asset/js/components/chared/toast.js"

    const btn = document.querySelector('#send_forgot_mail_btn')
    const form = document.querySelector('#form-forgot-mail')

    btn.addEventListener('click', async () => {
        if(form.checkValidity() === false) {
            form.reportValidity()
            return false
        }
        const result = await sendMailForgot(form)
        if(result['success'] === true) {
            toastUserEnabled('mail envoyer', 'text-bg-success')
        } else {
            toastUserEnabled(result['error'], 'text-bg-danger')
        }
    })
</script>