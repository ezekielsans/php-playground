const add_cart = document.querySelectorAll('.addToCart');
const form_cart = document.querySelector('#checkout_form');
const checkout_price = document.querySelector('#checkout_price');




if (add_cart) {
    add_cart.forEach(element => {
        element.addEventListener('click', () => {

            let added_item = element.parentNode.cloneNode(true);
            element.parentNode.classList.add('disabledButton');
            form_cart.prepend(added_item);
            console.log(added_item.children);
            added_item.children[5].removeAttribute('disabled');
            activeRemove();


            console.log(added_item.children);
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
