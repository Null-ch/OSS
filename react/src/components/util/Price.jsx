import React from 'react';
import './price.css'

const Price = ({id, className, price, title}) => {
    return (
        <div id = {id} className = {className}>
            <span id = 'price' title = {title}>{price}</span>
            <span id = 'currency'>₽</span>
        </div>
    );
};

export default Price;