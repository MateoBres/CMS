<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Spesavicino.it - Recupero Password</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

    <body style="margin: 0; padding: 0;">
        <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse;">
            <tr>
                <td align="center" bgcolor="#f18500" style="padding: 40px 0 30px 0;">
                    <img src="{{ asset('/images/logo-spesa-vicino-bianco.png') }}" width="600" height="177" style="display: block;" />
                </td>
            </tr>
            <tr>
                <td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
                    <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse;">
                        <tr>
                            <td style="padding: 5px 10px 5px 10px;">
                                Recupero Password
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 5px 10px 5px 10px;">
                                Nuova Password: <b>{{ $data['new_password'] }}</b>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 5px 10px 5px 10px;">
                                Gentile Cliente, utilizza la password provvisoria per effettuare il prossimo accesso a spesavicino.it;<br>
                                Consigliamo vivamente di cambiare la password appena ricevuta nella sezione Informazioni
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>