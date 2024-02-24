import React from 'react';
import Item from './Item';
import './items.css';

const ItemsList = ({items}) => {
    return (
        <div className = 'items'>
            {items.map((item) => {
                return <Item item = {item}/>
            })}
        </div>
    );
};

export default ItemsList;