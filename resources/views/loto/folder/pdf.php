<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Título Opcional</title>

        <!--Custon CSS (está em /public/assets/site/css/certificate.css)-->
        <link rel="stylesheet" href="{{ url('assets/site/css/certificate.css') }}">
    </head>
    <body>

        <h4>Apostas</h4>
        <table>
            <?php
            $jogos = json_decode($jogos);
            $i = 1;
            foreach ($jogos as $jogo) {                
                echo '<tr>';
                echo "<th>$i ->>></th>";
                foreach ($jogo as $numero) {
                    if ($numero < 10) {
                        echo "<td>0$numero</td>";
                    } else {
                        echo "<td>$numero</td>";
                    }
                }
                echo '</tr>';
                $i++;
            }
            ?>

        </table>


    </body>
</html>

