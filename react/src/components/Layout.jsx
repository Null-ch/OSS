import React from 'react';
import Header from "./header/Header";
import {Outlet} from 'react-router-dom'
import { BrowserRouter } from "react-router-dom";
import Router from "./Router";

const Layout = () => {
    return (
        <BrowserRouter>
            <Router />
        </BrowserRouter>

    );
};

export default Layout;