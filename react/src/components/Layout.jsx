import React from 'react';
import Header from "./header/Header";
import {Outlet} from 'react-router-dom'
import { BrowserRouter } from "react-router-dom";
import AppRouter from "./AppRouter";

const Layout = () => {
    return (
        <BrowserRouter>
            <AppRouter />
        </BrowserRouter>

    );
};

export default Layout;