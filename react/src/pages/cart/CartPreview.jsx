import React from 'react';
import './cart.css'
import Counter from '../../components/counter/Counter';
import Price from '../../components/util/Price';
import XIcon from '../../components/icons/XIcon';
import { DOMAIN } from '../../utils/url';
import { useSelector, useDispatch } from 'react-redux';
import { updateCartProducts, updateCartTry, clearCart } from '../../store/cartSlice';
import Button from '../../components/buttons/Button';
import debounce from '../../lib/utils';

// превью корзины в правом верхнем углу
// клик на корзину - появляется баббл с этой страницей
// в ней список товаров, +\- есть подпись Оформить
// по сути отдельная страница корзины не так нужна

function onChangeCounter(e) {
    // console.log(e);
}

const CartPreview = ({onClose}) => {
    var totalPrice = 0;

    const cartProducts = useSelector(state => state.cart.cart); // dict
    // console.log('CartPreview')
    // console.log(cartProducts);
    const dispatch = useDispatch();
    function updateCart(v) {
        dispatch(updateCartProducts(v)); // visual

        debounce(() => {
            dispatch(updateCartTry({ quantity: v.count, id: v.product.id })); // request
        }, 1000, 'updateCartTry')
    }

    function onIncrement(item, incr) {
        var count = Math.max(0, Math.min(Number(item.count) + incr));
        updateCart({ count, product: item.product });
    }

    function onItemDelete(product) {
        updateCart({ product });
    }

    let itemsList = [];
    for (let id in cartProducts) {
        let cartProduct = cartProducts[id];
        let product = cartProduct?.product;
        if (!product) continue;

        const count = cartProduct.count;
        const {title, price, preview_image} = product;

        const _price = count * price;
        totalPrice += _price;

        // console.log(src)
        const _product = 
        <li key = {id} className = 'c-p-product'>
            <img className = 'c-p-product-preview-image' src = { `${DOMAIN}${preview_image}`}></img>
            <h1 className = 'c-p-product-title'>{title}</h1>
            <Counter
                disableDecr = {false}
                disableIncr = {false}
                value = {count}
                onChangeInput = { onChangeCounter }
                onIncrement = { (incr) => { onIncrement(cartProduct, incr); } }
                className = 'c-p-counter'
                btnClassName = 'c-p-counter-button'
                btnDisabledClassName = 'c-p-counter-button-disabled'
            />
            <Price className = 'c-p-product-price' price = {_price}/>
            <div className = 'c-p-delete'>
                <XIcon
                    title = 'Убрать'
                    onClick = { () => { onItemDelete(product); } }
                    width = '12'
                    height = '12'
                    fillColor = '#AA3939'
                />
            </div>
        </li>

        itemsList.push(_product)
    }

    async function onClearCart() {
        dispatch(clearCart());
    }

    async function onCreateOrder() {
        // console.log('onCreateOrder');
        const data = [];
        for (let item of Object.entries(cartProducts)) {
            // console.log(item);
            data.push({ id: item[0], quantity: item[1].count });
        }
        // console.log(data);
        // let response = await fetch(DOMAIN + 'index');
        // Получаем HTML-код страницы
        // const html = await response.text();

        // Создаем экземпляр DOMParser
        // const parser = new DOMParser();

        // Преобразуем строку HTML в объект Document
        // const doc = parser.parseFromString(html, "text/html");
        // const metaTag = doc.querySelector('meta[name="sosi-hui-token"]');
        // console.log(metaTag.content)

        let res = await fetch(DOMAIN + 'api/public/products/check-availability', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json;charset=utf-8',
            //   'X-CSRF-TOKEN': metaTag.content,
            },
            body: JSON.stringify(data)
          });
        const check = await res.json();
        // skip check
        
        // cart/update - каждый раз когда юзер добавил хуйню в корзину с дебаунсом + резервируем на 1ч +
        // показываем сообщение об этом (1ч с момента последнего обновления корзины)
        // если товара нет, мы скажем об этом юзеру и этот товар бронировать не будем
        // ok или не ок

        // в корзине: Оформить заказ если ок, попали на страницу Заказа, данные вбиваемые юзером храню локально,
        // тыкает оформить заказ - ...

        // -> Оформить заказ = api/public/cart/create => cart_ID
        // console.log(check);
    }

    return (
        <div className = 'c-p'>
            <XIcon className = 'c-p-close' onClick = {onClose} width = '16' height = '16' fillColor = '#333'/>
            <h1 className = 'c-p-title'>В корзине:</h1>
            {
                itemsList.length == 0 ? 
                <span className = 'c-p-empty'>Пока что пусто!</span>
                :
                <>
                    <ul className = 'c-p-products'>
                        {itemsList}
                    </ul>
                    <div className = 'c-p-total'>
                        <h1 className = 'c-p-total-title'>Сумма:</h1>
                        <Price className = 'c-p-total-price' price = {totalPrice} title = 'Всего'/>
                    </div>
                    <div className = 'c-p-buttons'>
                        <Button
                            disabled = {false}
                            className = 'c-p-checkout'
                            title = 'Заказать'
                            text = 'Заказать'
                            onClick = {onCreateOrder}
                        />
                        <Button
                            disabled = {false}
                            className = 'c-p-checkout'
                            title = 'Очистить'
                            text = 'Очистить'
                            onClick = {onClearCart}
                        />
                    </div>

                    {/* <a id = 'c-p-checkout' href = '/order'>Заказать</a> */}
                </>
            }
        </div>
    );
};

export default CartPreview;