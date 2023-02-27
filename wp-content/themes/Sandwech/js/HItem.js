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

    static Append(selector, item) {
        $('<' + item.type + '>', item.options).appendTo("#" + selector);
    }
    static AppendArray(selector, arrItem) {
        //console.log("Appending with this selector: " + selector);

        for (let index = 0; index < arrItem.length; index++) {
            $('<' + arrItem[index][0] + '>', arrItem[index][1]).appendTo("#" + selector);
        }
    }
}