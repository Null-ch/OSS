import React from 'react';
import Button from './Button';
import './button.css'
import ProfileIcon from '../icons/ProfileIcon';

const ProfileLoginButton = () => {
    return (
        <Button route = '/login' className = 'login-button-logged' icon = {<ProfileIcon width = '36' height = '36' fillColor = '#8e8e8e'/>}/>
    );
};

export default ProfileLoginButton;