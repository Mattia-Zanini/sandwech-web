$.fn.pressEnter = function (fn) {
    return this.each(function () {
        $(this).bind('enterPress', fn);
        $(this).keyup(function (e) {
            if (e.keyCode == 13) {
                $(this).trigger("enterPress");
            }
        })
    });
};

//How to use the function
//$('textarea').pressEnter(function () { alert('here') });