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
import { setIsModalVisible, setContent } from '../../store/modalSlice';
import Confirm from '../../components/confirm/Confirm';

function localGet(key) {
    return localStorage.getItem(key);
}

function localSet(key, value) {
    localStorage.setItem(key, value);
}

const delay = 300;

function isEmpty(str = '') {
    return str === '';
}

const CreateOrder = () => {
    const dispatch = useDispatch();

    const items = useSelector(state => state.cart.cart);
    const deliveryList = useSelector(state => state.delivery.list);
    const cart = useSelector(state => state.cart); // dict

    const defaultError = 'Заполните поле';

    const [lastname, setLastname] = useState(localGet('oss-user-lastname') || '');
    const [isLastnameError, setIsLastnameError] = useState(false);
    const [name, setName] = useState(localGet('oss-user-name') || '');
    const [isNameError, setIsNameError] = useState(false);
    const [middlename, setMiddlename] = useState(localGet('oss-user-middlename') || '');
    const [isMiddlenameError, setIsMiddlenameError] = useState(false);
    const [email, setEmail] = useState(localGet('oss-user-email') || '');
    const [isEmailError, setIsEmailError] = useState(false);
    const [phone, setPhone] = useState(localGet('oss-user-phone') || '');
    const [isPhoneError, setIsPhoneError] = useState(false);
    const [delivery, setDelivery] = useState(localGet('oss-order-delivery') || '');
    const [isDeliveryError, setIsDeliveryError] = useState(false);
    const [address, setAddress] = useState(localGet('oss-order-address') || '');
    const [isAddressError, setIsAddressError] = useState(false);
    
    // USER DATA
    function onLastnameChange(e) {
        const lastname = e.target.value || '';
        setLastname(lastname);
        setIsLastnameError(false);
        debounce(() => {
            localSet('oss-user-lastname', lastname);
        }, delay, 'lastname');
    }

    function onNameChange(e) {
        const name = e.target.value || '';
        setName(name);
        setIsNameError(false);
        debounce(() => {
            localSet('oss-user-name', name);
        }, delay, 'name');
    }

    function onMiddlenameChange(e) {
        const middlename = e.target.value || '';
        setMiddlename(middlename);
        setIsMiddlenameError(false);
        debounce(() => {
            localSet('oss-user-middlename', middlename);
        }, delay, 'middlename');
    }

    // CONTACTS
    function onEmailChange(e) {
        const email = e.target.value || '';
        setEmail(email);
        setIsEmailError(false);
        debounce(() => {
            localSet('oss-user-email', email);
        }, delay, 'email');
    }

    function onPhoneChange(e) {
        const phone = e.target.value || '';
        setPhone(phone);
        setIsPhoneError(false);
        debounce(() => {
            localSet('oss-user-phone', phone);
        }, delay, 'phone');
    }

    function onAddressChange(e) {
        const address = e.target.value || '';
        setAddress(address);
        setIsAddressError(false);
        debounce(() => {
            localSet('oss-order-address', address);
        }, delay, 'address');
    }

    function onDeliveryChange(e) {
        setDelivery(e.target.value || '');
        setIsDeliveryError(false);
    }

    function validate() {
        const delivery_id = deliveryDict[delivery];

        setIsLastnameError(isEmpty(lastname));
        setIsNameError(isEmpty(name));
        setIsMiddlenameError(isEmpty(middlename));
        setIsEmailError(isEmpty(email));
        setIsPhoneError(isEmpty(phone));
        setIsDeliveryError(!delivery_id);
        setIsAddressError(isEmpty(address));

        if (delivery_id && !isEmpty(name) && !isEmpty(lastname) && !isEmpty(middlename) && !isEmpty(phone) && !isEmpty(email) && !isEmpty(address)) {
            return {
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
            }
        }
    }

    function onCreateOrder() {
        const data = validate();
        if (!data) return;
        console.log('OK? ok.');
        dispatch(setIsModalVisible(true));
        dispatch(setContent(<Confirm
            header = 'Оформить заказ?'
            okText = 'Оформить'
            onOk = {() => {
                dispatch(createOrder(data));
                dispatch(setIsModalVisible(false));
            }}
            onClose = {() => {
                dispatch(setIsModalVisible(false));
            }}
        />));
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
                            error = { isLastnameError && defaultError }
                            placeholder = 'Фамилия'
                            onChange = {onLastnameChange}
                            index = {1}
                        />
                        <Input
                            value = {name}
                            error = { isNameError && defaultError }
                            placeholder = 'Имя'
                            onChange = {onNameChange}
                            index = {2}
                        />
                        <Input
                            value = {middlename}
                            error = { isMiddlenameError && defaultError }
                            placeholder = 'Отчество'
                            onChange = {onMiddlenameChange}
                            index = {3}
                        />
                    </div>

                    <span className = 'o-p-contacts-title'>Контактные данные</span>
                    <div className = 'o-p-contacts'>
                        <Input 
                            value = {email}
                            error = { isEmailError && defaultError }
                            placeholder = 'example@email.ru'
                            type = 'email'
                            onChange = {onEmailChange}
                            index = {4}
                        />
                        <Input
                            value = { phone }
                            error = { isPhoneError && defaultError }
                            placeholder = '+7'
                            type = 'phone'
                            onChange = {onPhoneChange}
                            index = {5}
                        />
                    </div>

                    <span className = 'o-p-shipment-title'>Доставка</span>
                    <div className = 'o-p-shipment'>
                        <Input 
                            placeholder = 'Способ доставки'
                            error = { isDeliveryError && defaultError }
                            index = {6}
                            onChange = { onDeliveryChange }
                            inputList = { deliveryInputList }
                        />
                        <Input
                            value = { address }
                            error = { isAddressError && defaultError }
                            placeholder = 'Адрес'
                            index = {7}
                            onChange = { onAddressChange }
                        />
                    </div>

                    <div className = 'o-p-checkout-container'>
                        <Button
                            // route = '/order'
                            disabled = {false}
                            className = 'button-default-hover'
                            title = 'Оформить'
                            text = 'Оформить'
                            onClick = {onCreateOrder}
                        />

                        <Button
                            // route = '/order'
                            disabled = {false}
                            className = 'button-default-hover'
                            title = 'Отмена'
                            text = 'Отмена'
                            // onClick = {onCreateOrder}
                        />
                    </div>
                </div>
            </div>
        </div>
    );
};

export default CreateOrder;