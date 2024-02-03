import React from 'react';
import { Routes, Route, Redirect } from 'react-router-dom'
import { publicRoutes } from '../routes';
import { Layout } from './Layout';

const AppRouter = () => {
    return (
        <Routes>
            <Route path = "/" element = {<Layout/>}>
                {/* всё ниже пойдёт в <Outlet> Layout'a*/}
                {publicRoutes.map(({path, component}) =>
                {
                    if (path === "/") {
                        return <Route key = {path} index element = {component} exact/>
                    } else {
                        return <Route key = {path} path = {path} element = {component} exact/>
                    }
                }    
                )}
            </Route>
        </Routes>
    );
};

export default AppRouter;