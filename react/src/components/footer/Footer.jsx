import React from 'react';
import Logo from '../icons/LogoIcon';
import './footer.css'
import {Link} from 'react-router-dom'

const Footer = () => {
    return (
        <div className = 'footer'>
            <div className = 'f-section-left'>
                <Link to = '/' className = 'f-link'>Главная</Link>
                <Link to = '/products' className = 'f-link'>Все продукты</Link>
                <Link className = 'f-link'>Доставка</Link>
            </div>

            <div className = 'f-brand-container'>
                <Logo width = '200' height = '200' fillColor = '#333'/>
                <Link to = '/' className = 'f-brand-link'>SAMPLE TEXT</Link>
            </div>
            <div className = 'f-section-right'>
                <Link to = '/about' className = 'f-link'>О нас</Link>
                <Link className = 'f-link'>Контакты</Link>   
            </div>

        </div>
    );
};

export default Footer;