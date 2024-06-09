import React from 'react';
import './categories.css';
import {DOMAIN} from '../../../utils/url'
import Button from '../../../components/buttons/Button';
import { Link } from 'react-router-dom';

const Category = ({ category, index }) => {
    const testDescription = 'Покупайте наше охуенное мыло'
    const descr = category.description || testDescription
    const to = '/products/category/' + category.id

    const className = (index & 1) ? 'category-reversed' : 'category'

    return (
        <div className = {className}>
            <div className = 'c-title-container'>
                <Link to = {to} className = 'c-title'>{category.title}</Link>
                <span className = 'c-description'>{descr}</span>
                <Button
                    route = {to}
                    className = 'c-button'
                    title = 'К продуктам'
                    text = 'Продукты'
                />
            </div>
            <Link to = {to} className = 'c-preview-container'>
                <img className = 'c-preview' src = {`${DOMAIN}${category.preview_image}`}/>
            </Link>
        </div>
    );
};

export default Category;