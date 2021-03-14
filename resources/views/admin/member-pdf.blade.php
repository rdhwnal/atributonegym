<html>
    <head>
        <title>
            Laporan Pendaftaran Membership
        </title>
        <style type="text/css">

        .test-result-table {

            border: 1px solid black;
            width: 100%;
        }

        .test-result-table-header-cell {

            border-bottom: 1px solid black;
            background-color: silver;
        }

        .test-result-step-command-cell {

            border-bottom: 1px solid gray;
        }

        .test-result-step-description-cell {

            border-bottom: 1px solid gray;
        }

        .test-result-step-result-cell-ok {

            border-bottom: 1px solid gray;
            background-color: green;
        }

        .test-result-step-result-cell-failure {

            border-bottom: 1px solid gray;
            background-color: red;
        }

        .test-result-step-result-cell-notperformed {

            border-bottom: 1px solid gray;
            background-color: white;
        }

        .test-result-describe-cell {
            background-color: tan;
            font-style: italic;
        }

        .test-cast-status-box-ok {
            border: 1px solid black;
            float: left;
            margin-right: 10px;
            width: 45px;
            height: 25px;
            background-color: green;
        }

        </style>
    </head>
    <body>
        <h1 class="test-results-header">
            <center>
                Laporan Pendaftaran Membership
            </center>
        </h1>
        <h2>
            <center>
                @if($month) Bulan @endif {{ $month }} {{ $year }}
            </center>
        </h2>

        <table class="test-result-table" cellspacing="0" width="100%" border="1">
            <thead>
                <tr>
                    <td class="test-result-table-header-cell">
                        No
                    </td>
                    <td class="test-result-table-header-cell">
                        No Pendaftaran
                    </td>
                    <td class="test-result-table-header-cell">
                        Nama
                    </td>
                    <td class="test-result-table-header-cell">
                        Kode Member
                    </td>
                    <td class="test-result-table-header-cell">
                        No Telepon
                    </td>
                    <td class="test-result-table-header-cell">
                        Email
                    </td>
                    <td class="test-result-table-header-cell">
                        Tanggal
                    </td>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $item)
                    <tr class="test-result-step-row test-result-step-row-altone">
                        <td class="test-result-step-command-cell">
                            {{ $key + 1 }}
                        </td>
                        <td class="test-result-step-description-cell">
                            {{ $item->no_pendaftaran }}
                        </td>
                        <td class="test-result-step-description-cell">
                            {{ $item->members()->first()->nama }}
                        </td>
                        <td class="test-result-step-description-cell">
                            {{ $item->members()->first()->kode_member }}
                        </td>
                        <td class="test-result-step-description-cell">
                            {{ $item->members()->first()->no_telepon }}
                        </td>
                        <td class="test-result-step-description-cell">
                            {{ $item->members()->first()->email }}
                        </td>
                        <td class="test-result-step-description-cell">
                            {{ $item->tanggal }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>
