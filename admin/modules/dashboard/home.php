<?php
/**
 * @Created by          : Waris Agung Widodo (ido.alit@gmail.com)
 * @Date                : 2019-01-22 22:50:50
 * @Last Modified by    : Waris Agung Widodo (ido.alit@gmail.com)
 * @Last Modified time  : 2020-03-01 19:40:24
 *
 * Copyright (C) 2019  Waris Agung Widodo (ido.alit@gmail.com)
 */

use SLiMS\DB;

if (!defined('INDEX_AUTH')) {
    define('INDEX_AUTH', '1');
}

if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    include_once '../../sysconfig.inc.php';
}

$start_date = date('Y-m-d');
?>
    <div class="menuBox">
        <div class="menuBoxInner systemIcon">
            <div class="per_title">
                <h2><?php echo __('Dashboard'); ?></h2>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="h1 biblio_total_all">0</div>
                    <div class="text-muted"><?= __('Total Title') ?></div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="h1 item_total_all">0</div>
                    <div class="text-muted"><?= __('Total Item') ?></div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="h1 item_total_lent">0</div>
                    <div class="text-muted"><?= __('Item Lent') ?></div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="h1 item_total_available">0</div>
                    <div class="text-muted"><?= __('Item Available') ?></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-8 s-dashboard">
            <div class="panel panel-default">
                <div class="panel-heading"><?php echo __('Latest Transactions'); ?></div>
                <div class="panel-body">
                    <canvas id="line-chartjs" height="294"></canvas>
                    <div class="s-dashboard-legend">
                        <i class="fa fa-square" style="color:#F4CC17;"></i> <?php echo __('Loan'); ?>
                        <i class="fa fa-square" style="color:#459CBD;"></i> <?php echo __('Return'); ?>
                        <i class="fa fa-square" style="color:#5D45BD;"></i> <?php echo __('Extend'); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 s-dashboard">
            <div class="panel panel-default">
                <div class="panel-heading"><?php echo __('Circulation Summary'); ?></div>
                <div class="panel-body">
                    <div class="s-chart">
                        <canvas id="radar-chartjs" width="175" height="175"></canvas>
                    </div>
                    <table class="table">
                        <tr>
                            <td class="text-left"><i class="fa fa-square"
                                                     style="color:#f2f2f2;"></i>&nbsp;&nbsp;<?php echo __('Total'); ?>
                            </td>
                            <td class="text-right loan_total">0</td>
                        </tr>
                        <tr>
                            <td class="text-left"><i class="fa fa-square"
                                                     style="color:#337AB7;"></i>&nbsp;&nbsp;<?php echo __('New'); ?>
                            </td>
                            <td class="text-right loan_new">0</td>
                        </tr>
                        <tr>
                            <td class="text-left"><i class="fa fa-square"
                                                     style="color:#06B1CD;"></i>&nbsp;&nbsp;<?php echo __('Return'); ?>
                            </td>
                            <td class="text-right loan_return">0</td>
                        </tr>
                        <tr>
                            <td class="text-left"><i class="fa fa-square"
                                                     style="color:#4AC49B;"></i>&nbsp;&nbsp;<?php echo __('Extends'); ?>
                            </td>
                            <td class="text-right loan_extend">0</td>
                        </tr>
                        <tr>
                            <td class="text-left"><i class="fa fa-square"
                                                     style="color:#F4CC17;"></i>&nbsp;&nbsp;<?php echo __('Overdue'); ?>
                            </td>
                            <td class="text-right loan_overdue">0</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo JWB ?>chartjs/Chart.min.js"></script>
    <script>

        $(function () {

            async function getTotal(url, selector = null) {
                if (selector !== null) $(selector).text('...');
                let res = await (await fetch(url, {
                    headers: {
                        'SLiMS-Http-Cache': 'cache'
                    }
                })).json();
                if (selector !== null) $(selector).text(new Intl.NumberFormat('id-ID').format(res.data));
                return res.data;
            }

            getTotal('<?= SWB ?>index.php?p=api/biblio/total/all', '.biblio_total_all');
            getTotal('<?= SWB ?>index.php?p=api/item/total/all', '.item_total_all');
            getTotal('<?= SWB ?>index.php?p=api/item/total/lent', '.item_total_lent');
            getTotal('<?= SWB ?>index.php?p=api/item/total/available', '.item_total_available');

            // get summary
            fetch('<?= SWB ?>index.php?p=api/loan/summary', {
                headers: {
                    'SLiMS-Http-Cache': 'cache'
                }
            })
                .then(res => res.json())
                .then(res => {
                    if (res.data) {
                        $('.loan_total').text(new Intl.NumberFormat('id-ID').format(res.data.total));
                        $('.loan_new').text(new Intl.NumberFormat('id-ID').format(res.data.new));
                        $('.loan_return').text(new Intl.NumberFormat('id-ID').format(res.data.return));
                        $('.loan_extend').text(new Intl.NumberFormat('id-ID').format(res.data.extend));
                        $('.loan_overdue').text(new Intl.NumberFormat('id-ID').format(res.data.overdue));

                        let data = [{
                            value: parseInt(res.data.total),
                            color: "#f2f2f2",
                            label: "<?php echo __('Total'); ?>"
                        }, {
                            value: parseInt(res.data.new),
                            color: "#337AB7",
                            label: "<?php echo __('Loan'); ?>"
                        }, {
                            value: parseInt(res.data.return),
                            color: "#06B1CD",
                            label: "<?php echo __('Return'); ?>"
                        }, {
                            value: parseInt(res.data.extend),
                            color: "#4AC49B",
                            label: "<?php echo __('Extend'); ?>"
                        }, {
                            value: parseInt(res.data.overdue),
                            color: "#F4CC17",
                            label: "<?php echo __('Overdue'); ?>"
                        }];

                        let r = $('#radar-chartjs');
                        let container = $(r).parent();
                        let rt = r.get(0).getContext("2d");
                        $(window).resize(respondCanvas);

                        function respondCanvas() {
                            r.attr('width', $(container).width()); //max width
                            r.attr('height', $(container).height()); //max height
                            //Call a function to redraw other content (texts, images etc)
                            let myChart = new Chart(rt).Doughnut(data, {
                                animation: false,
                                segmentStrokeWidth: 1
                            });
                        }

                        respondCanvas()
                    }

                });

            // ===================================
            // bar chart
            // ===================================

            fetch('<?= SWB ?>index.php?p=api/loan/getdate/<?= $start_date ?>', {
                headers: {
                    'SLiMS-Http-Cache': 'cache'
                }
            })
                .then(res => res.json())
                .then(res => {

                    let a = getTotal('<?= SWB ?>index.php?p=api/loan/summary/<?= $start_date ?>');
                    a.then(res_total => {

                        let lineChartData = {
                            labels: res.raw,
                            datasets: [{
                                fillColor: '#F4CC17',
                                highlightFill: '#F4CC17',
                                data: res_total.loan
                            }, {
                                fillColor: '#459CBD',
                                highlightFill: '#459CBD',
                                data: res_total.return
                            }, {
                                fillColor: '#5D45BD',
                                highlightFill: '#5D45BD',
                                data: res_total.extend
                            },]
                        }

                        let c = $('#line-chartjs');
                        let container = $(c).parent();
                        let ct = c.get(0).getContext("2d");
                        $(window).resize(respondCanvas);

                        function respondCanvas() {
                            c.attr('width', $(container).width()); //max width
                            c.attr('height',.
                            //Call a function to redraw other content (texts, images etc)
                            new Chart(ct).Bar(lineChartData, {
                                barShowStroke: false,
                                barDatasetSpacing: 4,
                                animation: {
                                    onProgress: function (animation) {
                                        // progress.value = animation.animationObject.currentStep / animation.animationObject.numSteps;
                                    }
                                }
                            });
                        }

                        respondCanvas();
                    })
                })
        });

    </script>
<?php

$check_q = $dbs->query('SELECT COUNT(setting_value) FROM setting WHERE setting_name LIKE \'%database_password%\'');
$check_d = $check_q->fetch_row();
if ($check_d < 1) {
    echo '<div class="s-alert danger"><strong>Security Warning!</strong> Database root password is not set. Please set it in lib/config.inc.php file!</div>';
}
?>
