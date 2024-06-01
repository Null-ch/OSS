import React from 'react';
import './notFound.css'

const NotFound = () => {
    return (
        <div className = 'not-found-container'>
            <span className = 'not-found-info'>Не найдено</span>
            <span className = 'not-found-404'>404</span>
        </div>
    );
};

export default NotFound;