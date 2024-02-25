import './items.css';
import Heart from '../../../components/icons/HeartIcon';
import Bag from '../../../components/icons/BagPlusIcon';
import React from 'react';
import Button from '../../../components/buttons/Button';
import { setIsModalVisible, setModalData } from '../../../store/modalSlice';
import { useDispatch, useSelector } from 'react-redux';


const Item = ({item, onQuickBuyClick}) => {
    // console.log(item)

    return (
        <div className = 'item'>
            <img className = 'item-image' src = {item.images[1]}/>
            <div className = 'item-info-container'>
                <span className = 'item-title'>{item.title}</span>
                <div className = 'item-price-container'>
                    <span className = 'item-price'>{item.price}</span>
                    <span className = 'item-price-currency'>₽</span>
                </div>
            </div>
            <div className = 'item-icons'>
                <Heart title = 'В избранное' className = 'item-heart' width = '32' height = '32' fillColor = '#333333'/>
                <Bag title = 'В корзину' className = 'item-bag' width = '36' height = '36' fillColor = '#333333'/>
            </div>
            <div className = 'item-preview-buttons'>
                <Button
                className = 'item-quick-buy-button'
                text = 'Смотреть'
                onClick = {()=>{
                    onQuickBuyClick(item);
                }}
                />
            </div>
        </div>
    );
};

export default Item;