import React from 'react';
import './categories.css';
<<<<<<< HEAD
import {DOMAIN} from '../../../utils/url'
=======
>>>>>>> 0e8f35afd20cf5efe9539ae6d58590be45c12c40

const Category = ({category}) => {
    return (
        <div className = 'category'>
<<<<<<< HEAD
            <div className = 'category-container'>
                <span className = 'category-title'>{category.title}</span>
            </div>
            <img className = 'category-preview' src = {`${DOMAIN}${category.preview_image}`}/>
=======
            <img className = 'category-preview' src = {category.image}/>
            <div className = 'category-container'>
                <span className = 'category-title'>{category.name}</span>
            </div>
>>>>>>> 0e8f35afd20cf5efe9539ae6d58590be45c12c40
        </div>
    );
};

export default Category;