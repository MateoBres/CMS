<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Spesavicino.it</title>
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
                                Nuovo Ordine Ricevuto
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 5px 10px 5px 10px;">
                                dettagli:
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 5px 10px 5px 10px;">Codice: {{ $data['code'] }}</td>
                        </tr>
                        <tr>
                            <td style="padding: 5px 10px 5px 10px;">Articoli</td>
                        </tr>
                        <tr>
                            <td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
                                <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse;">
                                    <tr>
                                        <td align="right" style="padding: 5px 10px 5px 10px;">Articolo</td>
                                        <td align="right" style="padding: 5px 10px 5px 10px;">SKU</td>
                                        <td align="right" style="padding: 5px 10px 5px 10px;">Quantità</td>
                                        <td align="right" style="padding: 5px 10px 5px 10px;">Prezzo</td>
                                    </tr>
                                    @foreach ($data['items'] as $item)
                                        <tr>
                                            <td align="right" style="padding: 5px 10px 5px 10px;">{{ $item['name'] }}</td>
                                            <td align="right" style="padding: 5px 10px 5px 10px;">{{ $item['sku'] }}</td>
                                            <td align="right" style="padding: 5px 10px 5px 10px;">{{ $item['qty'] }}</td>
                                            <td align="right" style="padding: 5px 10px 5px 10px;">{{ $item['price'] }}</td>
                                        </tr>
                                    @endforeach
                                    @if ($data['type'] == 'Consegna a domicilio')
                                        <tr>
                                            <td align="right" style="padding: 5px 10px 5px 10px;">Costo consegna</td>
                                            <td align="right" style="padding: 5px 10px 5px 10px;"></td>
                                            <td align="right" style="padding: 5px 10px 5px 10px;"></td>
                                            <td align="right" style="padding: 5px 10px 5px 10px;">{{ $data['delivery_charge'] }}</td>
                                        </tr>
                                    @elseif ($data['type'] == 'Spedizione' && !$data['is_free'])
                                        <tr>
                                            <td align="right" style="padding: 5px 10px 5px 10px;">Costo spedizione</td>
                                            <td align="right" style="padding: 5px 10px 5px 10px;"></td>
                                            <td align="right" style="padding: 5px 10px 5px 10px;"></td>
                                            <td align="right" style="padding: 5px 10px 5px 10px;">{{ $data['ship_charge'] }}</td>
                                        </tr>
                                    @elseif ($data['type'] == 'Spedizione' && $data['is_free'])
                                        <tr>
                                            <td align="right" style="padding: 5px 10px 5px 10px;">Costo spedizione</td>
                                            <td align="right" style="padding: 5px 10px 5px 10px;"></td>
                                            <td align="right" style="padding: 5px 10px 5px 10px;"></td>
                                            <td align="right" style="padding: 5px 10px 5px 10px;">Gratis</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td align="right" style="padding: 5px 10px 5px 10px;">Totale: {{ $data['total'] }}</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 5px 10px 5px 10px;">Tipo Ordine: {{ $data['type'] }}</td>
                        </tr>
                        @if ($data['address'])
                            <tr>
                                <td style="padding: 5px 10px 5px 10px;">Indirizzo: {{ $data['address'] }}</td>
                            </tr>
                        @endif
                        <tr>
                            <td style="padding: 5px 10px 5px 10px;">Data: {{ $data['date'] }}</td>
                        </tr>
                        @if ($data['type'] == 'Spedizione')
                            <tr>
                                <td style="padding: 5px 10px 5px 10px;">Orario: {{ substr($data['time'], 0, 5) }}</td>
                            </tr>
                        @else
                            <tr>
                                <td style="padding: 5px 10px 5px 10px;">Orario: {{ $data['time'] }}</td>
                            </tr>
                        @endif
                        @if ($data['doorbell'])
                            <tr>
                                <td style="padding: 5px 10px 5px 10px;">Nome Campanello: {{ $data['doorbell'] }}</td>
                            </tr>
                        @endif
                        @if ($data['notes'])
                            <tr>
                                <td style="padding: 5px 10px 5px 10px;">Note: {{ $data['notes'] ? $data['notes'] : '//' }}</td>
                            </tr>
                        @endif
                        @if ($data['phone'])
                            <tr>
                                <td style="padding: 5px 10px 5px 10px;">Telefono: {{ $data['phone'] }}</td>
                            </tr>
                        @endif
                        @if ($data['payment_info'] && $data['payment_info']->is_paid == true)
                            <tr>
                                <td style="background-color: green">Metodo di Pagamento: carta di credito</td>
                            </tr>
                        @endif
                        @if ($data['payment_info'] && $data['payment_info']->is_paid == false)
                            <tr>
                                <td style="background-color: red">Metodo di Pagamento: {{ $data['payment_info']->payment_type == 'cash' ? 'contanti alla consegna' : 'bonifico bancario' }}</td>
                            </tr>
                        @endif
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>
