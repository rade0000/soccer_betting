$(document).ready(function () {

    var inputStake = $("#InputStake");
    var field = $('td:nth-last-child(-n+3)');
    $(field).click(function () {
        $('input[type="radio"]', this).prop("checked", true);
       
        calculate();
    });
    
    inputStake.keyup(calculate);

    /*** Check state of radio buttons ***/
    var radioButtons = $("input[type='radio']");
    var radioStates = {};
    $.each(radioButtons, function (index, rd) {
        radioStates[rd.value] = $(rd).is(':checked');
    });

    field.click(function () {

        var val = $('input[type="radio"]',this).val();
        $('input[type="radio"]',this).attr('checked', (radioStates[val] = !radioStates[val]));
        $(this).removeClass('checked-field');
        $.each(radioButtons, function (index, rd) {
            if (rd.value !== val) {
                radioStates[rd.value] = false;
                
                $(this).parent("td").removeClass('checked-field');
                calculate();
            }
        });
    });
    /*** End Check state of radio buttons ***/
    /*** Calculate bets ***/
    function calculate(e)
    {
        var checkedRadioButton = $("input[type='radio']:checked");
        var sum = 1.0;
        var onlyNumbers = 1.0;
        $.each(checkedRadioButton, function (i) {
            $(this).closest("td").addClass('checked-field');
            var valueRadioButton = $(checkedRadioButton[i]).val() || 1;
            //onlyNumbers *= parseFloat(valueRadioButton.substr(valueRadioButton.length - 5));
            onlyNumbers *= parseFloat(valueRadioButton.substr(valueRadioButton.indexOf(",") + 1));
            sum = onlyNumbers * (inputStake.val() || 1);
        });
        $("#InputWinnings").val(sum.toFixed(2));
    }
    
    /*** Clock***/
    function startTime() {
                    var today = new Date();
                    var year = today.getFullYear();
                    var month = today.getMonth();
                    var day = today.getDate();
                    var h = today.getHours();
                    var m = today.getMinutes();
                    var s = today.getSeconds();
                    month = checkTime(month);
                    day = checkTime(day);
                    m = checkTime(m);
                    s = checkTime(s);
                    $(".show-clock").text(year + "/" + month + "/" + day + " " + h + ":" + m + ":" + s);
                    setTimeout(startTime, 500);
                }
                startTime();
                function checkTime(i) {
                    if (i < 10) {
                        i = "0" + i;
                    }
                    ;
                    return i;
                }
});
