import Button from './Button';
import MoonIcon from '../icons/MoonIcon';
import SunIcon from '../icons/SunIcon';
import React, {useEffect, useState} from "react";

const ThemeButton = () => {
    const theme = localStorage.getItem('oss-theme') || 'light' // todo default

    console.log(theme)

    const icon = theme === 'light' ?
    <MoonIcon width = '36' height = '36' fillColor = '#8E8E8E'/> :
    <SunIcon width = '36' height = '36' fillColor = '#8E8E8E'/>

    return (
        <Button onClick = {() => {
            console.log(theme)
            localStorage.setItem('oss-theme', theme === 'light' ? 'dark' : 'light')
        }} className = 'button-hover'
        icon = {icon}/>
    );
};

export default ThemeButton;