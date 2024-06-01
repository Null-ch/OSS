import React from 'react';
import { useSelector } from 'react-redux';
import './order.css';
import OrderItems from './OrderItems'
import Input from '../../components/input/Input';

const CreateOrder = () => {
    // console.log('CreateOrder');
    const items = useSelector(state => state.cart.cart);
    
    // console.log(items);
    return (
        <div className = 'order-page'>
            <div className = 'o-p-container'>
                <div className = 'o-p-items'>
                    <OrderItems items = {items}/>
                </div>

                <div className = 'o-p-data'>
                <span className = 'o-p-contacts-title'>Контактные данные</span>
                    <div className = 'o-p-contacts'>
                        <Input 
                            placeholder = 'example@email.ru'
                            type = 'email'
                            index = {1}
                        />
                        <Input
                            placeholder = '+7'
                            type = 'phone'
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
                        />
                    </div>
                </div>
            </div>
        </div>
    );
};

export default CreateOrder;