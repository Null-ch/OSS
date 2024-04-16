import React from 'react';
import Logo from '../icons/LogoIcon';
import FooterSection from './FooterSection';
import './footer.css'
import { shopName } from '../../utils/constants';

const Footer = () => {
    return (
        <div className = 'footer'>
            <div className = 'footer-sections'>
                <FooterSection title = 'Customers'/>
                <FooterSection title = 'About'/>
                <FooterSection title = 'Contacts'/>
            </div>

            <Logo width = '200' height = '200' fillColor = '#ffffff'/>
            <span className='brand-footer'>
                SAMPLE TEXT
            </span>
        </div>
    );
};

export default Footer;