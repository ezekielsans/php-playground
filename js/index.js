const add_cart = document.querySelectorAll('.addToCart');
const form_cart = document.querySelector('#checkout_form');



if (add_cart) {
    add_cart.forEach(element => {
        element.addEventListener('click', () => {

            let added_item = element.parentNode.cloneNode(true);


            element.parentNode.classList.add('disabledButton');
            form_cart.prepend(added_item);
            added_item.children[4].removeAttribute('disabled');
            activeRemove();
        });
    });
}
function activeRemove() {
    
    const remove_to_cart = document.querySelectorAll('.removeToCart');
    
    if (remove_to_cart) {
        remove_to_cart.forEach(element => {
            element.addEventListener('click', () => {

                let id = element.getAttribute('id');
                document.querySelector('#parent_'+id).classList.remove('disabledButton')
                element.parentNode.remove();
            })
        })
    }
}
