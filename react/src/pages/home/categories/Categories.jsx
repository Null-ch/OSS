import React, { useEffect } from 'react';
import './categories.css';
import { useSelector, useDispatch } from 'react-redux';
import {fetchCategories} from '../../../store/categorySlice';
import Category from './Category';

const Categories = () => {
    const dispatch = useDispatch()
    const {data: categories} = useSelector((state) => state.category)

    useEffect(() => {
        dispatch(fetchCategories());
      }, []);

    return (
        <div className = 'categories'>
            <div className = 'categories-title-container'>
                <span className = 'categories-title'>Категории</span>
            </div>
            <div className = 'categories-list'>
                {
                    categories.map(category => (
                        <Category key = {category.id} category = {category}>
                            {console.log(category)}
                        </Category>  
                    ))
                }
            </div>
        </div>

    );
};

export default Categories;