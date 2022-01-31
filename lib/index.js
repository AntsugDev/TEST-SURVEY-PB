var risposta = new Array();
function nextStep(step) {
    let classEach = document.querySelectorAll('.RESP' + step);
    let next = parseInt(step) + parseInt(1);
    let divClick = document.getElementById('DOMNADANR' + step);
    let divOpen = document.getElementById('DOMNADANR' + next);
    let alertError = document.getElementById('alert_KO');
    let divResult = document.getElementById('result');


    let risp = '';
    for (var i = 0; i < classEach.length; i++) {
        if (classEach[i].checked) {

            if (risp !== '') risp += ',';
            risp += classEach[i].value
        }
    }

    risposta.push({ step: step, value: risp });
    let isError = false;
    if (risp !== '') {
        if (step !== "4") {
            divClick.style.display = 'none';
            divOpen.style.display = 'inline';
            alertError.style.display = 'none';
        } else {
            let correct = document.getElementById('CORRECT');
            let arrayCorrect = JSON.parse(window.atob(correct.value));
            console.log('arrayCorrect', arrayCorrect);
            console.log('risposta', risposta);

            if (risposta.length > 0) {
                let corrette = 0;

                let idDati = document.getElementById('JSON');
                let dati = JSON.parse(window.atob(idDati.value));
                let html = '<ul style="list-style-type: none">';
                for (let r = 0; r < risposta.length; r++) {
                    let step_risp = risposta[r].step;
                    let val_risp = risposta[r].value;

                    let step_correct = arrayCorrect[r].step;
                    let value_correct = arrayCorrect[r].value;
                    let isMultiChoice = value_correct.toString().search(',') !== -1 ? true : false;


                    if (step_risp == step_correct) {
                        var isOK = false;
                        var nrDom = parseInt(r)+parseInt(1);
                        let question = '<ul style="list-style-type: none" class="list-group"><li class="list-group-item"><strong>' +  '(' +  nrDom + ')'+ dati[step_risp].request +'</strong>';
                        let rs = '';
                        if (isMultiChoice) {
                            $arrTmp = val_risp.toString().split(',');
                            for (let $r = 0; $r < $arrTmp.length; $r++) {
                                isOK    = value_correct.toString().search($arrTmp[$r]) !== -1 ? true : false;
                                rs += '<br />'+dati[step_risp].response[$arrTmp[$r]];
                                rs += '<span  style=" font-weight: 800;font-size:16px;color:' + (isOK ? 'green' : 'red') + '">&check;</span>'
                            }
                        } else {
                            isOK = value_correct.toString() === val_risp.toString() ? true : false
                            rs = '<br />'  + dati[step_risp].response[val_risp];
                            rs += '<span  style=" font-weight: 800;font-size:16px;color:' + (isOK ? 'green' : 'red') + '">&check;</span>'
                        }
                        rs +='</li>'

                        if (isOK) {
                            corrette++;
                        }
                        html += question;
                        html += rs + '</ul>';


                    }
                }

                html += '</ul>';

                console.log('html', html);

                const res = document.getElementById('result_coorret');

                res.innerText = corrette + '/5';

                if(corrette < 5){
                    res.className = 'errate';
                }else{
                    res.className = 'corrette';

                }

                const app = document.getElementById('list_rs');
                app.innerHTML = html;
                divClick.style.display = 'none';
                alertError.style.display = 'none';
                divResult.style.display = 'inline'
            }
        }
    }
    else {
        alertError.style.display = 'block';
        isError = true;
    }
    if (isError) {
        setTimeout(() => {
            alertError.style.display = 'none';
            isError = false;
        }, 3000)
    }
}

function Restart(){
    debugger
    let divClick   = document.getElementById('DOMNADANR0');
    let alertError = document.getElementById('alert_KO');
    let divResult  = document.getElementById('result');
    alertError.style.display = 'none';
    divResult.style.display  = 'none';
    divClick.style.display   = 'inline';
    risposta = new Array();
    const all = document.querySelectorAll('.ALL');
    for (var i = 0; i < all.length; i++) {
        if (all[i].checked) {
            all[i].checked = false
        }
    }
}