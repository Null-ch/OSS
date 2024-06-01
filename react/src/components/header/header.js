import { useEffect } from 'react';
import './categories.css';
import { useSelector, useDispatch } from 'react-redux';
import {fetchCategories} from '../../../store/categorySlice';

function getCategories() {
    // const dispatch = useDispatch()
    // const {data: categories} = useSelector((state) => state.category)
    // useEffect(() => {
    //         dispatch(fetchCategories());
    //     }, []);

    // return categories;
};

const getters = {
    'categories': getCategories
}