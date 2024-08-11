import React, { useEffect } from 'react';
import './categories.css';
import { useSelector, useDispatch } from 'react-redux';
import Category from './Category';

const Categories = () => {
    const {data: categories} = useSelector((state) => state.category)

    // console.log(categories)
    return (
        <div className = 'categories'>
            <div className = 'categories-title-container'>
                <span className = 'categories-title'>Категории</span>
            </div>
            <div className = 'categories-list'>
                {
                    categories.map(category => (
                        <Category key = {category.id} category = {category}>
                            
                        </Category>  
                    ))
                }
            </div>
        </div>

    );
};

export default Categories;