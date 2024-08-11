import { React, useState } from 'react';
import { useSelector } from 'react-redux';
import './order.css';
import OrderItems from './OrderItems'
import Input from '../../components/input/Input';
import { getAddress } from '../../lib/dadata';
import debounce from '../../lib/utils';
import Button from '../../components/buttons/Button';

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
    const items = useSelector(state => state.cart.cart);

    const [name, setName] = useState(localGet('oss-user-name') || '');
    const [lastname, setLastname] = useState(localGet('oss-user-lastname') || '');
    const [middlename, setMiddlename] = useState(localGet('oss-user-middlename') || '');
    const [email, setEmail] = useState(localGet('oss-user-email') || '');
    const [phone, setPhone] = useState(localGet('oss-user-phone') || '');

    function onAddressChange(e) {
        debounce(() => {
            const res = getAddress(e.target.value);
        }, 750, 'address');
    }

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

    function onCreateOrder() {
        console.log({
            name, lastname, middlename, phone, email
        });

        if (!isEmpty(name) && !isEmpty(lastname) && !isEmpty(middlename) && !isEmpty(phone) && !isEmpty(email)) {
            console.log('OK? ok.')
        }
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
                            value = {phone}
                            placeholder = '+7'
                            type = 'phone'
                            onChange = {onPhoneChange}
                            index = {2}
                        />
                    </div>

                    <span className = 'o-p-shipment-title'>Доставка</span>
                    <div className = 'o-p-shipment'>
                        <Input 
                            placeholder = 'Страна'
                            type = 'text'
                            index = {1}
                            inputList = {['Россия']}
                        />
                        <Input
                            // placeholder = '+7'
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