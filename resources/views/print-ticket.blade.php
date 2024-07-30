<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Junji - {{ $generate_ticket->ticket_code }}</title>
    <style>
        table {
            width: 100%;
        }

        td {
            text-align: center;
        }

        #container div {
            display: inline-block;
            text-align: center;
        }
    </style>
</head>

<body>
    <table>
        <tr>
            <td>
                <div id="container">
                    <div>
                        <img src="<?= public_path('storage/qr-code/' . $generate_ticket->ticket_code . '.png') ?>"
                            width="100" alt="">
                        <p>{{ $generate_ticket->ticket_code }}</p>

                    </div>
                </div>
            </td>
        </tr>
    </table>
</body>

</html>
