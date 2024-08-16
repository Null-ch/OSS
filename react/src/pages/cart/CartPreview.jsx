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
import { Confirm } from '../../components/confirm/Confirm';
import { setIsModalVisible, setContent } from '../../store/modalSlice';

// превью корзины в правом верхнем углу
// клик на корзину - появляется баббл с этой страницей
// в ней список товаров, +\- есть подпись Оформить
// по сути отдельная страница корзины не так нужна

const CartPreview = ({onClose}) => {
    const cartProducts = useSelector(state => state.cart.cart); // dict

    const dispatch = useDispatch();
    const updateCart = (v) => dispatch(updateCartProducts(v));

    function updateCount(product, count) {
        console.log(product);
        console.log(count);

        updateCart({ count, product }); // visual
        debounce(() => {
            dispatch(updateCartTry({ id: product.id, quantity: count })); // request
        }, 1000, 'updateCartTry')
    }

    function onIncrement(item, incr) {
        var count = Math.max(0, Math.min(Number(item.count) + incr));
        updateCart({ count, product: item.product });
    }

    function onItemDelete(product) {
        updateCart({ product });
    }

    let selected = 0;
    let totalPrice = 0;
    let itemsList = [];
    for (let id in cartProducts) {
        let cartProduct = cartProducts[id];
        let product = cartProduct?.product;
        if (!product) continue;

        const count = cartProduct.count;
        selected += count;

        const { title, price, preview_image } = product;

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
                onChangeInput = { (v) => { updateCount(cartProduct.product, v) } }
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

    const isButtonDisabled = selected === 0;

    async function onClearCart() {
        dispatch(setIsModalVisible(true));
        dispatch(setContent(<Confirm
            header = 'Очистить корзину?'
            okText = 'Очистить'
            onOk = {() => {
                dispatch(clearCart());
                dispatch(setIsModalVisible(false));
            }}
            onClose = {() => {
                dispatch(setIsModalVisible(false));
            }}
        />));
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
                            route = '/order'
                            disabled = {isButtonDisabled}
                            className = 'button-default-hover'
                            title = 'Заказать'
                            text = 'Заказать'
                        />
                        <Button
                            disabled = {isButtonDisabled}
                            className = 'button-default-hover'
                            title = 'Очистить'
                            text = 'Очистить'
                            onClick = {onClearCart}
                        />
                    </div>
                </>
            }
        </div>
    );
};

export default CartPreview;