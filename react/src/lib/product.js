
export function getProduct(products, id) {
    if (!products || products == [] || !id) return;
    for (let product of products) {
        if (product.id == id) return product;
    }
}

export function getCartProductsDict(products) {
    let cart = {};
    for (let product of products) {
        cart[product.id] = {
            
        }
    }
}