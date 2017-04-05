function addItem() {
    var div = document.getElementsByClassName('default')[0];
    console.log(div);
    div.classList.toggle('moving');
}
    var elem = document.getElementById('add_item');
    elem.addEventListener('click',addItem);
