$(function() { 
    var items = [{
        text: "ListItem 1",
        value: "item1"
    }, {
        text: "ListItem 2",
        value: "item2"
    }, {
        text: "ListItem 3",
        value: "item3"
    }, {
        text: "ListItem 4",
        value: "item4"
    }, {
        text: "ListItem 5",
        value: "item5"
    }];
    $('#dropdown1').ejDropDownList({
        width: 300,
        dataSource: items,
        fields: {
            text: "text",
            value: "value"
        },
        showCheckbox: true,
        multiSelectMode: ej.MultiSelectMode.VisualMode
    });
});