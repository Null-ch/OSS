import React from 'react';
import './cartPreview.css'
import Counter from '../../components/counter/Counter';
import Price from '../../components/util/Price';
import XIcon from '../../components/icons/XIcon';

// превью корзины в правом верхнем углу
// клик на корзину - появляется баббл с этой страницей
// в ней список товаров, +\- есть подпись Оформить
// по сути отдельная страница корзины не так нужна

// img title -\+ totalprice remove

function onChangeCounter(e) {

}

function onIncrement(incr) {
    // var value = Math.max(0, Math.min(Number(count) + incr));
    // updateCount(value);
}

const testProducts = [
    {title: "111", count: 11, price: 11100},
    {title: "222", count: 2, price: 142100},
    {title: "333", count: 3, price: 122100},
    {title: "4444", count: 4, price: 144400},
]

const CartPreview = ({onClose}) => {

    var totalPrice = 0;

    function onItemDelete() {

    }

    return (
        <div className = 'c-p'>
            <h1 id = 'c-p-title'>В корзине:</h1>
            <ul id = 'c-p-products'>
                {
                    testProducts.map(({count, title, price}, i) => {
                        const _price = count * price;
                        totalPrice += _price;

                        return <li key = {i} id = 'c-p-product'>
                            {/* <img></img> */}
                            <h1 id = 'c-p-product-title'>{title}</h1>
                            <Counter
                                disableDecr = {false}
                                disableIncr = {false}
                                value = {count}
                                onChangeInput = {onChangeCounter}
                                onIncrement = {onIncrement}
                                className = 'c-p-counter'
                                btnClassName = 'c-p-counter-button'
                                btnDisabledClassName = 'c-p-counter-button-disabled'
                            />
                            <Price id = 'c-p-product-price' price = {_price}/>
                            <div id = 'c-p-delete'>
                                <XIcon
                                    onClick = {onItemDelete}
                                    width = '12'
                                    height = '12'
                                    fillColor = '#AA3939'
                                />
                            </div>
                        </li>
                    })
                }
            </ul>
            <div id = 'c-p-total'>
                <h1 id = 'c-p-total-title'>Сумма:</h1>
                <Price id = 'c-p-total-price' price = {totalPrice} title = 'Всего'/>
            </div>
            <a id = 'c-p-checkout' href = '#'>Заказать</a>
            <XIcon id = 'c-p-close' onClick = {onClose} width = '16' height = '16' fillColor = '#333'/>
        </div>
    );
};

export default CartPreview;