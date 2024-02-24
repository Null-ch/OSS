import React from 'react';
import './categories.css';

const Category = ({key, category}) => {
    console.log(key)
    return (
        <div className = 'category'>
            <img className = 'category-preview' src = {category.image}/>
            <div className = 'category-container'>
                <span className = 'category-title'>{category.name}</span>
            </div>
        </div>
    );
};

export default Category;