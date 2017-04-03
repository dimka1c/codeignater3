<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Welcome to CodeIgniter</title>

    <style type="text/css">

        ::selection { background-color: #E13300; color: white; }
        ::-moz-selection { background-color: #E13300; color: white; }

        body {
            background-color: #fff;
            margin: 40px;
            font: 13px/20px normal Helvetica, Arial, sans-serif;
            color: #4F5155;
        }

        a {
            color: #003399;
            background-color: transparent;
            font-weight: normal;
        }

        h1 {
            color: #444;
            background-color: transparent;
            border-bottom: 1px solid #D0D0D0;
            font-size: 19px;
            font-weight: normal;
            margin: 0 0 14px 0;
            padding: 14px 15px 10px 15px;
        }

        code {
            font-family: Consolas, Monaco, Courier New, Courier, monospace;
            font-size: 12px;
            background-color: #f9f9f9;
            border: 1px solid #D0D0D0;
            color: #002166;
            display: block;
            margin: 14px 0 14px 0;
            padding: 12px 10px 12px 10px;
        }

        #body {
            margin: 0 15px 0 15px;
        }

        p.footer {
            text-align: right;
            font-size: 11px;
            border-top: 1px solid #D0D0D0;
            line-height: 32px;
            padding: 0 10px 0 10px;
            margin: 20px 0 0 0;
        }

        #container {
            margin: 10px;
            border: 1px solid #D0D0D0;
            box-shadow: 0 0 8px #D0D0D0;
        }
    </style>
</head>
<body>

<div id="container">
    <div id="body">
        <a href="/c_index/probegi"> Мои пробеги </a>
        <a href="/c_index/calendar"> Календарь рабочих дней </a>
        <a href=""> Ремонты </a>
        <a href=""> статистика </a>

        <a href="">Личный кабинет</a>
        <a href="/c_index/exit_login">выход</a>
    </div>
</div>
<div id="container">
    <div id="container">
        <h1>Вы вошли как:
            <?php
            if(isset($user_name) && isset($user_id)) {
                echo '  -  '.$user_name.'  ('.$user_id.')';
            }
            ?>
        </h1>
    </div>

    <div id="body">
        <div id="flogin">
            <?php

                function rewriteData($data) {
                    $str = explode("-",$data);
                    return $str[2]."-".$str[1]."-".$str[0];
                }

                if(isset($km)) {
                    echo '<table border=2>';
                    foreach ($km as $arr) {
                        echo '<tr>';

                        echo '<td>';
                        echo rewriteData($arr['data']);
                        echo '</td>';

                        echo '<td>';
                        echo $arr['time_run'];
                        echo '</td>';

                        echo '<td>';
                        echo $arr['time_end'];
                        echo '</td>';

                        echo '<td>';
                        echo $arr['speedometer_start'];
                        echo '</td>';

                        echo '<td>';
                        echo $arr['speedometer_end'];
                        echo '</td>';

                        echo '<td>';
                        echo $arr['rest_fuel_begin'];
                        echo '</td>';

                        echo '<td>';
                        echo $arr['fueled'];
                        echo '</td>';

                        echo '<td>';
                        echo $arr['reffils_cost'];
                        echo '</td>';

                        echo '</tr>';
                    }
                    echo '</table>';
                }
                if (isset($workday)) {
                    foreach ($workday as $arr) {
                        echo '<br>'.rewriteData($arr['data']);
                    }
                }
            ?>
        </div>
    </div>

    <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>


</body>
</html>