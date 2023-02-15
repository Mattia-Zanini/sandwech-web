class HItem {
    _options
    constructor(type, options, selector) {
        if (selector === undefined) {
            this._options = options
        }
        else {
            $('<' + type + '>', options).appendTo("#" + selector);
        }
        //console.log("created");
    }

    Append(selector, item) { }
    AppendArray(selector, arrItem) { }
}