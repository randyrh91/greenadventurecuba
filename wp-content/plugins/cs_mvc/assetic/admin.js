/**
 * Created by pr0x on 10/05/2015.
 */
jQuery(function($) {
    console.log("OK va bien, ahora si");

});
function __obj(text) {
    var state = 0;
    var i = 0;
    var lang = "en";
    var word = "";
    var obj = {en:""};
    while(i<text.length) {
        var c = text[i];
        switch (state) {
            case 0: //en el caso de q empieze buscando un [
                if(c=='[') state = 1;
                break;
            case 1: //si encuentra un [ entonces el otro debe ser un : sino sigue buscando
                if(c==':') {lang = ""; state = 2;} else { word += '['; state = 3; }
                break;
            case 2: //en el caso q ecuentre un idioma busca hasta ]
                if(c==']') state = 3; else {lang += c};
                break;
            case 3: //aki lo va reuniendo los caracteres de la frace en el idioma
                if(c=='[') {//si aparece un nuevo idioma
                    if(text[i+1] == ":" && word) {
                        obj[lang] = word;
                        word = "";
                    }
                    state = 1;
                }
                else word+=c; break;
        }
        i++;
    }
    if(word) obj[lang] = word; else obj.en = text;
    return obj;
}
function setValuesByLangForForm(select_el, form_id) {
    var $ = jQuery;
    var $sel = $(select_el);
    var $form = $('#' + form_id);
    var arr = $sel.attr('name').split('_');
    var name_var = "", lang = arr[arr.length-1];
    for(var i = 0 ; i < arr.length - 1; i++) {
        name_var += arr[i];
        if(i!=arr.length - 2) name_var+='_';
    }
    var $el =jQuery('input[name='+name_var+']', $form);
    $el.val('');
    $('[name^=' + $el.attr('name') + '_]', $form).each(function (i, item) {
        $item = $(item);
        var arr = $item.attr('name').split('_');
        lang = arr[arr.length-1];
        $el.val($el.val() + '[:' + lang + ']' + $item.val());
    });
    console.log($el.val())
}
function setValuesByLang(select_el) {
    var $ = jQuery;
    var $sel = $(select_el);
    var arr = $sel.attr('name').split('_');
    var $el = $('[name='+ arr[0] +']');
    $el.val('');
    $('[name^='+ $el.attr('name') +'_]').each(function (i, item) {
        $item = $(item);
        var arr = $item.attr('name').split('_');
        $el.val($el.val()+'[:'+arr[1]+']'+$item.val());
    })
}
