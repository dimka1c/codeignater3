<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Данные по водителю</title>
    <link rel="stylesheet" type="text/css" media="screen" href="<?php base_url();?>/style/grid.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="<?php base_url();?>/style/jqModal.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="<?php base_url();?>/style/main.css" />

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
        <div id="container">

            <table id="list" class="scroll"></table>
            <div id="pager" class="scroll" style="text-align:center;"></div>
            <script type="text/javascript" src="<?php base_url();?>/script/jquery-1.3.1.min.js"></script>
            <script type="text/javascript" src="<?php base_url();?>/script/jquery.jqGrid.js"></script>
            <script type="text/javascript" src="<?php base_url();?>/script/js/min/jqDnR-min.js"></script>
            <script type="text/javascript">
                jQuery(document).ready(function(){
                    var lastSel;
                    jQuery("#list").jqGrid({
                        width:800,
                        height:600,
                        url: '/c_index/tabdata',
                        datatype: 'json',
                        mtype: 'POST',
                        colNames:['#', 'data', 'time1', 'time2', 'km1', 'km2', 'fuel', 'rashod'],
                        colModel :[
                            {name:'id', index:'id', hidden:true, title:false}
                            ,{name:'data', index:'data', width:100}
                            ,{name:'time1', width:70, editable:true}
                            ,{name:'time2', width:70, editable:true}
                            ,{name:'km1', width:100, editable:true}
                            ,{name:'km2', width:100, editable:true}
                            ,{name:'fuel', width:50}
                            ,{name:'rashod', width:50}
                        ],
                        pager: jQuery('#pager'),
                        rowNum: 5,
                        rowList: [20,50,100],
                        sortname: 'id',
                        sortorder: "asc",
                        viewrecords: true,
                        imgpath: '/img/table',
                        ondblClickRow: function(id) {
                            if (id && id != lastSel) {
                                jQuery("#list").restoreRow(lastSel);
                                jQuery("#list").editRow(id, true);
                                lastSel = id;
                            }
                        },
                        editurl: '/c_index/writedata',
                        caption: 'Данные пользователя'
                    });

                    jQuery("#list").navGrid('#pager',
                        {edit:false,add:true,del:true,refresh:true,search:false,view:false});



                });
            </script>

        </div>
        <div id="body">
            календарь
        </div>
    </div>

    <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>


</body>
</html>



















