import React from 'react';
import './cart.css'
import Counter from '../../components/counter/Counter';
import Price from '../../components/util/Price';
import XIcon from '../../components/icons/XIcon';
import { DOMAIN } from '../../utils/url';
import { useSelector, useDispatch } from 'react-redux';
import { updateCartProducts } from '../../store/cartSlice';
import Button from '../../components/buttons/Button';

// превью корзины в правом верхнем углу
// клик на корзину - появляется баббл с этой страницей
// в ней список товаров, +\- есть подпись Оформить
// по сути отдельная страница корзины не так нужна

function onChangeCounter(e) {
    // console.log(e);
}

const CartPreview = ({onClose}) => {
    var totalPrice = 0;

    const items = useSelector(state => state.cart.cart); // dict

    const dispatch = useDispatch();
    const updateCart = (v) => dispatch(updateCartProducts(v));

    function onIncrement(item, incr) {
        var count = Math.max(0, Math.min(Number(item.count) + incr));
        updateCart({ count, product: item.product });
    }

    function onItemDelete(product) {
        updateCart({ product });
    }

    let itemsList = [];
    for (let id in items) {
        let item = items[id];
        let product = item?.product;
        if (!product) continue;

        const count = item.count;
        const {title, price, preview_image} = product;

        const _price = count * price;
        totalPrice += _price;

        // console.log(src)
        const _product = 
        <li key = {id} id = 'c-p-product'>
            <img id = 'c-p-product-preview-image' src = { `${DOMAIN}${preview_image}`}></img>
            <h1 id = 'c-p-product-title'>{title}</h1>
            <Counter
                disableDecr = {false}
                disableIncr = {false}
                value = {count}
                onChangeInput = { onChangeCounter }
                onIncrement = { (incr) => { onIncrement(item, incr); } }
                className = 'c-p-counter'
                btnClassName = 'c-p-counter-button'
                btnDisabledClassName = 'c-p-counter-button-disabled'
            />
            <Price id = 'c-p-product-price' price = {_price}/>
            <div id = 'c-p-delete'>
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

    async function onCreateOrder() {
        console.log('onCreateOrder');
        const data = [];
        for (let item of Object.entries(items)) {
            console.log(item);
            data.push({ id: item[0], quantity: item[1].count });
        }
        let response = await fetch(DOMAIN + 'api/cart/check-availability', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json;charset=utf-8'
            },
            body: JSON.stringify(data)
          });
        console.log(response);
    }

    return (
        <div className = 'c-p'>
            <XIcon id = 'c-p-close' onClick = {onClose} width = '16' height = '16' fillColor = '#333'/>
            <h1 id = 'c-p-title'>В корзине:</h1>
            {
                itemsList.length == 0 ? 
                <span className = 'c-p-empty'>Пока что пусто!</span>
                :
                <>
                    <ul id = 'c-p-products'>
                        {itemsList}
                    </ul>
                    <div id = 'c-p-total'>
                        <h1 id = 'c-p-total-title'>Сумма:</h1>
                        <Price id = 'c-p-total-price' price = {totalPrice} title = 'Всего'/>
                    </div>
                    <Button
                        disabled = {false}
                        className = 'c-p-checkout'
                        title = 'Заказать'
                        text = 'Заказать'
                        onClick = {onCreateOrder}
                    />
                    {/* <a id = 'c-p-checkout' href = '/order'>Заказать</a> */}
                </>
            }
        </div>
    );
};

export default CartPreview;