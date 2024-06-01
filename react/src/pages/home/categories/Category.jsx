import React from 'react';
import './categories.css';
import {DOMAIN} from '../../../utils/url'

const Category = ({category}) => {
    return (
        <div className = 'category'>
            {/* <div className = 'category-container'> */}
                <span className = 'category-title'>{category.title}</span>
            {/* </div> */}
            <img className = 'category-preview' src = {`${DOMAIN}${category.preview_image}`}/>
        </div>
    );
};

export default Category;