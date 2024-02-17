import Button from './Button';
import MoonIcon from '../icons/MoonIcon';
import SunIcon from '../icons/SunIcon';
import React, {useEffect, useState} from "react";

const ThemeButton = () => {
    const theme = localStorage.getItem('oss-theme') || 'light' // todo default

    const [isLightThemeOn, setIsLightThemeOn] = useState(theme === 'light');

    const icon = isLightThemeOn ?
    <SunIcon width = '36' height = '36' fillColor = '#8E8E8E'/> :
    <MoonIcon width = '36' height = '36' fillColor = '#8E8E8E'/>

    return (
        <Button onClick = {() => {
            localStorage.setItem('oss-theme', theme === 'light' ? 'dark' : 'light')
            setIsLightThemeOn(!isLightThemeOn)
        }} className = 'button-hover'
        icon = {icon}/>
    );
};

export default ThemeButton;