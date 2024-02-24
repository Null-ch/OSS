import './items.css';

import React from 'react';

const Item = ({item}) => {
    console.log(item)

    return (
        <div className = 'item'>
            <img className = 'item-image' src = {item.images[1]}/>
            <div className = 'item-title-container'>
                <span className = 'item-title'>{item.title}</span>
                <span className = 'item-price'>{item.price} ₽</span>
            </div>
        </div>
    );
};

export default Item;