<?php
?>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Test survey">
    <meta name="keywords" content="HTML, CSS, JavaScript">
    <meta name="author" content="Antonio Sugamele">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="lib/style.css" rel="stylesheet">
    <link href="node_modules/bootstrap/dist/css/bootstrap.min.css " rel="stylesheet">
    <script src=" lib/index.js "></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-xs-12 col-sm-12">
                <div class="vuota"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-1 col-xs-12 col-sm-12"></div>
            <div class="col-md-10 col-xs-12 col-sm-12">
                <div class="riquadro" id="intit">
                    <div class="row">
                        <div class="col-md-1 col-xs-12 col-sm-12"></div>
                        <div class="col-md-10 col-xs-12 col-sm-12">
                            <div class="alert alert-danger" id="alert_KO" style="display: none;">Select at least one answer</div>
                        </div>
                        <div class="col-md-1 col-xs-12 col-sm-12"></div>
                    </div>
                    <?php
                    $path = str_replace('/', '\\', $_SERVER['DOCUMENT_ROOT'] . $_SERVER['REQUEST_URI']);
                    $open = json_decode(file_get_contents($path . '\dati\dati.json'), true);
                    if (strcmp(json_last_error(), JSON_ERROR_NONE) == 0) {
                        $dati = count($open) > 0 ? $open[0] : array();
                        if (count($dati['dati']) > 0) {
                            foreach ($dati['dati'] as $key => $value) :
                                $isMultiChoice = $value['multichoice'];
                                $response      = $value['response'];
                                $none          = strcmp($key, 0) !== 0 ? 'display:none' : '';

                    ?>
                                <div id="DOMNADANR<?php echo $key ?>" style="<?php echo $none ?>">
                                    <div class="row">
                                        <div class="col-md-1 col-xs-12 col-sm-12"></div>
                                        <label class="col-md-10 col-xs-12 col-sm-12"><?php echo $value['request'] ?></label>
                                        <div class="col-md-1 col-xs-12 col-sm-12"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-1 col-xs-12 col-sm-12"></div>
                                        <div class="col-md-10 col-xs-12 col-sm-12">
                                            <ul class="list-group">
                                                <?php
                                                foreach ($response as $k => $item) :
                                                    if (!$isMultiChoice) { ?>
                                                        <li class="list-group-item">
                                                            <div class="input-group">
                                                                <input type="radio" value="<?php echo $k ?>" name="RESP<?php echo $key ?>[]" class="RESP<?php echo $key ?> ALL" id="RESP<?php echo $key . $k ?>" />
                                                                <span class="input-group-text" id="basic-addon1"><?php echo $item ?></span>
                                                            </div>
                                                        </li>
                                                    <?php } else { ?>
                                                        <li class="list-group-item">
                                                            <div class="input-group">
                                                                <input type="checkbox" value="<?php echo $k ?>" name="RESP<?php echo $key ?>[]" class="RESP<?php echo $key ?> ALL" id="RESP<?php echo $key . $k ?>" />
                                                                <span class="input-group-text" id="basic-addon1"><?php echo $item ?></span>
                                                            </div>
                                                        </li>
                                                <?php }
                                                endforeach;
                                                ?>
                                            </ul>
                                        </div>
                                        <div class="col-md-1 col-xs-12 col-sm-12"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-xs-12 col-sm-12">
                                            <div class="vuota"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-1 col-xs-12 col-sm-12"></div>
                                        <div class="col-md-4 col-xs-12 col-sm-12">
                                            <input type="button" id="NEXT_<?php echo $key ?>" onclick="nextStep('<?php echo $key ?>')" value="<?php echo strcmp($key, 5) !== 0 ? 'Next >' : 'Vedi Risultati' ?>" class="btn btn-success" />
                                        </div>
                                        <div class="col-md-7 col-xs-12 col-sm-12"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-xs-12 col-sm-12">
                                            <div class="vuota"></div>
                                        </div>
                                    </div>
                                </div>
                    <?php
                            endforeach;
                        }
                    }
                    ?>

                    <input type="hidden" name="CORRECT" id="CORRECT" value="<?php echo base64_encode(json_encode($dati['correct'], true)) ?>" />
                    <input type="hidden" name="JSON" id="JSON" value="<?php echo base64_encode(json_encode($dati['dati'], true)) ?>" />
                    <br />
                    <div class="row" id="result" style="display: none;">
                        <h6><u>Result</u></h6>
                        <br />
                        <p>Correct:&nbsp;<span id="result_coorret"></span></p>
                        <br />
                        <div class="list-group" id="list_rs"></div>
                        <br />
                        <div class="row">
                            <div class="col-md-1 col-xs-12 col-sm-12"></div>
                            <div class="col-md-4 col-xs-12 col-sm-12">
                                <input type="button" id="ricomincia" onclick="Restart()" value="Restart" class="btn btn-success" />
                            </div>
                            <div class="col-md-7 col-xs-12 col-sm-12"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-xs-12 col-sm-12">
                                <div class="vuota"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-1 col-xs-12 col-sm-12"></div>
            </div>
        </div>
</body>

</html>