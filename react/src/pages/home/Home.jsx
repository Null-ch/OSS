import Categories from './categories/Categories';
import React, { useEffect } from 'react';
import { useSelector, useDispatch } from 'react-redux';
import {fetchCategories} from '../../store/categorySlice';
import Category from './categories/Category';

import './home.css'

// todo передавать офферы извне
// todo передавать категории извне

const Home = () => {
    const dispatch = useDispatch()
    const {data: categories} = useSelector((state) => state.category)
    useEffect(() => {
        dispatch(fetchCategories());
      }, []);

    return (
        <main className = 'main-page'>
            {/* <Offers items = {[
                { src:soapImg }
                ]}/> */}
            {/* <Categories/> */}
            <div className = 'h-categories'>
                {
                    categories.map((cat, i) => {
                        if (!cat.is_active) return;
                        return <Category key = {i} index = {i} category = {cat}/>
                    })
                }
            </div>
        </main>
    );
};

export default Home;