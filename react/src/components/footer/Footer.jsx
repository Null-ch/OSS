import React from 'react';
import Logo from '../icons/LogoIcon';
import FooterSection from './FooterSection';
import './footer.css'

const Footer = () => {
    return (
        <div className = 'footer'>
            <div className = 'footer-sections'>
                <FooterSection title = 'Customers'/>
                <FooterSection title = 'About'/>
                <FooterSection title = 'Contacts'/>
            </div>

            <Logo width = '200' height = '200' fillColor = '#333'/>
            <span className='brand-footer'>
                SAMPLE TEXT
            </span>
        </div>
    );
};

export default Footer;