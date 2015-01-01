<!-- BEGIN: MAIN -->
    <tr>
        <td class="width30" colspan="2"><h3>Данные для регистрации аккаунта на сайте</h3></td>
    </tr>
    <!-- IF {USERS_REGISTER_GROUPSELECT} -->
    <tr>
        <td class="width30">{PHP.L.profile_group}:</td>
        <td class="width70">{USERS_REGISTER_GROUPSELECT} *</td>
    </tr>
    <!-- ENDIF -->
    <tr>
        <td class="width30">{PHP.L.Username}:</td>
        <td class="width70">{USERS_REGISTER_USER} *</td>
    </tr>
    <tr>
        <td>{PHP.L.users_validemail}:</td>
        <td>
            {USERS_REGISTER_EMAIL} *
            <p class="small">{PHP.L.users_validemailhint}</p>
        </td>
    </tr>
    <tr>
        <td>{PHP.L.Password}:</td>
        <td>{USERS_REGISTER_PASSWORD} *</td>
    </tr>
    <tr>
        <td>{PHP.L.users_confirmpass}:</td>
        <td>{USERS_REGISTER_PASSWORDREPEAT} *</td>
    </tr>
    
<!-- END: MAIN -->