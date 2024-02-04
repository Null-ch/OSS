import React from 'react';
import logo from './../../icons/logo-white.svg'
import Logo from '../Logo';
import FooterSection from './FooterSection';
import './footer.css'
import { shopName } from '../../util/constants';

const Footer = () => {
    return (
        <div className = 'footer'>
            <div className = 'footer-sections'>
                <FooterSection title = 'Customers'/>
                <FooterSection title = 'About'/>
                <FooterSection title = 'Contacts'/>
            </div>

            <Logo className = 'footer-logo' src = {logo} title = {shopName}/>

        </div>
    );
};

export default Footer;