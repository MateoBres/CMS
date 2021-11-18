<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Spesavicino.it</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    </head>

    <body style="margin: 0; padding: 0;">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h4 class="mb-5">Spesavicino.it - Riepilogo Ordine - Codice: 8-xM1Zk</h4>
                    <div class="col-12">
                        <table class="table mb-5">
                            <thead>
                                <tr>
                                    <th>Articolo</th>
                                    <th>Quantità</th>
                                    <th>Prezzo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['items'] as $item)
                                    <tr>
                                        <td>{{ $item['name'] }}</td>
                                        <td>{{ $item['qty'] }}</td>
                                        <td>{{ $item['price'] }}€</td>
                                    </tr>
                                @endforeach
                                @if ($data['is_delivery'] == true)
                                    <tr>
                                        <td>Spese di spedizione</td>
                                        <td></td>
                                        <td>{{ $data['delivery_charge'] }}€</td>
                                    </tr>
                                @elseif ($data['is_ship'] == true && $data['is_free'])
                                    <tr>
                                        <td>Spese invio</td>
                                        <td></td>
                                        <td>Gratis</td>
                                    </tr>
                                @elseif ($data['is_ship'] == true && !$data['is_free'])
                                    <tr>
                                        <td>Spese invio</td>
                                        <td></td>
                                        <td>{{ $data['ship_charge'] }}€</td>
                                    </tr>
                                @endif

                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th>Totale: {{ $data['total'] }}€</th>
                                </tr>
                            </tbody>
                        </table>
                        <div class="col-12 text-left">
                            <p>Stato dell'ordine: {{ $data['status'] }}</p>
                        </div>
                        <div class="col-12 text-left">
                            <p>Data e Ora: {{ $data['date'] }} - {{ $data['time'] }}</p>
                        </div>
                        @if ($data['is_delivery'] == true)
                            <div class="col-12 text-left">
                                <p>Tipo ordine: Consegna a domicilio</p>
                            </div>
                        @elseif ($data['is_ship'] == true)
                            <div class="col-12 text-left">
                                <p>Tipo ordine: Spedizione</p>
                            </div>
                        @else
                        <div class="col-12 text-left">
                            <p>Tipo ordine: Ritiro in negozio</p>
                        </div>
                        @endif

                        @if ($data['is_delivery'] == true || $data['is_ship'] == true )
                            <div class="col-12 text-left">
                                <p>Indirizzo: {{ $data['address'] }}</p>
                                <p>Nome campanello: {{ $data['doorbell'] }}</p>
                            </div>
                        @endif
                        <div class="col-12 text-left">
                            <p>Telefono: {{ $data['phone'] }}</p>
                        </div>
                        <div class="col-12 text-left">
                            <p>Nome Utente: {{ $data['username'] }}</p>
                            <p>Indirizzo email: {{ $data['email'] }}</p>
                        </div>
                        @if ($data['notes'])
                            <div class="col-12 text-left">
                                <p>Note: {{ $data['notes'] }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
