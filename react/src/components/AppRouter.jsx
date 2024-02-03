import React from 'react';
import { Routes, Route, Redirect, Outlet } from 'react-router-dom'
import { publicRoutes } from '../routes';
import { Nav } from './header/Nav';
import "./header/header.css"
import Header from './header/Header';

const AppRouter = () => {
    return (
        <>
            <Header/>
            <Routes>
                <Route path = "/" element = {<Nav/>}>
                    {/* всё ниже пойдёт в <Outlet> Tab'a*/}
                    {/* {publicRoutes.map(({path, component}) =>
                    {
                        if (path === "/") {
                            return <Route key = {path} index element = {component} exact/>
                        } else {
                            return <Route key = {path} path = {path} element = {component} exact/>
                        }
                    }    
                    )} */}
                </Route>
            </Routes>
        </>
        
    );
};

export default AppRouter;