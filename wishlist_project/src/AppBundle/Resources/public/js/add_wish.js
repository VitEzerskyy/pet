function addItem() {
    var form = document.body.getElementsByTagName('form')[0];
    if (form.hasAttribute('hidden')) {
        form.removeAttribute('hidden');
    }else {
        form.setAttribute('hidden','');
    }
}
    var elem = document.getElementById('add_item');
    elem.addEventListener('click',addItem);
