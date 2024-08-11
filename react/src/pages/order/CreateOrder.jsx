import { React, useState } from 'react';
import { useSelector, useDispatch } from 'react-redux';
import './order.css';
import OrderItems from './OrderItems'
import Input from '../../components/input/Input';
import { getAddress } from '../../lib/dadata';
import debounce from '../../lib/utils';
import Button from '../../components/buttons/Button';
import { createOrder } from '../../store/orderSlice';
// import { useGetDeliveriesQuery } from '../../store/query/deliveryApi';

function localGet(key) {
    return localStorage.getItem(key);
}

function localSet(key, value) {
    localStorage.setItem(key, value);
}

const delay = 300;

function isEmpty(str) {
    return str == '';
}

const CreateOrder = () => {
    const dispatch = useDispatch();

    const items = useSelector(state => state.cart.cart);
    const deliveryList = useSelector(state => state.delivery.list);
    const cart = useSelector(state => state.cart); // dict

    const [name, setName] = useState(localGet('oss-user-name') || '');
    const [lastname, setLastname] = useState(localGet('oss-user-lastname') || '');
    const [middlename, setMiddlename] = useState(localGet('oss-user-middlename') || '');
    const [email, setEmail] = useState(localGet('oss-user-email') || '');
    const [phone, setPhone] = useState(localGet('oss-user-phone') || '');
    const [delivery, setDelivery] = useState(localGet('oss-order-delivery') || '');
    const [address, setAddress] = useState(localGet('oss-order-address') || '');

    // USER DATA
    function onLastnameChange(e) {
        debounce(() => {
            const lastname = e.target.value || '';
            setLastname(lastname);
            localSet('oss-user-lastname', lastname);
        }, delay, 'lastname');
    }

    function onNameChange(e) {
        const name = e.target.value || '';
        setName(name);
        debounce(() => {
            localSet('oss-user-name', name);
        }, delay, 'name');
    }

    function onMiddlenameChange(e) {
        const middlename = e.target.value || '';
        setMiddlename(middlename);
        debounce(() => {
            localSet('oss-user-middlename', middlename);
        }, delay, 'middlename');
    }

    // CONTACTS
    function onEmailChange(e) {
        const email = e.target.value || '';
        setEmail(email);
        debounce(() => {
            localSet('oss-user-email', email);
        }, delay, 'email');
    }

    function onPhoneChange(e) {
        const phone = e.target.value || '';
        setPhone(phone);
        debounce(() => {
            localSet('oss-user-phone', phone);
        }, delay, 'phone');
    }

    function onAddressChange(e) {
        const address = e.target.value || '';
        setAddress(address);
        debounce(() => {
            localSet('oss-order-address', address);
        }, delay, 'address');
    }

    function onDeliveryChange(e) {
        setDelivery(e.target.value || '');
    }

    function onCreateOrder() {
        const delivery_id = deliveryDict[delivery];
        if (delivery_id && !isEmpty(name) && !isEmpty(lastname) && !isEmpty(middlename) && !isEmpty(phone) && !isEmpty(email) && !isEmpty(address)) {
            console.log('OK? ok.');
            console.log(cart)
            dispatch(createOrder({
                cart_id: cart.id,
                delivery_service_id: delivery_id,
                shipping: {
                    id: null,
                    address: address,
                },
                personal_data: {
                    name,
                    last_name: lastname,
                    middle_name: middlename,
                    email,
                    phone,
                }
            }))
        }


    }

    const deliveryInputList = [];
    const deliveryDict = {};
    for (let delivery of deliveryList) {
        if (!delivery.is_active) continue;
        deliveryInputList.push(delivery.title);
        deliveryDict[delivery.title] = delivery.id;
    }

    // console.log(items);
    return (
        <div className = 'order-page'>
            <span className = 'o-p-title'>Оформление заказа</span>
            <div className = 'o-p-container'>
                <div className = 'o-p-items'>
                    <OrderItems items = {items}/>
                </div>

                <div className = 'o-p-data'>
                    <span className = 'o-p-user-data-title'>Личные данные</span>
                    <div className = 'o-p-user-data'>
                        <Input
                            value = {lastname}
                            placeholder = 'Фамилия'
                            type = 'text'
                            onChange = {onLastnameChange}
                            index = {1}
                        />
                        <Input
                            value = {name}
                            placeholder = 'Имя'
                            type = 'text'
                            onChange = {onNameChange}
                            index = {2}
                        />
                        <Input
                            value = {middlename}
                            placeholder = 'Отчество'
                            type = 'text'
                            onChange = {onMiddlenameChange}
                            index = {3}
                        />
                    </div>

                    <span className = 'o-p-contacts-title'>Контактные данные</span>
                    <div className = 'o-p-contacts'>
                        <Input 
                            value = {email}
                            placeholder = 'example@email.ru'
                            type = 'email'
                            onChange = {onEmailChange}
                            index = {1}
                        />
                        <Input
                            value = { phone }
                            placeholder = '+7'
                            type = 'phone'
                            onChange = {onPhoneChange}
                            index = {2}
                        />
                    </div>

                    <span className = 'o-p-shipment-title'>Доставка</span>
                    <div className = 'o-p-shipment'>
                        <Input 
                            placeholder = 'Способ доставки'
                            type = 'text'
                            index = {1}
                            onChange = { onDeliveryChange }
                            inputList = { deliveryInputList }
                        />
                        <Input
                            value = { address }
                            placeholder = 'Адрес'
                            type = 'text'
                            index = {2}
                            onChange = { onAddressChange }
                        />
                    </div>

                    <div className = 'o-p-checkout-container'>
                        <Button
                            // route = '/order'
                            disabled = {false}
                            className = 'o-p-checkout'
                            title = 'Оформить'
                            text = 'Оформить'
                            onClick = {onCreateOrder}
                        />
                    </div>
                </div>
            </div>
        </div>
    );
};

export default CreateOrder;