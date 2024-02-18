import React from 'react';
import './categories.css';

const Category = ({key, category}) => {
    console.log(key)
    return (
        <div className = 'category'>
            <img className = 'category-preview' src = {category.image}>
            </img>
            <span className = 'category-name'>{category.name}</span>
        </div>
    );
};

export default Category;