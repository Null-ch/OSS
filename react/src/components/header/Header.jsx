import React from 'react';
import { BrowserRouter } from "react-router-dom";
import AppRouter from "./../../components/AppRouter";
import "./header.less"

const Header = () => {
    return (
        <div className='header-bkg'>
            <BrowserRouter>
                <AppRouter />
            </BrowserRouter>
        </div>
    );
};

export default Header;