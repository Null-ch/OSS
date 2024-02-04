import React from 'react';
import logo from './../../icons/logo-white.svg'
import Logo from '../Logo';
import FooterSection from './FooterSection';
import './footer.css'

const Footer = () => {
    return (
        <div className = 'footer'>
            <div className = 'footer-sections'>
                <FooterSection title = 'Customers'/>
                <FooterSection title = 'About'/>
                <FooterSection title = 'Contacts'/>
                {/* todo nav */}
            </div>

            <Logo className = 'footer-logo' src = {logo} title = 'PrettyShopName'/>

        </div>
    );
};

export default Footer;